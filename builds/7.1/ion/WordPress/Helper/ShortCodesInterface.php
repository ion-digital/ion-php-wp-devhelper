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
     * @return string
     */
    static function processShortCodes(string $content) : string;
    /**
     * method
     * 
     * 
     * @return void
     */
    static function removeShortCode(string $code) : void;
    /**
     * method
     * 
     * 
     * @return string
     */
    static function stripShortCodes(string $input) : string;
}