<?php
namespace ion\WordPress\Helper;

/**
 *
 * @author Justus
 */
interface FiltersInterface
{
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addFilter($name, callable $function, $priority = null, $args = null, $order = null);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function removeFilter($name, callable $function, $priority = null);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addContentFilter(callable $function);
}