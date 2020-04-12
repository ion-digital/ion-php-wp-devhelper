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
    
    static function getOption(string $key, $default = null, int $id = null, OptionMetaType $type = null, bool $raw = false);
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    static function getRawOption(string $key, $default = null, int $id = null, OptionMetaType $type = null);
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function setOption(string $key, $value = null, int $id = null, OptionMetaType $type = null, bool $raw = false, bool $autoLoad = false) : bool;
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function setRawOption(string $key, $value = null, int $id = null, OptionMetaType $type = null, bool $autoLoad = false) : bool;
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function hasOption(string $key, int $id = null, OptionMetaType $type = null) : bool;
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    static function removeOption(string $key, int $postId = null, OptionMetaType $type = null) : bool;

}