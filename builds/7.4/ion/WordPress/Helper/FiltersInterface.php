<?php
namespace ion\WordPress\Helper;

/**
 *
 * @author Justus
 */
interface FiltersInterface
{
    static function addFilter(string $name, callable $function, int $priority = null, int $args = null, int $order = null) : void;
    static function removeFilter(string $name, callable $function, int $priority = null);
    static function addContentFilter(callable $function) : void;
}