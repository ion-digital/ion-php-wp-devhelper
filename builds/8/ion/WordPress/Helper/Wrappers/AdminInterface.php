<?php

namespace ion\WordPress\Helper\Wrappers;

use \ion\WordPress\Helper\AdminFormHelperInterface;
use \ion\WordPress\Helper\AdminTableHelperInterface;
use \ion\WordPress\Helper\AdminMenuPageHelperInterface;


/**
 * Description of BackEndTables
 *
 * @author Justus
 */
interface AdminInterface {

    static function getForms(): array;

    static function getTables(): array;

    static function getMenuFields(): array;

    static function getPageActions(): array;

    static function textTableColumn(

        string $label,
        string $name = null,
        string $id = null,
        bool $sortable = true

    ): array;

    static function checkBoxTableColumn(

        string $label,
        string $name = null,
        string $id = null,
        bool $sortable = true

    ): array;

    static function referenceTableColumn(

        string $label,
        array $values,
        string $name = null,
        string $id = null,
        bool $sortable = true

    ): array;

    static function getAdminMenuPage($id);

    static function addAdminMenuPage(

        string $title,
        callable $content,
        string $menuTitle = null,
        string $id = null,
        string $capability = null,
        string $iconUrl = null,
        int $position = null

    ): AdminMenuPageHelperInterface;

    static function addPlugInAdminMenuPage(

        string $title,
        callable $content,
        string $menuTitle = null,
        string $id = null,
        string $iconUrl = null,
        int $position = null

    ): AdminMenuPageHelperInterface;

    static function addThemeAdminMenuPage(

        string $title,
        callable $content,
        string $menuTitle = null,
        string $id = null,
        string $iconUrl = null,
        int $position = null

    ): AdminMenuPageHelperInterface;

    static function addPostAdminMetaBox(

        string $title,
        callable $content,
        string $id,
        string $context = "advanced",
        string $priority = "high"

    ): void;

    static function addAdminForm(

        string $title,
        string $id,
        string $action = null,
        int $columns = 1,
        bool $hideKey = true

    ): AdminFormHelperInterface;

    static function addAdminTable(

        string $title,
        string $id = null,
        string $singularItemName = "Item",
        string $pluralItemName = "Items",
        string $keyColumnId = null,
        callable $detailView = null,
        bool $allowNew = false,
        bool $allowDelete = false,
        bool $allowEdit = false,
        array $additionalActions = null,
        bool $ajax = false

    ): AdminTableHelperInterface;

    static function hiddenInputField(

        string $name,
        string $value = null,
        string $id = null,
        bool $echo = false

    ): array;

    static function numberInputField(

        string $label,
        string $name = null,
        float $value = null,
        string $id = null,
        string $hint = null,
        bool $span = false,
        bool $readOnly = false,
        bool $disabled = false,
        bool $echo = false

    ): array;

    static function textInputField(

        string $label,
        string $name = null,
        string $value = null,
        string $id = null,
        string $hint = null,
        bool $multiLine = false,
        bool $fancy = false,
        bool $span = false,
        bool $readOnly = false,
        bool $disabled = false,
        bool $echo = false

    ): array;

    static function dropDownListInputField(

        string $label,
        array $values,
        string $name = null,
        string $value = null,
        string $id = null,
        string $hint = null,
        string $emptyMessage = null,
        callable $modifyValues = null,
        bool $span = false,
        bool $readOnly = false,
        bool $disabled = false,
        bool $echo = false

    ): array;

    static function listInputField(

        string $label,
        array $values,
        string $name = null,
        array $value = null,
        string $id = null,
        string $hint = null,
        string $emptyMessage = null,
        callable $modifyValues = null,
        bool $span = false,
        bool $readOnly = false,
        bool $disabled = false,
        bool $echo = false

    ): array;

    static function colourPickerInputField(

        string $label,
        string $name = null,
        string $value = null,
        string $id = null,
        string $hint = null,
        bool $span = false,
        bool $readOnly = false,
        bool $disabled = false,
        bool $echo = false

    ): array;

    static function checkBoxInputField(

        string $label,
        string $name = null,
        bool $value = null,
        string $id = null,
        string $hint = null,
        bool $span = false,
        bool $readOnly = false,
        bool $disabled = false,
        bool $echo = false

    ): array;

    static function dateTimeInputField(

        string $label,
        string $name = null,
        string $value = null,
        string $id = null,
        string $hint = null,
        bool $datePicker = true,
        bool $timePicker = true,
        bool $span = false,
        bool $readOnly = false,
        bool $disabled = false,
        bool $echo = false

    ): array;

    static function dateInputField(

        string $label,
        string $name = null,
        string $value = null,
        string $id = null,
        string $hint = null,
        bool $span = false,
        bool $readOnly = false,
        bool $disabled = false,
        bool $echo = false

    ): array;

    static function timeInputField(

        string $label,
        string $name = null,
        string $value = null,
        string $id = null,
        string $hint = null,
        bool $span = false,
        bool $readOnly = false,
        bool $disabled = false,
        bool $echo = false

    ): array;

    static function customInputField(

        string $label,
        callable $html,
        callable $load,
        callable $post,
        callable $validate,
        string $name = null,
        string $value = null,
        string $id = null,
        string $hint = null,
        bool $span = false,
        bool $readOnly = false,
        bool $disabled = false,
        bool $echo = false

    ): array;

    static function button(

        string $label,
        string $id = null,
        string $hint = null,
        AdminFormHelperInterface $form = null,
        bool $span = false,
        bool $disabled = false,
        string $javaScript = null,
        bool $ajaxCall = false,
        bool $echo = true

    ): array;

    static function notify(

        string $message,
        string $notice = "info",
        bool $dismissable = false,
        bool $echo = false

    ): string;

    static function notifyError(string $message, bool $echo = false): string;

    static function notifyInfo(string $message, bool $echo = false): string;

    static function notifySuccess(string $message, bool $echo = false): string;

    static function notifyWarning(string $message, bool $echo = false): string;

    static function addAdminMetaBox(

        string $id,
        string $title,
        callable $content,
        array $screen = [],
        string $context = "advanced",
        string $priority = "default"

    ): void;

    static function addAdminTermFieldBox(

        string $id,
        string $title,
        callable $content,
        array $terms = []

    ): void;

    static function addAdminUserFieldBox(

        string $id,
        string $title,
        callable $content,
        bool $visibleToSelf = true,
        bool $visibleToOthers = false

    ): void;

    static function addAdminMenuField(array $fieldDescriptor, string $menuId = null): void;

    static function addAdminPageAction(string $page, string $caption, string $uri): void;

    static function getCurrentAdminPage(): ?string;

    static function getCurrentAdminObjectType(): ?string;

    static function getCurrentAdminObjectId(): ?int;

    static function getCurrentAdminObject(): ?object;

}
