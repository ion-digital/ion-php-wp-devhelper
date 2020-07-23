<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

/**
 * Description of OptionType
 *
 * @author Justus
 */
// This is a stand-in class for WP-Helper compatibility - it will be removed soon.

class OptionMetaType
{
    const POST = 1;
    const TERM = 2;
    const USER = 3;
    const COMMENT = 4;
    private $value = null;
    /**
     * method
     * 
     * 
     * @return OptionMetaType
     */
    
    public static function create(int $value = null) : OptionMetaType
    {
        return new static($value);
    }
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    public function __construct(int $value = null)
    {
        $this->value = $value;
    }
    
    /**
     * method
     * 
     * @return string
     */
    
    public function toString() : string
    {
        return (string) $this->value;
    }
    
    /**
     * method
     * 
     * @return ?int
     */
    
    public function toValue()
    {
        return $this->value;
    }

}