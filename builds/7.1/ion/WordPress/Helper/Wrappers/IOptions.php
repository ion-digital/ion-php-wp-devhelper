<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */
use ion\WordPress\Helper\IAdminCustomizeHelper;

interface IOptions
{
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function getSiteOption(string $name, $default = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function setSiteOption(string $name, $value = null, bool $autoLoad = false) : bool;
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasSiteOption(string $name) : bool;
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function removeSiteOption(string $name) : bool;
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function getPostOption(string $name, int $metaId, $default = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function setPostOption(string $name, int $metaId, $value = null, bool $autoLoad = false) : bool;
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasPostOption(string $name, int $metaId) : bool;
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function removePostOption(string $name, int $metaId, $value = null) : bool;
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function getTermOption(string $name, int $metaId, $default = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function setTermOption(string $name, int $metaId, $value = null, bool $autoLoad = false) : bool;
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasTermOption(string $name, int $metaId) : bool;
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function removeTermOption(string $name, int $metaId, $value = null) : bool;
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function getUserOption(string $name, int $metaId, $default = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function setUserOption(string $name, int $metaId, $value = null, bool $autoLoad = false) : bool;
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasUserOption(string $name, int $metaId) : bool;
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function removeUserOption(string $name, int $metaId, $value = null) : bool;
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function getCommentOption(string $name, int $metaId, $default = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function setCommentOption(string $name, int $metaId, $value = null, bool $autoLoad = false) : bool;
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasCommentOption(string $name, int $metaId) : bool;
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function removeCommentOption(string $name, int $metaId, $value = null) : bool;
    
    /**
     * method
     * 
     * 
     * @return IAdminCustomizeHelper
     */
    
    static function addCustomizationSection(string $title, string $slug = null, int $priority = null, string $textDomain = null) : IAdminCustomizeHelper;
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function getCustomizationOption(string $name, $default = null);
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function setCustomizationOption(string $name, $value = null) : void;
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasCustomizationOption(string $name) : bool;
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function removeCustomizationOption(string $name) : void;

}