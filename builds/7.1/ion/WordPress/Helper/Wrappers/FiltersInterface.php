<?php
namespace ion\WordPress\Helper\Wrappers;

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
    static function addFilter(string $name, callable $function, int $priority = null, int $args = null, int $order = null) : void;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function removeFilter(string $name, callable $function, int $priority = null);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addContentFilter(callable $function) : void;
}