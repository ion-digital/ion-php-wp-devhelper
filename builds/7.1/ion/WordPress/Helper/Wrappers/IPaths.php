<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */

interface IPaths
{
    /**
     * method
     * 
     * @return string
     */
    
    static function getHelperUri() : string;
    
    /**
     * method
     * 
     * @return string
     */
    
    static function getHelperDirectory() : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getTemporaryFileDirectory(string $relativePath = null) : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getTemporaryFilePath(string $filename, string $relativePath = null) : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function ensureTemporaryFileDirectory(string $relativePath = null) : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function ensureTemporaryFilePath(string $filename, string $relativePath = null) : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getThemePath(bool $includeChildTheme = true) : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getThemeUri(bool $includeChildTheme = true) : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getBackEndUri(string $path = null, int $blogId = null) : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getAdminUrl(string $filename, string $page = null) : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getAjaxUrl(string $name = null, array $parameters = null) : string;
    
    /**
     * method
     * 
     * @return string
     */
    
    static function getWordPressPath() : string;
    
    /**
     * method
     * 
     * @return string
     */
    
    static function getWordPressUri() : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getSitePath(bool $network = false) : string;
    
    /**
     * method
     * 
     * @return string
     */
    
    static function getSiteUri() : string;
    
    /**
     * method
     * 
     * @return string
     */
    
    static function getContentPath() : string;
    
    /**
     * method
     * 
     * @return string
     */
    
    static function getContentUri() : string;
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getPostUri(int $id = null) : string;

}