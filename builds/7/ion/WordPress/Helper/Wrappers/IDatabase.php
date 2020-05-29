<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */
interface IDatabase {

    static function dbQuery(string $sql, array $args = null, bool $indexResultByColumnName = true);    
    
    static function getDbTableName(string $tableName, bool $addPrefix = true): string;
    
    static function getDbTablePrefix(): string;

    static function dbDeltaTable(string $tableName, array $fields, bool $addPrefix = true); 
     
    static function dbCreateTable(string $tableName, array $fields, bool $throwExceptionIfExists = false, bool $addPrefix = true);
    
    static function dbTableExists(string $tableName, bool $addPrefix = true): bool;    
    
    static function dbSelect(string $tableName, array $where = null, bool $addPrefix = true): array;    
    
    static function dbInsert(string $tableName, array $values);
    
    static function dbUpdate(string $tableName, array $values, array $where = null);
    
    static function dbDelete(string $tableName, array $where);   
    
}
