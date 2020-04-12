<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */

interface IOptions
{
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function getOption($key, $default = null, $id = null, OptionMetaType $type = null, $raw = false);
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function getRawOption($key, $default = null, $id = null, OptionMetaType $type = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function setOption($key, $value = null, $id = null, OptionMetaType $type = null, $raw = false, $autoLoad = false);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function setRawOption($key, $value = null, $id = null, OptionMetaType $type = null, $autoLoad = false);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasOption($key, $id = null, OptionMetaType $type = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function removeOption($key, $postId = null, OptionMetaType $type = null);

}