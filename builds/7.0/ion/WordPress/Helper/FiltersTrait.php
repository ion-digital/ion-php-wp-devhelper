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
trait FiltersTrait
{
    private static $filters = [];
    /**
     * method
     * 
     * @return mixed
     */
    protected static function initialize()
    {
        static::registerWrapperAction('init', function () {
            foreach (array_keys(static::$filters) as $key) {
                usort(static::$filters[$key], function ($a, $b) {
                    if ($a['order'] > $b['order']) {
                        return 1;
                    }
                    if ($a['order'] < $b['order']) {
                        return -1;
                    }
                    return 0;
                });
                foreach (static::$filters[$key] as $filter) {
                    add_filter($key, $filter['function'], $filter['priority'], $filter['args']);
                }
            }
        });
    }
    /**
     * method
     * 
     * 
     * @return void
     */
    public static function addFilter(string $name, callable $function, int $priority = null, int $args = null, int $order = null)
    {
        static::$filters[$name][] = ['function' => $function, 'priority' => $priority, 'args' => $args, 'order' => $order === null ? 0 : $order];
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public static function removeFilter(string $name, callable $function, int $priority = null)
    {
        if (array_key_exists($name, static::$filters)) {
            unset(static::$filters[$name]);
        }
        remove_filter($name, $function, $priority === null ? 10 : $priority);
    }
    /**
     * method
     * 
     * 
     * @return void
     */
    public static function addContentFilter(callable $function)
    {
        static::addFilter('the_content', $function);
    }
}