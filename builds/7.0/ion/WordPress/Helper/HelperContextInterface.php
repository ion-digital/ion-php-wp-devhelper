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
     * @return WordPressHelperLogInterface
     */
    function getLog() : WordPressHelperLogInterface;
    /**
     * method
     * 
     * @return bool
     */
    function isFinalized() : bool;
    /**
     * method
     * 
     * @return bool
     */
    function isInitialized() : bool;
    /**
     * method
     * 
     * @return int
     */
    function getId() : int;
    /**
     * method
     * 
     * @return string
     */
    function getPackageName() : string;
    /**
     * method
     * 
     * @return string
     */
    function getVendorName() : string;
    /**
     * method
     * 
     * @return string
     */
    function getProjectName() : string;
    /**
     * method
     * 
     * @return bool
     */
    function isPrimary() : bool;
    /**
     * method
     * 
     * 
     * @return callable
     */
    function getView(string $viewSlug) : callable;
    /**
     * method
     * 
     * @return string
     */
    function getWorkingUri() : string;
    /**
     * method
     * 
     * @return string
     */
    function getWorkingDirectory() : string;
    /**
     * method
     * 
     * @return string
     */
    function getLoadPath() : string;
    /**
     * method
     * 
     * @return string
     */
    function getViewDirectory() : string;
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
    function setInitializeOperation(callable $operation = null) : HelperContextInterface;
    /**
     * method
     * 
     * 
     * @return HelperContextInterface
     */
    function setActivateOperation(callable $operation = null) : HelperContextInterface;
    /**
     * method
     * 
     * 
     * @return HelperContextInterface
     */
    function setDeactivateOperation(callable $operation = null) : HelperContextInterface;
    /**
     * method
     * 
     * 
     * @return HelperContextInterface
     */
    function setUninstallOperation(array $operation = null) : HelperContextInterface;
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
    function hasInitializeOperation() : bool;
    /**
     * method
     * 
     * @return bool
     */
    function hasActivateOperation() : bool;
    /**
     * method
     * 
     * @return bool
     */
    function hasDeactivateOperation() : bool;
    /**
     * method
     * 
     * @return bool
     */
    function hasUninstallOperation() : bool;
    /**
     * method
     * 
     * @return bool
     */
    function hasFinalizeOperation() : bool;
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
     * @return void
     */
    function invokeFinalizeOperation();
    /**
     * method
     * 
     * @return int
     */
    function getType() : int;
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
     * @return HelperContextInterface
     */
    function setParent(HelperContextInterface $context = null) : HelperContextInterface;
    /**
     * method
     * 
     * @return ?HelperContextInterface
     */
    function getParent();
    /**
     * method
     * 
     * @return array
     */
    function getChildren() : array;
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
     * 
     * @return array
     */
    function getTemplates(bool $flat = true, bool $themeOnly = false, bool $labels = false, string $nullItem = null, string $relativePath = null) : array;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function templateExists(string $name) : bool;
    /**
     * method
     * 
     * 
     * @return string
     */
    function template(string $name, bool $echo = false) : string;
}