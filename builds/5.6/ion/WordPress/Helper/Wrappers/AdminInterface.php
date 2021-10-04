<?php
namespace ion\WordPress\Helper\Wrappers;

use ion\WordPress\Helper\AdminFormHelperInterface;
use ion\WordPress\Helper\AdminTableHelperInterface;
use ion\WordPress\Helper\AdminMenuPageHelperInterface;
/**
 * Description of BackEndTables
 *
 * @author Justus
 */
interface AdminInterface
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
     * @return array
     */
    static function getMenuFields();
    /**
     * method
     * 
     * @return array
     */
    static function getPageActions();
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
     * @return mixed
     */
    static function getAdminMenuPage($id);
    /**
     * method
     * 
     * 
     * @return AdminMenuPageHelperInterface
     */
    static function addAdminMenuPage($title, callable $content, $menuTitle = null, $id = null, $capability = null, $iconUrl = null, $position = null);
    /**
     * method
     * 
     * 
     * @return AdminMenuPageHelperInterface
     */
    static function addPlugInAdminMenuPage($title, callable $content, $menuTitle = null, $id = null, $iconUrl = null, $position = null);
    /**
     * method
     * 
     * 
     * @return AdminMenuPageHelperInterface
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
     * @return AdminFormHelperInterface
     */
    static function addAdminForm($title, $id, $action = null, $columns = 1, $hideKey = true);
    /**
     * method
     * 
     * 
     * @return AdminTableHelperInterface
     */
    static function addAdminTable($title, $id = null, $singularItemName = "Item", $pluralItemName = "Items", $keyColumnId = null, callable $detailView = null, $allowNew = false, $allowDelete = false, $allowEdit = false, array $additionalActions = null, $ajax = false);
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
    static function numberInputField($label, $name = null, $value = null, $id = null, $hint = null, $span = false, $readOnly = false, $disabled = false, $echo = false);
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
    static function checkBoxInputField($label, $name = null, $value = null, $id = null, $hint = null, $span = false, $readOnly = false, $disabled = false, $echo = false);
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
    static function customInputField($label, callable $html, callable $load, callable $post, callable $validate, $name = null, $value = null, $id = null, $hint = null, $span = false, $readOnly = false, $disabled = false, $echo = false);
    /**
     * method
     * 
     * 
     * @return array
     */
    static function button($label, $id = null, $hint = null, AdminFormHelperInterface $form = null, $span = false, $disabled = false, $javaScript = null, $ajaxCall = false, $echo = true);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function notify($message, $notice = "info", $dismissable = false, $echo = false);
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
     * @return void
     */
    static function addAdminMetaBox($id, $title, callable $content, array $screen = [], $context = "advanced", $priority = "default");
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
     * @return ?int
     */
    static function getCurrentAdminObjectId();
    /**
     * method
     * 
     * @return ?object
     */
    static function getCurrentAdminObject();
}