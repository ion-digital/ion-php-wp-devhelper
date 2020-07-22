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
    
    function getId() : int;
    
    //    function getSlug(): string;
    /**
     * method
     * 
     * @return IWordPressHelperLog
     */
    
    function getLog() : IWordPressHelperLog;
    
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
    
    function getLoadPath() : string;
    
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
    
    function getViewDirectory() : string;
    
    /**
     * method
     * 
     * @return int
     */
    
    function getType() : int;
    
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
     * @return array
     */
    
    function getChildren() : array;
    
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
     * 
     * @return self
     */
    
    function setParent(IHelperContext $context = null) : self;
    
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