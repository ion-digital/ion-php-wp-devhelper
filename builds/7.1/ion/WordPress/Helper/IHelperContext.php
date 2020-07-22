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
    
    function getVersion() : ?ISemVer;
    
    /**
     * method
     * 
     * @return ?ISemVer
     */
    
    function getActivationVersion() : ?ISemVer;
    
    /**
     * method
     * 
     * @return ?int
     */
    
    function getActivationTimeStamp() : ?int;
    
    /**
     * method
     * 
     * @return ?self
     */
    
    function getParent() : ?self;
    
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
    
    function getInitializeOperation() : ?callable;
    
    /**
     * method
     * 
     * @return ?callable
     */
    
    function getActivateOperation() : ?callable;
    
    /**
     * method
     * 
     * @return ?callable
     */
    
    function getDeactivateOperation() : ?callable;
    
    /**
     * method
     * 
     * @return ?array
     */
    
    function getUninstallOperation() : ?array;
    
    /**
     * method
     * 
     * @return ?callable
     */
    
    function getFinalizeOperation() : ?callable;
    
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
    
    function invokeInitializeOperation() : void;
    
    /**
     * method
     * 
     * @return void
     */
    
    function invokeActivateOperation() : void;
    
    /**
     * method
     * 
     * @return void
     */
    
    function invokeDeactivateOperation() : void;
    
    /**
     * method
     * 
     * @return void
     */
    
    function invokeUninstallOperation() : void;
    
    /**
     * method
     * 
     * @return void
     */
    
    function invokeFinalizeOperation() : void;
    
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