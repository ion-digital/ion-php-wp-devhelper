<?php

namespace Ion\WordPress;

use \Ion\WordPress\Helper\HelperContextInterface;
use \Ion\SemVerInterface;
use \Ion\WordPress\Helper\ActionsInterface;
use \Ion\WordPress\Helper\AdminInterface;
use \Ion\WordPress\Helper\CommonInterface;
use \Ion\WordPress\Helper\CronInterface;
use \Ion\WordPress\Helper\DatabaseInterface;
use \Ion\WordPress\Helper\FiltersInterface;
use \Ion\WordPress\Helper\TemplateInterface;
use \Ion\WordPress\Helper\LoggingInterface;
use \Ion\WordPress\Helper\OptionsInterface;
use \Ion\WordPress\Helper\PathsInterface;
use \Ion\WordPress\Helper\PostsInterface;
use \Ion\WordPress\Helper\RewritesInterface;
use \Ion\WordPress\Helper\ShortCodesInterface;
use \Ion\WordPress\Helper\TaxonomiesInterface;
use \Ion\WordPress\Helper\WidgetsInterface;

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
