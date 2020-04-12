<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */
interface IShortCodes {
    
    static function addShortCode(string $code, callable $action, array $defaults = []);
    
    static function doShortCode(string $code, array $attributes = null): string;
    
    static function processShortCodes(string $content);
    
    static function stripShortCodes(string $input): string;
    
    static function removeShortCode(string $code) : void;
}
