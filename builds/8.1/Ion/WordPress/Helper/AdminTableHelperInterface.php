<?php
namespace Ion\WordPress\Helper;

/**
 * Description of AdminTableHelper
 *
 * @author Justus
 */
interface AdminTableHelperInterface
{
    function onRead(callable $onRead) : AdminTableHelperInterface;
    function onDelete(callable $onDelete) : AdminTableHelperInterface;
    function getDescriptor() : array;
    function addColumn(array $columnDescriptor) : AdminTableHelperInterface;
    function addColumnGroup(string $label = null, string $id = null, array $columns = []) : AdminTableHelperInterface;
    function processAndRender(bool $echo = true) : string;
    function process() : void;
    function render(bool $echo = true) : string;
    function readFromSqlTable(string $tableNameWithoutPrefix, array $where = null, string $tableNamePrefix = null) : AdminTableHelperInterface;
    function readFromSqlQuery(string $query) : AdminTableHelperInterface;
    function deleteFromSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null) : AdminTableHelperInterface;
    function readFromOptions(string $optionName) : AdminTableHelperInterface;
    function deleteFromOptions(string $optionName) : AdminTableHelperInterface;
}