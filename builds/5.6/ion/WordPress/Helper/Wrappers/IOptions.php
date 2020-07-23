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
    
    static function getSiteOption($name, $default = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function setSiteOption($name, $value = null, $autoLoad = false);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasSiteOption($name);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function removeSiteOption($name);
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function getPostOption($name, $metaId, $default = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function setPostOption($name, $metaId, $value = null, $autoLoad = false);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasPostOption($name, $metaId);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function removePostOption($name, $metaId, $value = null);
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function getTermOption($name, $metaId, $default = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function setTermOption($name, $metaId, $value = null, $autoLoad = false);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasTermOption($name, $metaId);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function removeTermOption($name, $metaId, $value = null);
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function getUserOption($name, $metaId, $default = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function setUserOption($name, $metaId, $value = null, $autoLoad = false);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasUserOption($name, $metaId);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function removeUserOption($name, $metaId, $value = null);
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function getCommentOption($name, $metaId, $default = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function setCommentOption($name, $metaId, $value = null, $autoLoad = false);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasCommentOption($name, $metaId);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function removeCommentOption($name, $metaId, $value = null);
    
    /**
     * method
     * 
     * 
     * @return IAdminCustomizeHelper
     */
    
    static function addCustomizationSection($title, $slug = null, $priority = null, $textDomain = null);
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function getCustomizationOption($name, $default = null);
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function setCustomizationOption($name, $value = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasCustomizationOption($name);
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    static function removeCustomizationOption($name);

}