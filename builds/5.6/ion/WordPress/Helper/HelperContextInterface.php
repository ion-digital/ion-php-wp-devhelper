<?php
namespace ion\WordPress\Helper;

use ion\SemVerInterface;
use ion\WordPress\Helper\WordPressHelperLogInterface;
interface HelperContextInterface
{
    /**
     * method
     * 
     * @return void
     */
    static function uninstall();
    /**
     * method
     * 
     * 
     * @return HelperContextInterface
     */
    function setParent(HelperContextInterface $context = null);
    /**
     * method
     * 
     * @return ?HelperContextInterface
     */
    function getParent();
    /**
     * method
     * 
     * @return bool
     */
    function hasParent();
    /**
     * method
     * 
     * @return array
     */
    function getChildren();
    /**
     * method
     * 
     * @return bool
     */
    function hasChildren();
    /**
     * method
     * 
     * 
     * @return void
     */
    function addChild(HelperContextInterface $child);
    /**
     * method
     * 
     * @return WordPressHelperLogInterface
     */
    function getLog();
    /**
     * method
     * 
     * @return bool
     */
    function isFinalized();
    /**
     * method
     * 
     * @return bool
     */
    function isInitialized();
    /**
     * method
     * 
     * @return int
     */
    function getId();
    /**
     * method
     * 
     * @return string
     */
    function getPackageName();
    /**
     * method
     * 
     * @return string
     */
    function getVendorName();
    /**
     * method
     * 
     * @return string
     */
    function getProjectName();
    /**
     * method
     * 
     * @return bool
     */
    function isPrimary();
    /**
     * method
     * 
     * 
     * @return callable
     */
    function getView($viewSlug);
    /**
     * method
     * 
     * @return string
     */
    function getWorkingUri();
    /**
     * method
     * 
     * @return string
     */
    function getWorkingDirectory();
    /**
     * method
     * 
     * @return string
     */
    function getLoadPath();
    /**
     * method
     * 
     * @return string
     */
    function getViewDirectory();
    /**
     * method
     * 
     * @return ?callable
     */
    function getInitializeOperation();
    /**
     * method
     * 
     * @return ?callable
     */
    function getActivateOperation();
    /**
     * method
     * 
     * @return ?callable
     */
    function getDeactivateOperation();
    /**
     * method
     * 
     * @return ?array
     */
    function getUninstallOperation();
    /**
     * method
     * 
     * @return ?callable
     */
    function getFinalizeOperation();
    /**
     * method
     * 
     * 
     * @return HelperContextInterface
     */
    function setInitializeOperation(callable $operation = null);
    /**
     * method
     * 
     * 
     * @return HelperContextInterface
     */
    function setActivateOperation(callable $operation = null);
    /**
     * method
     * 
     * 
     * @return HelperContextInterface
     */
    function setDeactivateOperation(callable $operation = null);
    /**
     * method
     * 
     * 
     * @return HelperContextInterface
     */
    function setUninstallOperation(array $operation = null);
    /**
     * method
     * 
     * 
     * @return ?HelperContextInterface
     */
    function setFinalizeOperation(callable $operation = null);
    /**
     * method
     * 
     * @return bool
     */
    function hasInitializeOperation();
    /**
     * method
     * 
     * @return bool
     */
    function hasActivateOperation();
    /**
     * method
     * 
     * @return bool
     */
    function hasDeactivateOperation();
    /**
     * method
     * 
     * @return bool
     */
    function hasUninstallOperation();
    /**
     * method
     * 
     * @return bool
     */
    function hasFinalizeOperation();
    /**
     * method
     * 
     * @return void
     */
    function invokeInitializeOperation();
    /**
     * method
     * 
     * @return void
     */
    function invokeFinalizeOperation();
    /**
     * method
     * 
     * @return void
     */
    function invokeActivateOperation();
    /**
     * method
     * 
     * @return void
     */
    function invokeDeactivateOperation();
    /**
     * method
     * 
     * @return void
     */
    function invokeUninstallOperation();
    /**
     * method
     * 
     * @return int
     */
    function getType();
    /**
     * method
     * 
     * @return ?int
     */
    function getActivationTimeStamp();
    /**
     * method
     * 
     * @return ?SemVerInterface
     */
    function getVersion();
    /**
     * method
     * 
     * @return ?SemVerInterface
     */
    function getActivationVersion();
    /**
     * method
     * 
     * 
     * @return array
     */
    function getTemplates($flat = true, $themeOnly = false, $labels = false, $nullItem = null, $relativePath = null);
    /**
     * method
     * 
     * 
     * @return bool
     */
    function templateExists($name);
    /**
     * method
     * 
     * 
     * @return string
     */
    function template($name, $echo = false);
}