<?php

namespace ion\WordPress\Helper;

interface AdminFormHelperInterface {

    static function createGroupDescriptorInstance(

        string $title = null,
        string $description = null,
        string $id = null,
        int $columns = null

    ): array;

    function onRead(callable $onRead = null): AdminFormHelperInterface;

    function onCreate(callable $onCreate = null): AdminFormHelperInterface;

    function onUpdate(callable $onUpdate = null): AdminFormHelperInterface;

    function getId(): string;

    function addGroup(

        string $title = null,
        string $description = null,
        string $id = null,
        int $columns = null

    ): AdminFormHelperInterface;

    function addField(array $fieldDescriptor): AdminFormHelperInterface;

    function addForeignKey(string $name, int $value): AdminFormHelperInterface;

    function processAndRender(bool $echo = true, int $post = null): string;

    function render(bool $echo = true): string;

    function setOptionPrefix(string $optionPrefix = null): AdminFormHelperInterface;

    function getOptionPrefix(): ?string;

    function setUseSerialization(bool $useSerialization): AdminFormHelperInterface;

    function getUseSerialization(): bool;

    function readFromOptions(string $optionName = null): AdminFormHelperInterface;

    function updateToOptions(string $optionName = null): AdminFormHelperInterface;

    function createToOptions(string $optionName = null): AdminFormHelperInterface;

    function redirect(callable $redirect): AdminFormHelperInterface;

    function process(int $metaId = null, string $metaType = null);

    function readFromSqlQuery(string $query): AdminFormHelperInterface;

    function readFromSqlTable(

        string $tableNameWithoutPrefix,
        string $tableNamePrefix = null,
        string $recordField = null,
        int $recordId = null

    ): AdminFormHelperInterface;

    function updateToSqlTable(

        string $tableNameWithoutPrefix,
        string $tableNamePrefix = null,
        string $recordField = null,
        int $recordId = null

    ): AdminFormHelperInterface;

    function createToSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null): AdminFormHelperInterface;

}
