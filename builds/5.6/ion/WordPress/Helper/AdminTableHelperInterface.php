<?php
namespace ion\WordPress\Helper;

/**
 * Description of AdminTableHelper
 *
 * @author Justus
 */
interface AdminTableHelperInterface
{
    /**
     * method
     * 
     * @return bool
     */
    static function inDetailMode();
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function onRead(callable $onRead);
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function onDelete(callable $onDelete);
    /**
     * method
     * 
     * @return array
     */
    function getDescriptor();
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function addColumn(array $columnDescriptor);
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
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
     * @return AdminTableHelperInterface
     */
    function readFromSqlTable($tableNameWithoutPrefix, array $where = null, $tableNamePrefix = null);
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function readFromSqlQuery($query);
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function deleteFromSqlTable($tableNameWithoutPrefix, $tableNamePrefix = null);
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function readFromOptions($optionName);
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function deleteFromOptions($optionName);
}