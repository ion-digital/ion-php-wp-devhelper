<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace Ion\WordPress\Helper;

use \Throwable;
use \WP_Post;
use \Ion\WordPress\WordPressHelperInterface;
use \Ion\WordPress\Helper\Tools;
use \Ion\WordPress\Helper\Constants;
use \Ion\PhpHelper as PHP;
use \Ion\Package;
use \Ion\SemVerInterface;
use \Ion\SemVer;

/**
 *
 * @author Justus
 */
trait FiltersTrait {

    private static $filters = [];    
    
    protected static function initialize() {    
        
        static::registerWrapperAction('init', function() {
            
            foreach (array_keys(static::$filters) as $key) {                                
                
                usort(static::$filters[$key], function($a, $b) {

                    if($a['order'] > $b['order']) {

                        return 1;
                    }

                    if($a['order'] < $b['order']) {

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
    
    public static function addFilter(string $name, callable $function, int $priority = null, int $args = null, int $order = null): void {

        static::$filters[$name][] = [ 'function' => $function, 'priority' => $priority, 'args' => $args, 'order' => ($order === null ? 0 : $order) ];
    }       
    
    public static function removeFilter(string $name, callable $function, int $priority = null) {

        if (array_key_exists($name, static::$filters)) {
            
            unset(static::$filters[$name]);
        }

        remove_filter($name, $function, ($priority === null ? 10 : $priority));
    }    

    public static function addContentFilter(callable $function): void {
        
        static::addFilter('the_content', $function);
    }    
}
