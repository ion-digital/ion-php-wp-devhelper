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
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function addFilter($name, callable $function);
    
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