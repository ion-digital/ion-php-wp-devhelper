<?php
namespace ion\WordPress\Helper\Wrappers;

use ion\SemVerInterface;
/**
 * Description of CommonTrait*
 * @author Justus
 */
interface CommonInterface
{
    /**
     * method
     * 
     * 
     * @return string
     */
    static function applyTemplate($template, array $parameters);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function redirect($url, array $parameters = null, $status = null);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function getSiteLink(array $controllers = null, array $parameters = null, $absolute = true);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addScript($id, $src, $backEnd = true, $frontEnd = false, $inline = false, $addToEnd = false, $priority = 1, SemVerInterface $version = null, array $dependencies = []);
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function hasScript($id);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addStyle($id, $src, $backEnd = true, $frontEnd = false, $inline = false, $media = "screen", $priority = 1, SemVerInterface $version = null, array $dependencies = []);
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function hasStyle($id);
    /**
     * method
     * 
     * @return bool
     */
    static function isWordPress();
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function isAdmin($includeLoginPage = false);
    /**
     * method
     * 
     * @return bool
     */
    static function hasPermalinks();
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addImageSize($name, $width = null, $height = null, $crop = null, $selectable = null, $caption = null);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function exitWithCode($code);
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function setCookie($name, $value, $expiryTimeStamp = null, $domain = null, $path = null, $secure = null, $httpOnly = null);
    /**
     * method
     * 
     * 
     * @return ?string
     */
    static function getCurrentObjectType($ignoreTheLoop = false);
    /**
     * method
     * 
     * 
     * @return ?object
     */
    static function getCurrentObject($ignoreTheLoop = false);
    /**
     * method
     * 
     * 
     * @return ?int
     */
    static function getCurrentObjectId($ignoreTheLoop = false);
}