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
    
    //    function read(callable $read): IAdminTableHelper;
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
    
    //    function delete(callable $delete): IAdminTableHelper;
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