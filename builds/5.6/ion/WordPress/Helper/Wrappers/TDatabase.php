<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

use \Exception as Throwable;
use WP_Post;
use ion\WordPress\IWordPressHelper;
use ion\Types\Arrays\IMap;
use ion\Types\Arrays\Map;
use ion\Types\Arrays\IVector;
use ion\Types\Arrays\Vector;
use ion\WordPress\Helper\Tools;
use ion\WordPress\Helper\Constants;
use ion\PhpHelper as PHP;
use ion\Package;
use ion\System\File;
use ion\System\Path;
use ion\System\FileMode;
use ion\ISemVer;
use ion\SemVer;
use ion\Types\StringObject;
/**
 * Description of TDatabase
 *
 * @author Justus
 */
trait TDatabase
{
    /**
     * method
     * 
     * @return mixed
     */
    
    protected static function initialize_TDatabase()
    {
        //        static::registerWrapperAction('init', function() {
        //
        //        });
    }
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    public static function dbQuery($sql, array $args = null, $indexResultByColumnName = true)
    {
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
            if (strpos($sql, '%s') !== false || strpos($sql, '%d') !== false || strpos($sql, '%f') !== false) {
                $preparedSql = $wpdb->prepare($sql, $args);
            }
            //            echo '<pre>' . $preparedSql . "</pre>\n";
            //            exit;
            if ($sqlCommand == 'CREATE' || $sqlCommand == 'INSERT' || $sqlCommand == 'UPDATE' || $sqlCommand == 'DELETE') {
                // CREATE, INSERT, UPDATE, DELETE
                $wpdb->query($preparedSql);
            } else {
                // SELECT, SHOW, DESCRIBE
                return $wpdb->get_results($preparedSql, $indexResultByColumnName ? ARRAY_A : ARRAY_N);
            }
        }
        return null;
    }
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    public static function dbDeltaTable($tableName, array $fields, $addPrefix = true)
    {
        // WordPress DB Delta:
        //
        // * You must put each field on its own line in your SQL statement.
        // * You must have two spaces between the words PRIMARY KEY and the definition of your primary key.
        // * You must use the key word KEY rather than its synonym INDEX and you must include at least one KEY.
        // * KEY must be followed by a SINGLE SPACE then the key name then a space then open parenthesis with the field name then a closed parenthesis.
        // * You must not use any apostrophes or backticks around field names.
        // * Field types must be all lowercase.
        // * SQL keywords, like CREATE TABLE and UPDATE, must be uppercase.
        // * You must specify the length of all fields that accept a length parameter. int(11), for example.
        if (count($fields) > 0) {
            $lines = [];
            $primary = null;
            foreach ($fields as $name => $args) {
                if (!static::isAssociativeArray($args)) {
                    throw new WordPressHelperException(<<<MESSAGE
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
                $field = ['type' => null, 'null' => false, 'primary' => false, 'default' => null, 'auto' => false];
                foreach (array_change_key_case($args, CASE_LOWER) as $key => $value) {
                    if ($key == 'type') {
                        $field['type'] = $value;
                    } else {
                        if ($key == 'null') {
                            $field['null'] = $value;
                        } else {
                            if ($key == 'primary') {
                                if ($primary === null) {
                                    $field['primary'] = true;
                                    $primary = $name;
                                }
                            } else {
                                if ($key == 'default') {
                                    $field['default'] = $value;
                                } else {
                                    if ($key == 'auto') {
                                        $field['auto'] = true;
                                    }
                                }
                            }
                        }
                    }
                }
                if ($field['type'] !== null) {
                    $fieldStr = "{$name} ";
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
                $sql = "CREATE TABLE {$tableName} (\n";
                $sql .= join(",\n", $lines);
                if ($primary === null) {
                    throw new WordPressHelperException('No primary key has been defined.');
                }
                $sql .= ", \nPRIMARY KEY  (" . $primary . ")\n";
                //NOTE: Two spaces between 'KEY' and '('
                $sql .= ") {$collation};\n";
                //                die("<pre>$sql</pre>");
                return dbDelta($sql, true);
            }
        }
        return [];
    }
    
    //TODO
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    public static function dbCreateTable($tableName, array $fields, $throwExceptionIfExists = false, $addPrefix = true)
    {
    }
    
    //TODO: See TAdminTableHelper::_readFromSqlTable for WHERE example
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    public static function dbTableExists($tableName, $addPrefix = true)
    {
        //FIXME
        return true;
    }
    
    //TODO: See TAdminTableHelper::_readFromSqlTable for WHERE example
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function dbSelect($tableName, array $where = null, $addPrefix = true)
    {
    }
    
    //TODO
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    public static function dbInsert($tableName, array $values)
    {
    }
    
    //TODO
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    public static function dbUpdate($tableName, array $values, array $where = null)
    {
    }
    
    //TODO
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    public static function dbDelete($tableName, array $where)
    {
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function getDbTableName($tableName, $addPrefix = true)
    {
        if ($addPrefix === false) {
            return $tableName;
        }
        return static::getDbTablePrefix() . $tableName;
    }
    
    /**
     * method
     * 
     * @return string
     */
    
    public static function getDbTablePrefix()
    {
        global $wpdb;
        return $wpdb->prefix;
    }

}