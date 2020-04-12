<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 *
 * @author Justus
 */
use ion\ISemVer;
use ion\Types\Arrays\IVector;
use ion\WordPress\Helper\IWordPressHelperLog;

interface IHelperContext
{
    //    static function create(
    //
    //            string $vendorName,
    //            string $projectName,
    //            string $loadPath,
    //            string $helperDir = null,
    //            array $wpHelperSettings = null,
    //            ISemVer $version = null): self;
    /**
     * method
     * 
     * @return int
     */
    
    function getId();
    
    //    function getSlug(): string;
    /**
     * method
     * 
     * @return IWordPressHelperLog
     */
    
    function getLog();
    
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
    
    function getLoadPath();
    
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
    
    function getViewDirectory();
    
    /**
     * method
     * 
     * @return int
     */
    
    function getType();
    
    /**
     * method
     * 
     * @return ?ISemVer
     */
    
    function getVersion();
    
    /**
     * method
     * 
     * @return ?ISemVer
     */
    
    function getActivationVersion();
    
    /**
     * method
     * 
     * @return ?int
     */
    
    function getActivationTimeStamp();
    
    /**
     * method
     * 
     * @return ?self
     */
    
    function getParent();
    
    /**
     * method
     * 
     * @return IVector
     */
    
    function getChildren();
    
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
    
    //    function setInitializeOperation(callable $operation = null) : IContext;
    //
    //    function setActivateOperation(callable $operation = null) : IContext;
    //
    //    function setDeactivateOperation(callable $operation = null) : IContext;
    //
    ////    function setUninstallOperation(callable $operation = null) : IContext;
    //
    //    function setFinalizeOperation(callable $operation = null) : ?IContext;
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
     * 
     * @return self
     */
    
    function setParent(IHelperContext $context = null);
    
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