<?php

namespace ion\WordPress;

use \ion\WordPress\Helper\HelperContextInterface;
use \ion\SemVerInterface;
use \ion\WordPress\Helper\ActionsInterface;
use \ion\WordPress\Helper\AdminInterface;
use \ion\WordPress\Helper\CommonInterface;
use \ion\WordPress\Helper\CronInterface;
use \ion\WordPress\Helper\DatabaseInterface;
use \ion\WordPress\Helper\FiltersInterface;
use \ion\WordPress\Helper\TemplateInterface;
use \ion\WordPress\Helper\LoggingInterface;
use \ion\WordPress\Helper\OptionsInterface;
use \ion\WordPress\Helper\PathsInterface;
use \ion\WordPress\Helper\PostsInterface;
use \ion\WordPress\Helper\RewritesInterface;
use \ion\WordPress\Helper\ShortCodesInterface;
use \ion\WordPress\Helper\TaxonomiesInterface;
use \ion\WordPress\Helper\WidgetsInterface;

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
        callable $finalize = null,
        callable $activate = null,
        callable $deactivate = null,
        array $uninstall = null

    ): WordPressHelperInterface;

    function initialize(callable $call = null): WordPressHelperInterface;

    function finalize(callable $call = null): WordPressHelperInterface;

    function activate(callable $call = null): WordPressHelperInterface;

    function deactivate(callable $call = null): WordPressHelperInterface;

    function uninstall(array $call = null): WordPressHelperInterface;

    static function extend(string $name, callable $extension): void;

    static function __callStatic(string $name, array $arguments);

}
