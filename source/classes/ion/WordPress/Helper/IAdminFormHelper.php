<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper;

/**
 *
 * @author Justus
 */

use \ion\WordPress\Helper\Wrappers\OptionMetaType;

interface IAdminFormHelper {
    
    static function createGroupDescriptorInstance(string $title = null, string $description = null, string $id = null, int $columns = null): array;
    
    function __construct(array &$parent);

    function getId(): string;
    
    function addGroup(string $title = null, string $description = null, string $id = null, int $columns = null): self;
    
    function addField(array $fieldDescriptor): self;

    function addForeignKey(string $name, int $value): self;
    
    function processAndRender(bool $echo = true, int $post = null): string;
    
    function process(int $metaId = null, OptionMetaType $metaType = null);

    function render(bool $echo = true): string;
    
    function update(callable $update): self;
    
    function create(callable $create): self;
    
    function read(callable $read): self;
    
    function onRead(callable $onRead = null): IAdminFormHelper;
    
    function onCreate(callable $onCreate = null): IAdminFormHelper;

    function onUpdate(callable $onUpdate = null): IAdminFormHelper;
    
    function readFromSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null, string $recordField = null, int $recordId = null): self;
    
    function updateToSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null, string $recordField = null, int $recordId = null): self;
    
    function createToSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null): self;
    
    function setOptionPrefix(string $optionPrefix = null): self;
    
    function getOptionPrefix(): ?string;
    
    function readFromOptions(string $optionName = null): self;
    
    function updateToOptions(string $optionName = null): self;
    
    function createToOptions(string $optionName = null): self;
    
    function readFromSqlQuery(string $query): self;    
    
    function redirect(callable $redirect): self;
}
