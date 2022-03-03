<?php

namespace ion\WordPress\Helper;


/**
 * Description of ShortCodesTrait*
 * @author Justus
 */
interface ShortCodesInterface {

    static function addShortCode(string $code, callable $action, array $defaults = []);

    static function doShortCode(string $code, array $attributes = null): string;

    static function processShortCodes(string $content): string;

    static function removeShortCode(string $code): void;

    static function stripShortCodes(string $input): string;

}
