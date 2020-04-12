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
    
    static function getHelperUri();
    
    /**
     * method
     * 
     * @return string
     */
    
    static function getHelperDirectory();
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getTemporaryFileDirectory($relativePath = null);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getTemporaryFilePath($filename, $relativePath = null);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function ensureTemporaryFileDirectory($relativePath = null);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function ensureTemporaryFilePath($filename, $relativePath = null);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getThemePath($includeChildTheme = true);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getThemeUri($includeChildTheme = true);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getBackEndUri($path = null, $blogId = null);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getAdminUrl($filename);
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getAjaxUrl($name = null, array $parameters = null);
    
    /**
     * method
     * 
     * @return string
     */
    
    static function getWordPressPath();
    
    /**
     * method
     * 
     * @return string
     */
    
    static function getWordPressUri();
    
    /**
     * method
     * 
     * @return string
     */
    
    static function getSitePath();
    
    /**
     * method
     * 
     * @return string
     */
    
    static function getSiteUri();
    
    /**
     * method
     * 
     * @return string
     */
    
    static function getContentPath();
    
    /**
     * method
     * 
     * @return string
     */
    
    static function getContentUri();
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    static function getPostUri($id = null);

}