<?php
namespace ion\WordPress\Helper;

interface AdminFormHelperInterface
{
    /**
     * method
     * 
     * 
     * @return array
     */
    static function createGroupDescriptorInstance(string $title = null, string $description = null, string $id = null, int $columns = null) : array;
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function onRead(callable $onRead = null) : AdminFormHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function onCreate(callable $onCreate = null) : AdminFormHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function onUpdate(callable $onUpdate = null) : AdminFormHelperInterface;
    /**
     * method
     * 
     * @return string
     */
    function getId() : string;
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function addGroup(string $title = null, string $description = null, string $id = null, int $columns = null) : AdminFormHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function addField(array $fieldDescriptor) : AdminFormHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function addForeignKey(string $name, int $value) : AdminFormHelperInterface;
    /**
     * method
     * 
     * 
     * @return string
     */
    function processAndRender(bool $echo = true, int $post = null) : string;
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
     * @return AdminFormHelperInterface
     */
    function setOptionPrefix(string $optionPrefix = null) : AdminFormHelperInterface;
    /**
     * method
     * 
     * @return ?string
     */
    function getOptionPrefix();
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function setUseSerialization(bool $useSerialization) : AdminFormHelperInterface;
    /**
     * method
     * 
     * @return bool
     */
    function getUseSerialization() : bool;
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function readFromOptions(string $optionName = null) : AdminFormHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function updateToOptions(string $optionName = null) : AdminFormHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function createToOptions(string $optionName = null) : AdminFormHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function redirect(callable $redirect) : AdminFormHelperInterface;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    function process(int $metaId = null, string $metaType = null);
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function readFromSqlQuery(string $query) : AdminFormHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function readFromSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null, string $recordField = null, int $recordId = null) : AdminFormHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function updateToSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null, string $recordField = null, int $recordId = null) : AdminFormHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function createToSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null) : AdminFormHelperInterface;
}