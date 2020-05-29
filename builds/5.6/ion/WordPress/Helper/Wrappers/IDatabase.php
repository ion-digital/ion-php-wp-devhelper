<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */

interface IDatabase
{
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function dbQuery($sql, array $args = null, $indexResultByColumnName = true);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getDbTableName($tableName, $addPrefix = true);
    
    /**
     * method
     * 
     * @return string
     */
    
    static function getDbTablePrefix();
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function dbDeltaTable($tableName, array $fields, $addPrefix = true);
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function dbCreateTable($tableName, array $fields, $throwExceptionIfExists = false, $addPrefix = true);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function dbTableExists($tableName, $addPrefix = true);
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function dbSelect($tableName, array $where = null, $addPrefix = true);
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function dbInsert($tableName, array $values);
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function dbUpdate($tableName, array $values, array $where = null);
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function dbDelete($tableName, array $where);

}