<?php
namespace ion\WordPress\Helper;

/**
 * Description of PathsTrait*
 * @author Justus
 */
interface PathsInterface
{
    /**
     * method
     * 
     * @return string
     */
    static function getHelperDirectory();
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
    static function getWordPressPath();
    /**
     * method
     * 
     * 
     * @return string
     */
    static function getWordPressUri($network = false);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function getSitePath($network = false);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function getSiteUri($network = false);
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
    static function getAdminUrl($filename, $page = null, $network = false);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function getAjaxUrl($name = null, array $parameters = null, $encodeParameters = true, $network = false);
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
    static function getPostUri($id = null);
}