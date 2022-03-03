<?php

namespace ion\WordPress\Helper;


/**
 * Description of PathsTrait*
 * @author Justus
 */
interface PathsInterface {

    static function getHelperDirectory(): string;

    static function getHelperUri(): string;

    static function getWordPressPath(): string;

    static function getWordPressUri(bool $network = false): string;

    static function getSitePath(bool $network = false): string;

    static function getSiteUri(bool $network = false): string;

    static function getContentPath(): string;

    static function getContentUri(): string;

    static function ensureTemporaryFilePath(string $filename, string $relativePath = null): string;

    static function getThemePath(bool $includeChildTheme = true): string;

    static function getThemeUri(bool $includeChildTheme = true): string;

    static function getTemporaryFileDirectory(string $relativePath = null): string;

    static function getTemporaryFilePath(string $filename, string $relativePath = null): string;

    static function ensureTemporaryFileDirectory(string $relativePath = null): string;

    static function getAdminUrl(string $filename, string $page = null, bool $network = false): string;

    static function getAjaxUrl(

        string $name = null,
        array $parameters = null,
        bool $encodeParameters = true,
        bool $network = false

    ): string;

    static function getBackEndUri(string $path = null, int $blogId = null): string;

    static function getPostUri(int $id = null): string;

}
