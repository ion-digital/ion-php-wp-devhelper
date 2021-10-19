<?php
namespace ion\WordPress\Helper\Wrappers;

/**
 * Description of RewriteApiTrait*
 * @author Justus
 */
interface RewritesInterface
{
    static function addRewriteRule(string $pattern, string $target, bool $top = false) : void;
    static function flushRewriteRules(bool $hard = true) : void;
}