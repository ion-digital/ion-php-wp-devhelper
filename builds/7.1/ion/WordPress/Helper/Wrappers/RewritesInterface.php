<?php
namespace ion\WordPress\Helper\Wrappers;

/**
 * Description of RewriteApiTrait*
 * @author Justus
 */
interface RewritesInterface
{
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addRewriteRule(string $pattern, string $target, bool $top = false) : void;
    /**
     * method
     * 
     * 
     * @return void
     */
    static function flushRewriteRules(bool $hard = true) : void;
}