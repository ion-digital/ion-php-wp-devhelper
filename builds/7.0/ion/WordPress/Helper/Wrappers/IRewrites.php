<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */
interface IRewrites
{
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addRewriteRule(string $pattern, string $target, bool $top = false);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function flushRewriteRules(bool $hard = true);
}