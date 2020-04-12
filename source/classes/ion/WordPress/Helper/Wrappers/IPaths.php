<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */
interface IPaths {
    
    static function getHelperUri(): string;
    
    static function getHelperDirectory(): string;     
    
    static function getTemporaryFileDirectory(string $relativePath = null): string;

    static function getTemporaryFilePath(string $filename, string $relativePath = null): string;

    static function ensureTemporaryFileDirectory(string $relativePath = null): string;

    static function ensureTemporaryFilePath(string $filename, string $relativePath = null): string;

    static function getThemePath(bool $includeChildTheme = true): string;     
    
    static function getThemeUri(bool $includeChildTheme = true): string;            
    
    static function getBackEndUri(string $path = null, int $blogId = null): string;

    static function getAdminUrl(string $filename): string;
    
    static function getAjaxUrl(string $name = null, array $parameters = null): string;    
    
    static function getWordPressPath(): string;
    
    static function getWordPressUri(): string;
    
    static function getSitePath(): string;
    
    static function getSiteUri(): string;
    
    static function getContentPath(): string;
    
    static function getContentUri(): string;
    
    static function getPostUri(int $id = null): string;
    
}
