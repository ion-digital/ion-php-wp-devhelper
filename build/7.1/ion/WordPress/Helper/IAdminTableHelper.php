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
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function addColumn(array $columnDescriptor) : IAdminTableHelper;
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function addColumnGroup(string $label = null, string $id = null, array $columns = []) : IAdminTableHelper;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    function processAndRender(bool $echo = true) : string;
    
    /**
     * method
     * 
     * @return void
     */
    
    function process() : void;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    function render(bool $echo = true) : string;
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function read(callable $read) : IAdminTableHelper;
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function readFromSqlTable(string $tableNameWithoutPrefix, array $where = null, string $tableNamePrefix = null) : IAdminTableHelper;
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function readFromSqlQuery(string $query) : IAdminTableHelper;
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function delete(callable $delete) : IAdminTableHelper;
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function deleteFromSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null) : IAdminTableHelper;
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function readFromOptions(string $optionName) : IAdminTableHelper;
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function deleteFromOptions(string $optionName) : IAdminTableHelper;

}