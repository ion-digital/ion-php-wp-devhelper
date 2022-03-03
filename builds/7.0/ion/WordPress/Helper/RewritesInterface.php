<?php
namespace ion\WordPress\Helper;

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
    static function addRewriteRule(string $pattern, string $target, bool $top = false);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function flushRewriteRules(bool $hard = true);
}