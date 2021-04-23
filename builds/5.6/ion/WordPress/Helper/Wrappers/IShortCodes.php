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
    static function addShortCode($code, callable $action, array $defaults = []);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function doShortCode($code, array $attributes = null);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function processShortCodes($content);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function stripShortCodes($input);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function removeShortCode($code);
}