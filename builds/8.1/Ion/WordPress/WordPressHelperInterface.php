<?php
namespace Ion\WordPress;

use Ion\WordPress\Helper\ActionsInterface;
use Ion\WordPress\Helper\AdminInterface;
use Ion\WordPress\Helper\CommonInterface;
use Ion\WordPress\Helper\CronInterface;
use Ion\WordPress\Helper\DatabaseInterface;
use Ion\WordPress\Helper\FiltersInterface;
use Ion\WordPress\Helper\TemplateInterface;
use Ion\WordPress\Helper\LoggingInterface;
use Ion\WordPress\Helper\OptionsInterface;
use Ion\WordPress\Helper\PathsInterface;
use Ion\WordPress\Helper\PostsInterface;
use Ion\WordPress\Helper\RewritesInterface;
use Ion\WordPress\Helper\ShortCodesInterface;
use Ion\WordPress\Helper\TaxonomiesInterface;
use Ion\WordPress\Helper\WidgetsInterface;
interface WordPressHelperInterface extends ActionsInterface, AdminInterface, CommonInterface, CronInterface, DatabaseInterface, FiltersInterface, TemplateInterface, LoggingInterface, OptionsInterface, PathsInterface, PostsInterface, RewritesInterface, ShortCodesInterface, TaxonomiesInterface, WidgetsInterface
{
    function initialize(callable $call = null) : WordPressHelperInterface;
    function finalize(callable $call = null) : WordPressHelperInterface;
    function activate(callable $call = null) : WordPressHelperInterface;
    function deactivate(callable $call = null) : WordPressHelperInterface;
    function uninstall(array $call = null) : WordPressHelperInterface;
}