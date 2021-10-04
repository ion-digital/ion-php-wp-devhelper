<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

use \Throwable;
use \WP_Post;
use \ion\WordPress\WordPressHelperInterface;
use \ion\WordPress\Helper\Tools;
use \ion\WordPress\Helper\Constants;
use \ion\PhpHelper as PHP;
use \ion\Package;
use \ion\SemVerInterface;
use \ion\SemVer;

/**
 * Description of DatabaseTrait*
 * @author Justus
 */
trait DatabaseTrait {
    
    protected static function initialize() {    
        
//        static::registerWrapperAction('init', function() {
//            
//        });        
        
    }    
    
    public static function dbQuery(string $sql, array $args = null, bool $indexResultByColumnName = true) {

        global $wpdb;

        if (strlen($sql) === 0) {
            return null;
        }

        if ($args === null) {
            $args = [];
        }

        $sqlCommand = strtoupper(substr(trim($sql), 0, strpos(trim($sql), ' ')));

        //echo "[$sqlCommand] $sql\n\n";

        if (strlen($sqlCommand) > 0) {

            $preparedSql = $sql;

            if ((strpos($sql, '%s') !== false) || (strpos($sql, '%d') !== false) || (strpos($sql, '%f') !== false)) {
                $preparedSql = $wpdb->prepare($sql, $args);
            }

//            echo '<pre>' . $preparedSql . "</pre>\n";
//            exit;
            
            if ($sqlCommand == 'CREATE' || $sqlCommand == 'INSERT' || $sqlCommand == 'UPDATE' || $sqlCommand == 'DELETE') {

                // CREATE, INSERT, UPDATE, DELETE

                $wpdb->query($preparedSql);
            } else {

                // SELECT, SHOW, DESCRIBE

                return $wpdb->get_results($preparedSql, ($indexResultByColumnName ? ARRAY_A : ARRAY_N));
            }
        }

        return null;
    }

    public static function dbDeltaTable(string $tableName, array $fields, bool $addPrefix = true) {

        // WordPress DB Delta:
        // 
        // * You must put each field on its own line in your SQL statement.
        // * You must have two spaces between the words PRIMARY KEY and the definition of your primary key.
        // * You must use the key word KEY rather than its synonym INDEX and you must include at least one KEY.
        // * KEY must be followed by a SINGLE SPACE then the key name then a space then open parenthesis with the field name then a closed parenthesis.
        // * You must not use any apostrophes or backticks around field names.
        // * Field types must be all lowercase.
        // * SQL keywords, like CREATE ABLETraitand UPDATE, must be uppercase.
        // * You must specify the length of all fields that accept a length parameter. int(11), for example.        

        if (count($fields) > 0) {

            $lines = [];

            $primary = null;

            foreach ($fields as $name => $args) {

                if (!static::isAssociativeArray($args)) {

                    throw new WordPressHelperException(
                    <<<MESSAGE
SqlDeltaTable(): Field definition needs to be an associative array, for example:

[
    'id' => [ 'type' => 'int(11)', 'null' => false, 'primary' => true, 'auto' => true ],
    'column1' => [ 'type' => 'varchar(250)', 'null' => false, 'default' => 'Default value' ],
    'column2' => [ 'type' => 'varchar(250)', 'null' => true ],
    'column3' => [ 'type' => 'int(11)', 'null' => true ]
]
MESSAGE
                    );
                }


                $field = [
                    'type' => null,
                    'null' => false,
                    'primary' => false,
                    'default' => null,
                    'auto' => false
                ];

                foreach (array_change_key_case($args, CASE_LOWER) as $key => $value) {

                    if ($key == 'type') {
                        $field['type'] = $value;
                    } else if ($key == 'null') {
                        $field['null'] = $value;
                    } else if ($key == 'primary') {

                        if ($primary === null) {
                            $field['primary'] = true;

                            $primary = $name;
                        }
                    } else if ($key == 'default') {
                        $field['default'] = $value;
                    } else if ($key == 'auto') {

                        $field['auto'] = true;
                    }
                }


                if ($field['type'] !== null) {

                    $fieldStr = "$name ";

                    $type = strtoupper($field['type']);

                    $fieldStr .= $type;

                    if ($field['default'] !== null) {

                        $default = $field['default'];


                        if (strpos($type, 'VARCHAR') !== false || strpos($type, 'DATE') !== false || strpos($type, 'TIME') !== false) {
                            $fieldStr .= ' DEFAULT \'' . $field['default'] . '\'';
                        } else {
                            $fieldStr .= ' DEFAULT ' . $field['default'];
                        }
                    }

                    if ($field['null'] === true) {
                        $fieldStr .= ' NULL';
                    } else {
                        $fieldStr .= ' NOT NULL';
                    }

                    if ($field['primary'] === true) {

                        if ($field['auto'] === true) {
                            $fieldStr .= ' AUTO_INCREMENT';
                        }
                    }
                }

                $lines[] = trim($fieldStr);
            }

            if (count($lines) > 0) {

                global $wpdb;

                $collation = $wpdb->get_charset_collate();

                if ($addPrefix === true) {
                    $tableName = $wpdb->prefix . $tableName;
                }

                $sql = "CREATE ABLETrait$tableName (\n";
                $sql .= join(",\n", $lines);

                if ($primary === null) {
                    throw new WordPressHelperException('No primary key has been defined.');
                }

                $sql .= ", \nPRIMARY KEY  (" . $primary . ")\n"; //NOTE: Two spaces between 'KEY' and '('

                $sql .= ") $collation;\n";

//                die("<pre>$sql</pre>");
                
                return dbDelta($sql, true);
            }
        }


        return [];

    }
    
    //TODO
    public static function dbCreateTable(string $tableName, array $fields, bool $throwExceptionIfExists = false, bool $addPrefix = true) {

    }    
    
    //TODO: See TAdminTableHelper::_readFromSqlTable for WHERE example
    public static function dbTableExists(string $tableName, bool $addPrefix = true): bool {

        //FIXME
        return true;
    }
    
    //TODO: See TAdminTableHelper::_readFromSqlTable for WHERE example
    public static function dbSelect(string $tableName, array $where = null, bool $addPrefix = true): array {

    }    
    
    //TODO
    public static function dbInsert(string $tableName, array $values) {

    }
    
    //TODO
    public static function dbUpdate(string $tableName, array $values, array $where = null) {

    }
    
    //TODO
    public static function dbDelete(string $tableName, array $where) {

    }

    public static function getDbTableName(string $tableName, bool $addPrefix = true): string {
        
        if($addPrefix === false) {
            return $tableName;
        }
        
        return static::getDbTablePrefix() . $tableName;
    }
    
    public static function getDbTablePrefix(): string {

        global $wpdb;

        return $wpdb->prefix;
    }
    
}
