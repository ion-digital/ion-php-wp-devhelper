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
    const POST = 'WP_Post';
    const TERM = 'WP_Term';
    const USER = 'WP_User';
    const COMMENT = 'WP_Comment';
    private $value = null;
    /**
     * method
     * 
     * 
     * @return OptionMetaType
     */
    public static function create($value = null)
    {
        return new static($value);
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }
    /**
     * method
     * 
     * @return string
     */
    public function toString()
    {
        return (string) $this->value;
    }
    /**
     * method
     * 
     * @return ?string
     */
    public function toValue()
    {
        return $this->value;
    }
}