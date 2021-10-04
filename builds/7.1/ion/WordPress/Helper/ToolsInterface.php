<?php
namespace ion\WordPress\Helper;

interface ToolsInterface
{
    /**
     * method
     * 
     * @return mixed
     */
    static function isHidden();
    /**
     * method
     * 
     * @return mixed
     */
    static function isDisabled();
    /**
     * method
     * 
     * @return mixed
     */
    static function enable();
    /**
     * method
     * 
     * @return mixed
     */
    static function disable();
    /**
     * method
     * 
     * @return mixed
     */
    static function addEnableMenuItem();
}