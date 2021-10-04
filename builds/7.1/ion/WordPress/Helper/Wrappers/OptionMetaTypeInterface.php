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
    static function create(string $value = null) : OptionMetaType;
    /**
     * method
     * 
     * @return string
     */
    function toString() : string;
    /**
     * method
     * 
     * @return ?string
     */
    function toValue() : ?string;
}