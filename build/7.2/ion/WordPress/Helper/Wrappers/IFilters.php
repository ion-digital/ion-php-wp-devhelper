<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */

interface IFilters
{
    static function addFilter(string $name, callable $function) : void;
    
    static function removeFilter(string $name, callable $function, int $priority = null);
    
    static function addContentFilter(callable $function) : void;

}