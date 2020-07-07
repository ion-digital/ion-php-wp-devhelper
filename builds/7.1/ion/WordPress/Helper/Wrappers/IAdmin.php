<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */
use ion\WordPress\Helper\IAdminFormHelper;
use ion\WordPress\Helper\IAdminTableHelper;
use ion\WordPress\Helper\IAdminMenuPageHelper;

interface IAdmin
{
    /**
     * method
     * 
     * @return array
     */
    
    static function getForms() : array;
    
    /**
     * method
     * 
     * @return array
     */
    
    static function getTables() : array;
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function textInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $multiLine = false, bool $fancy = false, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array;
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function numberInputField(string $label, string $name = null, float $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array;
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function hiddenInputField(string $name, string $value = null, string $id = null, bool $echo = false) : array;
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function dropDownListInputField(string $label, array $values, string $name = null, string $value = null, string $id = null, string $hint = null, string $emptyMessage = null, callable $modifyValues = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array;
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function listInputField(string $label, array $values, string $name = null, array $value = null, string $id = null, string $hint = null, string $emptyMessage = null, callable $modifyValues = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array;
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function colourPickerInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array;
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function checkBoxInputField(string $label, string $name = null, bool $value = null, string $id = null, string $hint = null, bool $span = false, bool $disabled = false, bool $readOnly = false, bool $echo = false) : array;
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function dateTimeInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $datePicker = true, bool $timePicker = true, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array;
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function dateInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array;
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function timeInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array;
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function button(string $label, string $id = null, string $hint = null, IAdminFormHelper $form = null, bool $span = false, bool $disabled = false, string $javaScript = null, bool $echo = true) : array;
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function textTableColumn(string $label, string $name = null, string $id = null, bool $sortable = true) : array;
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function checkBoxTableColumn(string $label, string $name = null, string $id = null, bool $sortable = true) : array;
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function referenceTableColumn(string $label, array $values, string $name = null, string $id = null, bool $sortable = true) : array;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function notify(string $message, string $notice = "notice-info", bool $dismissable = false, bool $echo = false) : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function notifyError(string $message, bool $echo = false) : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function notifyInfo(string $message, bool $echo = false) : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function notifySuccess(string $message, bool $echo = false) : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function notifyWarning(string $message, bool $echo = false) : string;
    
    /**
     * method
     * 
     * 
     * @return IAdminMenuPageHelper
     */
    
    static function addAdminMenuPage(string $title, callable $content, string $menuTitle = null, string $id = null, string $capability = null, string $iconUrl = null, int $position = null) : IAdminMenuPageHelper;
    
    /**
     * method
     * 
     * 
     * @return IAdminFormHelper
     */
    
    static function addAdminForm(string $title, string $id = null, string $action = null, int $columns = 1, bool $hideKey = true) : IAdminFormHelper;
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    static function addAdminTable(string $title, string $id = null, string $singularItemName = "Item", string $pluralItemName = "Items", string $keyColumnId = null, callable $detailView = null, bool $allowNew = false, bool $allowDelete = false, bool $allowEdit = false, array $additionalActions = null, bool $ajax = false) : IAdminTableHelper;
    
    /**
     * method
     * 
     * 
     * @return IAdminMenuPageHelper
     */
    
    static function addPlugInAdminMenuPage(string $title, callable $content, string $menuTitle = null, string $id = null, string $iconUrl = null, int $position = null) : IAdminMenuPageHelper;
    
    /**
     * method
     * 
     * 
     * @return IAdminMenuPageHelper
     */
    
    static function addThemeAdminMenuPage(string $title, callable $content, string $menuTitle = null, string $id = null, string $iconUrl = null, int $position = null) : IAdminMenuPageHelper;
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function addPostAdminMetaBox(string $title, callable $content, string $id, string $context = "advanced", string $priority = "high") : void;
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function addAdminMetaBox(string $id, string $title, callable $content, array $screen = ['post'], string $context = 'advanced', string $priority = 'default') : void;
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function addAdminTermFieldBox(string $id, string $title, callable $content, array $terms = []) : void;
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function addAdminUserFieldBox(string $id, string $title, callable $content, bool $visibleToSelf = true, bool $visibleToOthers = false) : void;
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function addAdminMenuField(array $fieldDescriptor, string $menuId = null) : void;
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function addAdminPageAction(string $page, string $caption, string $uri) : void;
    
    /**
     * method
     * 
     * @return ?string
     */
    
    static function getCurrentAdminPage() : ?string;
    
    /**
     * method
     * 
     * @return ?string
     */
    
    static function getCurrentAdminObjectType() : ?string;
    
    /**
     * method
     * 
     * @return ?object
     */
    
    static function getCurrentAdminObject();
    
    /**
     * method
     * 
     * @return ?int
     */
    
    static function getCurrentAdminObjectId() : ?int;

}