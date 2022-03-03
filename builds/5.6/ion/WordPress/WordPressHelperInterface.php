<?php
namespace ion\WordPress;

use ion\WordPress\Helper\HelperContextInterface;
use ion\SemVerInterface;
use ion\WordPress\Helper\ActionsInterface;
use ion\WordPress\Helper\AdminInterface;
use ion\WordPress\Helper\CommonInterface;
use ion\WordPress\Helper\CronInterface;
use ion\WordPress\Helper\DatabaseInterface;
use ion\WordPress\Helper\FiltersInterface;
use ion\WordPress\Helper\TemplateInterface;
use ion\WordPress\Helper\LoggingInterface;
use ion\WordPress\Helper\OptionsInterface;
use ion\WordPress\Helper\PathsInterface;
use ion\WordPress\Helper\PostsInterface;
use ion\WordPress\Helper\RewritesInterface;
use ion\WordPress\Helper\ShortCodesInterface;
use ion\WordPress\Helper\TaxonomiesInterface;
use ion\WordPress\Helper\WidgetsInterface;
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
    static function createContext($vendorName, $projectName, $loadPath, $helperDir = null, array $wpHelperSettings = null, SemVerInterface $version = null, callable $initialize = null, callable $finalize = null, callable $activate = null, callable $deactivate = null, array $uninstall = null);
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
    function finalize(callable $call = null);
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
    /**
     * method
     * 
     * 
     * @return void
     */
    static function extend($name, callable $extension);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function __callStatic($name, array $arguments);
}