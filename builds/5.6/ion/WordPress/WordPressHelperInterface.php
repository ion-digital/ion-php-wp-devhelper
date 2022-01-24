<?php
namespace ion\WordPress;

use ion\WordPress\Helper\HelperContextInterface;
use ion\SemVerInterface;
use ion\WordPress\Helper\Wrappers\ActionsInterface;
use ion\WordPress\Helper\Wrappers\AdminInterface;
use ion\WordPress\Helper\Wrappers\CommonInterface;
use ion\WordPress\Helper\Wrappers\CronInterface;
use ion\WordPress\Helper\Wrappers\DatabaseInterface;
use ion\WordPress\Helper\Wrappers\FiltersInterface;
use ion\WordPress\Helper\Wrappers\TemplateInterface;
use ion\WordPress\Helper\Wrappers\LoggingInterface;
use ion\WordPress\Helper\Wrappers\OptionsInterface;
use ion\WordPress\Helper\Wrappers\PathsInterface;
use ion\WordPress\Helper\Wrappers\PostsInterface;
use ion\WordPress\Helper\Wrappers\RewritesInterface;
use ion\WordPress\Helper\Wrappers\ShortCodesInterface;
use ion\WordPress\Helper\Wrappers\TaxonomiesInterface;
use ion\WordPress\Helper\Wrappers\WidgetsInterface;
interface WordPressHelperInterface extends ActionsInterface, AdminInterface, CommonInterface, CronInterface, DatabaseInterface, FiltersInterface, TemplateInterface, LoggingInterface, OptionsInterface, PathsInterface, PostsInterface, RewritesInterface, ShortCodesInterface, TaxonomiesInterface, WidgetsInterface
{
    /**
     * method
     * 
     * @return array
     */
    static function &getContexts();
    /**
     * method
     * 
     * @return mixed
     */
    static function getContentDirectory();
    /**
     * method
     * 
     * 
     * @return HelperContextInterface
     */
    static function getContext($slug = null);
    /**
     * method
     * 
     * @return HelperContextInterface
     */
    static function getCurrentContext();
    /**
     * method
     * 
     * @return bool
     */
    static function isHelperConstructed();
    /**
     * method
     * 
     * @return bool
     */
    static function isHelperInitialized();
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
    /**
     * method
     * 
     * 
     * @return WordPressHelperInterface
     */
    static function createContext($vendorName, $projectName, $loadPath, $helperDir = null, array $wpHelperSettings = null, SemVerInterface $version = null, callable $construct = null, callable $initialize = null, callable $activate = null, callable $deactivate = null, array $uninstall = null);
    /**
     * method
     * 
     * 
     * @return WordPressHelperInterface
     */
    function construct(callable $call = null);
    /**
     * method
     * 
     * 
     * @return WordPressHelperInterface
     */
    function initialize(callable $call = null);
    /**
     * method
     * 
     * 
     * @return WordPressHelperInterface
     */
    function activate(callable $call = null);
    /**
     * method
     * 
     * 
     * @return WordPressHelperInterface
     */
    function deactivate(callable $call = null);
    /**
     * method
     * 
     * 
     * @return WordPressHelperInterface
     */
    function uninstall(array $call = null);
}