<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 *
 * @author Justus
 */
use ion\WordPress\Helper\Wrappers\OptionMetaType;

interface IAdminFormHelper
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
     * @return mixed
     */
    
    function __construct(array &$parent);
    
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
     * @return self
     */
    
    function addGroup($title = null, $description = null, $id = null, $columns = null);
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function addField(array $fieldDescriptor);
    
    /**
     * method
     * 
     * 
     * @return self
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
     * @return mixed
     */
    
    function process($metaId = null, OptionMetaType $metaType = null);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    function render($echo = true);
    
    //    function update(callable $update): self;
    //
    //    function create(callable $create): self;
    //
    //    function read(callable $read): self;
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function onRead(callable $onRead = null);
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function onCreate(callable $onCreate = null);
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function onUpdate(callable $onUpdate = null);
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function readFromSqlTable($tableNameWithoutPrefix, $tableNamePrefix = null, $recordField = null, $recordId = null);
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function updateToSqlTable($tableNameWithoutPrefix, $tableNamePrefix = null, $recordField = null, $recordId = null);
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function createToSqlTable($tableNameWithoutPrefix, $tableNamePrefix = null);
    
    /**
     * method
     * 
     * 
     * @return self
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
     * @return self
     */
    
    function readFromOptions($optionName = null);
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function updateToOptions($optionName = null);
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function createToOptions($optionName = null);
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function readFromSqlQuery($query);
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function redirect(callable $redirect);

}