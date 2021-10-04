<?php
namespace ion\WordPress\Helper\Wrappers;

/**
 * Description of DatabaseTrait*
 * @author Justus
 */
interface DatabaseInterface
{
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function dbQuery(string $sql, array $args = null, bool $indexResultByColumnName = true);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function dbDeltaTable(string $tableName, array $fields, bool $addPrefix = true);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function dbCreateTable(string $tableName, array $fields, bool $throwExceptionIfExists = false, bool $addPrefix = true);
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function dbTableExists(string $tableName, bool $addPrefix = true) : bool;
    /**
     * method
     * 
     * 
     * @return array
     */
    static function dbSelect(string $tableName, array $where = null, bool $addPrefix = true) : array;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function dbInsert(string $tableName, array $values);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function dbUpdate(string $tableName, array $values, array $where = null);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function dbDelete(string $tableName, array $where);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function getDbTableName(string $tableName, bool $addPrefix = true) : string;
    /**
     * method
     * 
     * @return string
     */
    static function getDbTablePrefix() : string;
}