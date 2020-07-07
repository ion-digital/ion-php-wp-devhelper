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
    
    static function getForms();
    
    /**
     * method
     * 
     * @return array
     */
    
    static function getTables();
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function textInputField($label, $name = null, $value = null, $id = null, $hint = null, $multiLine = false, $fancy = false, $span = false, $readOnly = false, $disabled = false, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function numberInputField($label, $name = null, $value = null, $id = null, $hint = null, $span = false, $readOnly = false, $disabled = false, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function hiddenInputField($name, $value = null, $id = null, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function dropDownListInputField($label, array $values, $name = null, $value = null, $id = null, $hint = null, $emptyMessage = null, callable $modifyValues = null, $span = false, $readOnly = false, $disabled = false, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function listInputField($label, array $values, $name = null, array $value = null, $id = null, $hint = null, $emptyMessage = null, callable $modifyValues = null, $span = false, $readOnly = false, $disabled = false, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function colourPickerInputField($label, $name = null, $value = null, $id = null, $hint = null, $span = false, $readOnly = false, $disabled = false, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function checkBoxInputField($label, $name = null, $value = null, $id = null, $hint = null, $span = false, $disabled = false, $readOnly = false, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function dateTimeInputField($label, $name = null, $value = null, $id = null, $hint = null, $datePicker = true, $timePicker = true, $span = false, $readOnly = false, $disabled = false, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function dateInputField($label, $name = null, $value = null, $id = null, $hint = null, $span = false, $readOnly = false, $disabled = false, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function timeInputField($label, $name = null, $value = null, $id = null, $hint = null, $span = false, $readOnly = false, $disabled = false, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function button($label, $id = null, $hint = null, IAdminFormHelper $form = null, $span = false, $disabled = false, $javaScript = null, $echo = true);
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function textTableColumn($label, $name = null, $id = null, $sortable = true);
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function checkBoxTableColumn($label, $name = null, $id = null, $sortable = true);
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    static function referenceTableColumn($label, array $values, $name = null, $id = null, $sortable = true);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function notify($message, $notice = "notice-info", $dismissable = false, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function notifyError($message, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function notifyInfo($message, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function notifySuccess($message, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function notifyWarning($message, $echo = false);
    
    /**
     * method
     * 
     * 
     * @return IAdminMenuPageHelper
     */
    
    static function addAdminMenuPage($title, callable $content, $menuTitle = null, $id = null, $capability = null, $iconUrl = null, $position = null);
    
    /**
     * method
     * 
     * 
     * @return IAdminFormHelper
     */
    
    static function addAdminForm($title, $id = null, $action = null, $columns = 1, $hideKey = true);
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    static function addAdminTable($title, $id = null, $singularItemName = "Item", $pluralItemName = "Items", $keyColumnId = null, callable $detailView = null, $allowNew = false, $allowDelete = false, $allowEdit = false, array $additionalActions = null, $ajax = false);
    
    /**
     * method
     * 
     * 
     * @return IAdminMenuPageHelper
     */
    
    static function addPlugInAdminMenuPage($title, callable $content, $menuTitle = null, $id = null, $iconUrl = null, $position = null);
    
    /**
     * method
     * 
     * 
     * @return IAdminMenuPageHelper
     */
    
    static function addThemeAdminMenuPage($title, callable $content, $menuTitle = null, $id = null, $iconUrl = null, $position = null);
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function addPostAdminMetaBox($title, callable $content, $id, $context = "advanced", $priority = "high");
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function addAdminMetaBox($id, $title, callable $content, array $screen = ['post'], $context = 'advanced', $priority = 'default');
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function addAdminTermFieldBox($id, $title, callable $content, array $terms = []);
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function addAdminUserFieldBox($id, $title, callable $content, $visibleToSelf = true, $visibleToOthers = false);
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function addAdminMenuField(array $fieldDescriptor, $menuId = null);
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function addAdminPageAction($page, $caption, $uri);
    
    /**
     * method
     * 
     * @return ?string
     */
    
    static function getCurrentAdminPage();
    
    /**
     * method
     * 
     * @return ?string
     */
    
    static function getCurrentAdminObjectType();
    
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
    
    static function getCurrentAdminObjectId();

}