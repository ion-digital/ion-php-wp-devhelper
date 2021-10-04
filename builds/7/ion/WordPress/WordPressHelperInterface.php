<?php

namespace ion\WordPress;

use \ion\WordPress\Helper\HelperContextInterface;
use \ion\SemVerInterface;
use \ion\WordPress\Helper\Wrappers\ActionsInterface;
use \ion\WordPress\Helper\Wrappers\AdminInterface;
use \ion\WordPress\Helper\Wrappers\CommonInterface;
use \ion\WordPress\Helper\Wrappers\CronInterface;
use \ion\WordPress\Helper\Wrappers\DatabaseInterface;
use \ion\WordPress\Helper\Wrappers\FiltersInterface;
use \ion\WordPress\Helper\Wrappers\TemplateInterface;
use \ion\WordPress\Helper\Wrappers\LoggingInterface;
use \ion\WordPress\Helper\Wrappers\OptionsInterface;
use \ion\WordPress\Helper\Wrappers\PathsInterface;
use \ion\WordPress\Helper\Wrappers\PostsInterface;
use \ion\WordPress\Helper\Wrappers\RewritesInterface;
use \ion\WordPress\Helper\Wrappers\ShortCodesInterface;
use \ion\WordPress\Helper\Wrappers\TaxonomiesInterface;
use \ion\WordPress\Helper\Wrappers\WidgetsInterface;

interface WordPressHelperInterface extends 

    ActionsInterface,
    AdminInterface,
    CommonInterface,
    CronInterface,
    DatabaseInterface,
    FiltersInterface,
    TemplateInterface,
    LoggingInterface,
    OptionsInterface,
    PathsInterface,
    PostsInterface,
    RewritesInterface,
    ShortCodesInterface,
    TaxonomiesInterface,
    WidgetsInterface

 {

    static function &getContexts(): array;

    static function getContentDirectory();

    static function getContext(string $slug = null): HelperContextInterface;

    static function getCurrentContext(): HelperContextInterface;

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

    static function createContext(

        string $vendorName,
        string $projectName,
        string $loadPath,
        string $helperDir = null,
        array $wpHelperSettings = null,
        SemVerInterface $version = null,
        callable $initialize = null,
        callable $activate = null,
        callable $deactivate = null,
        callable $finalize = null,
        array $uninstall = null

    ): WordPressHelperInterface;

    function initialize(callable $call = null): WordPressHelperInterface;

    function activate(callable $call = null): WordPressHelperInterface;

    function deactivate(callable $call = null): WordPressHelperInterface;

    function uninstall(array $call = null): WordPressHelperInterface;

    function finalize(callable $call = null): WordPressHelperInterface;

}
