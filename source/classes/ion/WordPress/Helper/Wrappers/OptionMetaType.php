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
    
    public const POST = 1;
    public const TERM = 2;
    public const USER = 3;
    public const COMMENT = 4;
    
    private $value = null;
    
    public static function create(int $value = null): OptionMetaType {
        
        return new static($value);
    }
    
    public function __construct(int $value = null) {
        
        $this->value = $value;
    }
    
    public function toString(): string {
        
        return (string) $this->value;
    }
    
    public function toValue(): ?int {
        
        return $this->value;
    }
}
