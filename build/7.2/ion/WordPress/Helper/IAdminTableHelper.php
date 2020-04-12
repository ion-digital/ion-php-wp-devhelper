<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 *
 * @author Justus
 */

interface IAdminTableHelper
{
    function addColumn(array $columnDescriptor) : IAdminTableHelper;
    
    function addColumnGroup(string $label = null, string $id = null, array $columns = []) : IAdminTableHelper;
    
    function processAndRender(bool $echo = true) : string;
    
    function process() : void;
    
    function render(bool $echo = true) : string;
    
    function read(callable $read) : IAdminTableHelper;
    
    function readFromSqlTable(string $tableNameWithoutPrefix, array $where = null, string $tableNamePrefix = null) : IAdminTableHelper;
    
    function readFromSqlQuery(string $query) : IAdminTableHelper;
    
    function delete(callable $delete) : IAdminTableHelper;
    
    function deleteFromSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null) : IAdminTableHelper;
    
    function readFromOptions(string $optionName) : IAdminTableHelper;
    
    function deleteFromOptions(string $optionName) : IAdminTableHelper;

}