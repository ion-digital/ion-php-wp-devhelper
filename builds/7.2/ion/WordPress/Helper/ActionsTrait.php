<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

use Throwable;
use WP_Post;
use ion\WordPress\WordPressHelperInterface;
use ion\WordPress\Helper\Tools;
use ion\WordPress\Helper\Constants;
use ion\PhpHelper as PHP;
use ion\Package;
use ion\SemVerInterface;
use ion\SemVer;
/**
 *
 * @author Justus
 */
trait ActionsTrait
{
    //    private static $actions = [];
    private static $ajaxActions = [];
    private static $formActions = [];
    protected static function initialize()
    {
        //        static::registerWrapperAction('init', function() {
        //
        //            foreach (array_keys(static::$actions) as $key) {
        //
        //                foreach (static::$actions[$key] as $action) {
        //
        //                    add_action($key, $action['function'], $action['priority']);
        //                }
        //            }
        //        });
        // NOTE: admin-post.php and admin-ajax.php don't seem to fire 'init', so
        // both front-end and back-end hooks get created on 'admin_init'
        static::registerWrapperAction('admin_init', function () {
            foreach (static::$ajaxActions as $action) {
                if ($action['frontEnd'] === true) {
                    add_action('wp_ajax_nopriv_' . $action['name'], $action['action']);
                }
                if ($action['backEnd'] === true) {
                    add_action('wp_ajax_' . $action['name'], $action['action']);
                }
            }
            foreach (static::$formActions as $action) {
                if ($action['frontEnd'] === true) {
                    add_action('admin_post_nopriv_' . $action['name'], $action['action']);
                }
                if ($action['backEnd'] === true) {
                    add_action('admin_post_' . $action['name'], $action['action']);
                }
            }
            //            echo '<pre>';
            //            var_dump(static::$formActions);
            //            var_dump($GLOBALS['wp_filter']);
            //            die('</pre>');
        });
    }
    public static function addAction(string $name, callable $function, int $priority = null) : void
    {
        //        static::$actions[$name][] = [
        //
        //            'function' => $function,
        //            'priority' => ($priority === null ? 10 : $priority)
        //        ];
        add_action($name, $function, $priority ?? 10);
    }
    public static function removeAction(string $name, callable $function, int $priority = null)
    {
        //        if (array_key_exists($name, static::$actions)) {
        //
        //            unset(static::$actions[$name]);
        //        }
        remove_action($name, $function, $priority === null ? 10 : $priority);
    }
    public static function addAjaxAction(string $name, callable $action, bool $backEnd = true, bool $frontEnd = false)
    {
        static::$ajaxActions[] = ['name' => $name, 'action' => $action, 'backEnd' => $backEnd, 'frontEnd' => $frontEnd];
    }
    public static function addFormAction(string $name, callable $action, bool $backEnd = true, bool $frontEnd = false)
    {
        static::$formActions[] = ['name' => $name, 'action' => $action, 'backEnd' => $backEnd, 'frontEnd' => $frontEnd];
    }
    public static function hasAction(string $name) : bool
    {
        return (bool) has_action($name, false);
    }
    public static function getActionPriority(string $name, callable $action) : ?int
    {
        if (static::hasAction($name)) {
            return (int) has_action($name, $action);
        }
        return null;
    }
}