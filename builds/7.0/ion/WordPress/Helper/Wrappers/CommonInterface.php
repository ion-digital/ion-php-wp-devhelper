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
    static function applyTemplate(string $template, array $parameters) : string;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function redirect(string $url, array $parameters = null, int $status = null);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function getSiteLink(array $controllers = null, array $parameters = null, bool $absolute = true) : string;
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addScript(string $id, string $src, bool $backEnd = true, bool $frontEnd = false, bool $inline = false, bool $addToEnd = false, int $priority = 1, SemVerInterface $version = null, array $dependencies = []);
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function hasScript(string $id) : bool;
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addStyle(string $id, string $src, bool $backEnd = true, bool $frontEnd = false, bool $inline = false, string $media = "screen", int $priority = 1, SemVerInterface $version = null, array $dependencies = []);
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function hasStyle(string $id) : bool;
    /**
     * method
     * 
     * @return bool
     */
    static function isWordPress() : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function isAdmin(bool $includeLoginPage = false) : bool;
    /**
     * method
     * 
     * @return bool
     */
    static function isCustomizer() : bool;
    /**
     * method
     * 
     * @return bool
     */
    static function hasPermalinks() : bool;
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addImageSize(string $name, int $width = null, int $height = null, bool $crop = null, bool $selectable = null, string $caption = null);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function exitWithCode(int $code);
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function setCookie(string $name, string $value, int $expiryTimeStamp = null, string $domain = null, string $path = null, bool $secure = null, bool $httpOnly = null) : bool;
    /**
     * method
     * 
     * 
     * @return ?string
     */
    static function getCurrentObjectType(bool $ignoreTheLoop = false);
    /**
     * method
     * 
     * 
     * @return ?object
     */
    static function getCurrentObject(bool $ignoreTheLoop = false);
    /**
     * method
     * 
     * 
     * @return ?int
     */
    static function getCurrentObjectId(bool $ignoreTheLoop = false);
}