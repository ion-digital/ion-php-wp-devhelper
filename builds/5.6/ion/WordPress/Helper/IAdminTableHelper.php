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
    
    function addColumn(array $columnDescriptor);
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function addColumnGroup($label = null, $id = null, array $columns = []);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    function processAndRender($echo = true);
    
    /**
     * method
     * 
     * @return void
     */
    
    function process();
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    function render($echo = true);
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function read(callable $read);
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function readFromSqlTable($tableNameWithoutPrefix, array $where = null, $tableNamePrefix = null);
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function readFromSqlQuery($query);
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function delete(callable $delete);
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function deleteFromSqlTable($tableNameWithoutPrefix, $tableNamePrefix = null);
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function readFromOptions($optionName);
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    function deleteFromOptions($optionName);

}