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
    
    static function createGroupDescriptorInstance(string $title = null, string $description = null, string $id = null, int $columns = null) : array;
    
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
    
    function getId() : string;
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function addGroup(string $title = null, string $description = null, string $id = null, int $columns = null) : self;
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function addField(array $fieldDescriptor) : self;
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function addForeignKey(string $name, int $value) : self;
    
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
     * @return mixed
     */
    
    function process(int $metaId = null, OptionMetaType $metaType = null);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    function render(bool $echo = true) : string;
    
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
    
    function onRead(callable $onRead = null) : self;
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function onCreate(callable $onCreate = null) : self;
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function onUpdate(callable $onUpdate = null) : self;
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function readFromSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null, string $recordField = null, int $recordId = null) : self;
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function updateToSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null, string $recordField = null, int $recordId = null) : self;
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function createToSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null) : self;
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function setOptionPrefix(string $optionPrefix = null) : self;
    
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
    
    function readFromOptions(string $optionName = null) : self;
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function updateToOptions(string $optionName = null) : self;
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function createToOptions(string $optionName = null) : self;
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function readFromSqlQuery(string $query) : self;
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function redirect(callable $redirect) : self;

}