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
    static function &getContexts() : array;
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
    static function getContext(string $slug = null) : HelperContextInterface;
    /**
     * method
     * 
     * @return HelperContextInterface
     */
    static function getCurrentContext() : HelperContextInterface;
    /**
     * method
     * 
     * @return bool
     */
    static function isHelperConstructed() : bool;
    /**
     * method
     * 
     * @return bool
     */
    static function isHelperInitialized() : bool;
    /**
     * method
     * 
     * 
     * @return string
     */
    static function slugify(string $s) : string;
    /**
     * method
     * 
     * @return bool
     */
    static function isDebugMode() : bool;
    /**
     * method
     * 
     * 
     * @return void
     */
    static function panic(string $errorMessage, int $httpCode = null, string $title = null);
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function hasCapability(string $capability, int $user = null) : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function hasManageOptionsCapability(int $user = null) : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function hasEditThemeOptionsCapability(int $user = null) : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function hasManageNetworkCapability(int $user = null) : bool;
    /**
     * method
     * 
     * @return bool
     */
    static function isLoggedIn() : bool;
    /**
     * method
     * 
     * 
     * @return WordPressHelperInterface
     */
    static function createContext(string $vendorName, string $projectName, string $loadPath, string $helperDir = null, array $wpHelperSettings = null, SemVerInterface $version = null, callable $construct = null, callable $initialize = null, callable $finalize = null, callable $activate = null, callable $deactivate = null, array $uninstall = null) : WordPressHelperInterface;
    /**
     * method
     * 
     * 
     * @return WordPressHelperInterface
     */
    function construct(callable $call = null) : WordPressHelperInterface;
    /**
     * method
     * 
     * 
     * @return WordPressHelperInterface
     */
    function initialize(callable $call = null) : WordPressHelperInterface;
    /**
     * method
     * 
     * 
     * @return WordPressHelperInterface
     */
    function finalize(callable $call = null) : WordPressHelperInterface;
    /**
     * method
     * 
     * 
     * @return WordPressHelperInterface
     */
    function activate(callable $call = null) : WordPressHelperInterface;
    /**
     * method
     * 
     * 
     * @return WordPressHelperInterface
     */
    function deactivate(callable $call = null) : WordPressHelperInterface;
    /**
     * method
     * 
     * 
     * @return WordPressHelperInterface
     */
    function uninstall(array $call = null) : WordPressHelperInterface;
    /**
     * method
     * 
     * 
     * @return WordPressHelperInterface
     */
    static function extend(string $name, callable $extension) : WordPressHelperInterface;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function __callStatic(string $name, array $arguments);
}