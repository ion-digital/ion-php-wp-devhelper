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
    static function createGroupDescriptorInstance($title = null, $description = null, $id = null, $columns = null);
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function onRead(callable $onRead = null);
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function onCreate(callable $onCreate = null);
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function onUpdate(callable $onUpdate = null);
    /**
     * method
     * 
     * @return string
     */
    function getId();
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function addGroup($title = null, $description = null, $id = null, $columns = null);
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function addField(array $fieldDescriptor);
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function addForeignKey($name, $value);
    /**
     * method
     * 
     * 
     * @return string
     */
    function processAndRender($echo = true, $post = null);
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
     * @return AdminFormHelperInterface
     */
    function setOptionPrefix($optionPrefix = null);
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
    function setUseSerialization($useSerialization);
    /**
     * method
     * 
     * @return bool
     */
    function getUseSerialization();
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function readFromOptions($optionName = null);
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function updateToOptions($optionName = null);
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function createToOptions($optionName = null);
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function redirect(callable $redirect);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    function process($metaId = null, $metaType = null);
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function readFromSqlQuery($query);
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function readFromSqlTable($tableNameWithoutPrefix, $tableNamePrefix = null, $recordField = null, $recordId = null);
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function updateToSqlTable($tableNameWithoutPrefix, $tableNamePrefix = null, $recordField = null, $recordId = null);
    /**
     * method
     * 
     * 
     * @return AdminFormHelperInterface
     */
    function createToSqlTable($tableNameWithoutPrefix, $tableNamePrefix = null);
}