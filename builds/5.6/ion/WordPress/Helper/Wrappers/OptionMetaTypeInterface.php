<?php
namespace ion\WordPress\Helper\Wrappers;

use ion\WordPress\Helper\Wrappers\OptionMetaType;
interface OptionMetaTypeInterface
{
    /**
     * method
     * 
     * 
     * @return OptionMetaType
     */
    static function create($value = null);
    /**
     * method
     * 
     * @return string
     */
    function toString();
    /**
     * method
     * 
     * @return ?string
     */
    function toValue();
}