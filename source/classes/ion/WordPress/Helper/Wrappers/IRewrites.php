<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */
interface IRewrites {
    
    static function addRewriteRule(string $pattern, string $target, bool $top = false): void;
    
    static function flushRewriteRules(bool $hard = true): void;    
}
