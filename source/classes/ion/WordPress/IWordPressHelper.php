<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress;


/**
 *
 * @author Justus
 */

use \ion\WordPress\Helper\Wrappers\IActions;
use \ion\WordPress\Helper\Wrappers\IAdmin;
use \ion\WordPress\Helper\Wrappers\ICommon;
use \ion\WordPress\Helper\Wrappers\ICron;
use \ion\WordPress\Helper\Wrappers\IDatabase;
use \ion\WordPress\Helper\Wrappers\IFilters;
use \ion\WordPress\Helper\Wrappers\ITemplate;
use \ion\WordPress\Helper\Wrappers\ILogging;
use \ion\WordPress\Helper\Wrappers\IOptions;
use \ion\WordPress\Helper\Wrappers\IPaths;
use \ion\WordPress\Helper\Wrappers\IPosts;
use \ion\WordPress\Helper\Wrappers\IRewrites;
use \ion\WordPress\Helper\Wrappers\IShortCodes;
use \ion\WordPress\Helper\Wrappers\ITaxonomies;
use \ion\WordPress\Helper\Wrappers\IWidgets;
use \ion\ISemVer;
use \ion\WordPress\Helper\IHelperContext;

interface IWordPressHelper extends

        IActions,
        IAdmin,
        ICommon,
        ICron,
        IDatabase,
        IFilters,
        ITemplate,
        ILogging,
        IOptions,
        IPaths,
        IPosts,
        IRewrites,
        IShortCodes,
        ITaxonomies,
        IWidgets
{
    
    static function createContext(
            
            string $vendorName,
            string $projectName,
            string $loadPath, 
            string $helperDir = null, 
            array $wpHelperSettings = null, 
            ISemVer $version = null,
            callable $initialize = null, 
            callable $activate = null, 
            callable $deactivate = null,
            callable $finalize = null,
            array $uninstall = null
            
    ): self;  
    
    static function &getContexts(): array;
    
    static function getCurrentContext(): IHelperContext;
    
//    static function context(): IWordPressHelper; // deprecated!
    
    static function getContext(string $slug = null): IHelperContext;

    static function isHelperInitialized(): bool;
    
    static function isHelperFinalized(): bool;

    static function slugify(string $s): string;    

    static function isDebugMode(): bool;

    static function panic(string $errorMessage, int $httpCode = null, string $title = null): void;

    static function hasCapability(string $capability, int $user = null): bool;

    static function hasManageOptionsCapability(int $user = null): bool;

    static function hasEditThemeOptionsCapability(int $user = null): bool;

    static function hasManageNetworkCapability(int $user = null): bool;
        
    static function isLoggedIn(): bool;

    //static function addCustomPostType(string $singularItemName, string $pluralItemName = null, bool $public = true, bool $hasArchive = false, array $labels = null, string $description = '', ): bool;
    //static function addCustomPostType(IWordPressCustomPostType $customPostType): IWordPressCustomPostType;

    function initialize(callable $call = null): self;
    
    function activate(callable $call = null): self;
    
    function deactivate(callable $call = null): self;
    
    function uninstall(array $call = null): self;
    
    function finalize(callable $call = null): self;
    
}
