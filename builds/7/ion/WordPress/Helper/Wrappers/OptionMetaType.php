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

class OptionMetaType {
    
    public const POST = 'WP_Post';
    public const TERM = 'WP_Term';
    public const USER = 'WP_User';
    public const COMMENT = 'WP_Comment';
    
    private $value = null;
    
    public static function create(string $value = null): OptionMetaType {
        
        return new static($value);
    }
    
    public function __construct(string $value = null) {
        
        $this->value = $value;
    }
    
    public function toString(): string {
        
        return (string) $this->value;
    }
    
    public function toValue(): ?string {
        
        return $this->value;
    }
}
