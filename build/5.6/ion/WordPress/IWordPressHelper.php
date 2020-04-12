<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress;

/**
 *
 * @author Justus
 */
use ion\WordPress\Helper\Wrappers\IActions;
use ion\WordPress\Helper\Wrappers\IAdmin;
use ion\WordPress\Helper\Wrappers\ICommon;
use ion\WordPress\Helper\Wrappers\ICron;
use ion\WordPress\Helper\Wrappers\IDatabase;
use ion\WordPress\Helper\Wrappers\IFilters;
use ion\WordPress\Helper\Wrappers\ITemplate;
use ion\WordPress\Helper\Wrappers\ILogging;
use ion\WordPress\Helper\Wrappers\IOptions;
use ion\WordPress\Helper\Wrappers\IPaths;
use ion\WordPress\Helper\Wrappers\IPosts;
use ion\WordPress\Helper\Wrappers\IRewrites;
use ion\WordPress\Helper\Wrappers\IShortCodes;
use ion\WordPress\Helper\Wrappers\ITaxonomies;
use ion\WordPress\Helper\Wrappers\IWidgets;
use ion\ISemVer;
use ion\Types\Arrays\IMap;
use ion\Types\Arrays\IVector;
use ion\WordPress\Helper\IHelperContext;

interface IWordPressHelper extends IActions, IAdmin, ICommon, ICron, IDatabase, IFilters, ITemplate, ILogging, IOptions, IPaths, IPosts, IRewrites, IShortCodes, ITaxonomies, IWidgets
{
    /**
     * method
     * 
     * 
     * @return self
     */
    
    static function createContext($vendorName, $projectName, $loadPath, $helperDir = null, array $wpHelperSettings = null, ISemVer $version = null, callable $initialize = null, callable $activate = null, callable $deactivate = null, callable $finalize = null, array $uninstall = null);
    
    /**
     * method
     * 
     * @return array
     */
    
    static function &getContexts();
    
    /**
     * method
     * 
     * @return IHelperContext
     */
    
    static function getCurrentContext();
    
    //    static function context(): IWordPressHelper; // deprecated!
    /**
     * method
     * 
     * 
     * @return IHelperContext
     */
    
    static function getContext($slug = null);
    
    /**
     * method
     * 
     * @return bool
     */
    
    static function isHelperInitialized();
    
    /**
     * method
     * 
     * @return bool
     */
    
    static function isHelperFinalized();
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function slugify($s);
    
    /**
     * method
     * 
     * @return bool
     */
    
    static function isDebugMode();
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function panic($errorMessage, $httpCode = null, $title = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasCapability($capability, $user = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasManageOptionsCapability($user = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasEditThemeOptionsCapability($user = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasManageNetworkCapability($user = null);
    
    /**
     * method
     * 
     * @return bool
     */
    
    static function isLoggedIn();
    
    //static function addCustomPostType(string $singularItemName, string $pluralItemName = null, bool $public = true, bool $hasArchive = false, array $labels = null, string $description = '', ): bool;
    //static function addCustomPostType(IWordPressCustomPostType $customPostType): IWordPressCustomPostType;
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function initialize(callable $call = null);
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function activate(callable $call = null);
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function deactivate(callable $call = null);
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function uninstall(array $call = null);
    
    /**
     * method
     * 
     * 
     * @return self
     */
    
    function finalize(callable $call = null);

}