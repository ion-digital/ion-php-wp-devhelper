<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */

interface IShortCodes
{
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function addShortCode(string $code, callable $action, array $defaults = []);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function doShortCode(string $code, array $attributes = null) : string;
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function processShortCodes(string $content);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function stripShortCodes(string $input) : string;
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function removeShortCode(string $code);

}