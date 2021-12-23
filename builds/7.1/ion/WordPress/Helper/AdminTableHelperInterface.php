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
    static function inDetailMode() : bool;
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function onRead(callable $onRead) : AdminTableHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function onDelete(callable $onDelete) : AdminTableHelperInterface;
    /**
     * method
     * 
     * @return array
     */
    function getDescriptor() : array;
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function addColumn(array $columnDescriptor) : AdminTableHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function addColumnGroup(string $label = null, string $id = null, array $columns = []) : AdminTableHelperInterface;
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
     * @return AdminTableHelperInterface
     */
    function readFromSqlTable(string $tableNameWithoutPrefix, array $where = null, string $tableNamePrefix = null) : AdminTableHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function readFromSqlQuery(string $query) : AdminTableHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function deleteFromSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null) : AdminTableHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function readFromOptions(string $optionName) : AdminTableHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    function deleteFromOptions(string $optionName) : AdminTableHelperInterface;
}