<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */

use \ion\WordPress\Helper\IAdminFormHelper;
use \ion\WordPress\Helper\IAdminTableHelper;
use \ion\WordPress\Helper\IAdminMenuPageHelper;

interface IAdmin {

    static function getForms(): array;
    
    static function getTables(): array;   
    
    static function textInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $multiLine = false, bool $fancy = false, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false): array;
    
    static function numberInputField(string $label, string $name = null, float $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false): array;
        
    static function hiddenInputField(string $name, string $value = null, string $id = null, bool $echo = false): array;
    
    static function dropDownListInputField(string $label, array $values, string $name = null, string $value = null, string $id = null, string $hint = null, string $emptyMessage = null, callable $modifyValues = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false): array;
    
    static function listInputField(string $label, array $values, string $name = null, array $value = null, string $id = null, string $hint = null, string $emptyMessage = null, callable $modifyValues = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false): array;
    
    static function colourPickerInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false): array;

    static function checkBoxInputField(string $label, string $name = null, bool $value = null, string $id = null, string $hint = null, bool $span = false, bool $disabled = false, bool $readOnly = false, bool $echo = false): array;

    static function dateTimeInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $datePicker = true, bool $timePicker = true, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false): array;
    
    static function dateInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false): array;
    
    static function timeInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false): array;
    
    static function customInputField(string $label, callable $html, callable $load, callable $post, callable $validate, string $name = null, string $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false): array;
    
    static function button(string $label, string $id = null, string $hint = null, IAdminFormHelper $form = null, bool $span = false, bool $disabled = false, string $javaScript = null, bool $ajaxCall = false, bool $echo = true): array;

    static function textTableColumn(string $label, string $name = null, string $id = null, bool $sortable = true): array;    
    
    static function checkBoxTableColumn(string $label, string $name = null, string $id = null, bool $sortable = true): array;            

    static function referenceTableColumn(string $label, array $values, string $name = null, string $id = null, bool $sortable = true): array;
    
    static function notify(string $message, string $notice = "notice-info", bool $dismissable = false, bool $echo = false): string;

    static function notifyError(string $message, bool $echo = false): string;

    static function notifyInfo(string $message, bool $echo = false): string;

    static function notifySuccess(string $message, bool $echo = false): string;
    
    static function notifyWarning(string $message, bool $echo = false): string;          
    
    static function addAdminMenuPage(string $title, callable $content, string $menuTitle = null, string $id = null, string $capability = null, string $iconUrl = null, int $position = null): IAdminMenuPageHelper;
    
    static function addAdminForm(string $title, string $id, string $action = null, int $columns = 1, bool $hideKey = true): IAdminFormHelper;

    static function addAdminTable(string $title, string $id = null, string $singularItemName = "Item", string $pluralItemName = "Items", string $keyColumnId = null, callable $detailView = null, bool $allowNew = false, bool $allowDelete = false, bool $allowEdit = false, array $additionalActions = null, bool $ajax = false): IAdminTableHelper;
    
    static function addPlugInAdminMenuPage(string $title, callable $content, string $menuTitle = null, string $id = null, string $iconUrl = null, int $position = null): IAdminMenuPageHelper;

    static function addThemeAdminMenuPage(string $title, callable $content, string $menuTitle = null, string $id = null, string $iconUrl = null, int $position = null): IAdminMenuPageHelper;

    static function addPostAdminMetaBox(string $title, callable $content, string $id, string $context = "advanced", string $priority = "high"): void;
    
    static function addAdminMetaBox(string $id, string $title, callable $content, array $screen = ['post'], string $context = 'advanced', string $priority = 'default'): void;

    static function addAdminTermFieldBox(string $id, string $title, callable $content, array $terms = []): void;
    
    static function addAdminUserFieldBox(string $id, string $title, callable $content, bool $visibleToSelf = true, bool $visibleToOthers = false): void;        
        
    static function addAdminMenuField(array $fieldDescriptor, string $menuId = null): void;
        
    static function addAdminPageAction(string $page, string $caption, string $uri): void;
    
    static function getCurrentAdminPage(): ?string;
    
    static function getCurrentAdminObjectType(): ?string;
    
    static function getCurrentAdminObject(): ?object;
   
    static function getCurrentAdminObjectId(): ?int;
    
    
//    static function getDashboardBackEndMenuPage(): IAdminMenuPageHelper;
//
//    static function getPostsBackEndMenuPage(): IAdminMenuPageHelper;
//
//    static function getMediaBackEndMenuPage(): IAdminMenuPageHelper;
//
//    static function getCommentsBackEndMenuPage(): IAdminMenuPageHelper;
//    
//    static function getAppearanceBackEndMenuPage(): IAdminMenuPageHelper;
//
//    static function getPluginsBackEndMenuPage(): IAdminMenuPageHelper;
//    
//    static function getPagesBackEndMenuPage(): IAdminMenuPageHelper;
//    
//    static function getUsersBackEndMenuPage(): IAdminMenuPageHelper;
//
//    static function getToolsBackEndMenuPage(): IAdminMenuPageHelper;
//    
//    static function getSettingsBackEndMenuPage(): IAdminMenuPageHelper;
//    
//    static function getNetworkBackEndMenuPage(): IAdminMenuPageHelper;
//    
//    static function getCustomPostBackEndMenuPage(string $postType);    
    
}
