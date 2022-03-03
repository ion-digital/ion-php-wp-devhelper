<?php
namespace ion\WordPress\Helper;

/**
 * Description of ShortCodesTrait*
 * @author Justus
 */
interface ShortCodesInterface
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
     * @return string
     */
    static function processShortCodes($content);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function removeShortCode($code);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function stripShortCodes($input);
}