<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper;

/**
 *
 * @author Justus
 */

use \ion\ISemVer;
use \ion\Types\Arrays\IVector;
use \ion\WordPress\Helper\IWordPressHelperLog;

interface IHelperContext {
    
//    static function create(
//            
//            string $vendorName,
//            string $projectName,
//            string $loadPath, 
//            string $helperDir = null, 
//            array $wpHelperSettings = null,
//            ISemVer $version = null): self;
    
    function getId(): int;

//    function getSlug(): string;
    
    
    function getLog(): IWordPressHelperLog;        

    function getPackageName(): string;
    
    function getVendorName(): string;

    function getProjectName(): string;
    
    function isPrimary(): bool;

    function getView(string $viewSlug): callable;
    
    function getWorkingUri(): string;
    
    function getLoadPath(): string;
    
    function getWorkingDirectory(): string;         
    
    function getViewDirectory(): string;
    
    function getType(): int;
    
    function getVersion(): ?ISemVer;
    
    function getActivationVersion(): ?ISemVer;
    
    function getActivationTimeStamp(): ?int;

    
    function getParent(): ?self;
    
    function getChildren(): IVector;
    
    
    function getInitializeOperation() : ?callable;
    
    function getActivateOperation() : ?callable;
    
    function getDeactivateOperation() : ?callable;    
    
    function getUninstallOperation() : ?array;
    
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
    
    
    function hasInitializeOperation(): bool;

    function hasActivateOperation(): bool;
    
    function hasDeactivateOperation(): bool;
    
    function hasUninstallOperation(): bool;
    
    function hasFinalizeOperation(): bool;
    
    
    function invokeInitializeOperation(): void;
    
    function invokeActivateOperation(): void;
    
    function invokeDeactivateOperation(): void;

    function invokeUninstallOperation(): void;

    function invokeFinalizeOperation(): void;
        
    
    function isFinalized(): bool;
    
    function isInitialized(): bool;    
    
    function setParent(IHelperContext $context = null): self;
    
    function getTemplates(bool $flat = true, bool $themeOnly = false, bool $labels = false, string $nullItem = null, string $relativePath = null): array;

    function templateExists(string $name): bool;
    
    function template(string $name, bool $echo = false): string;     
    
}
