<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

use Throwable;
use WP_Post;
use WP_Rewrite;
use ion\WordPress\WordPressHelper as WP;
use ion\WordPress\Helper\Tools;
use ion\WordPress\Helper\Constants;
use ion\PhpHelper as PHP;
use ion\Package;
use ion\SemVerInterface;
use ion\SemVer;
use ion\WordPress\Helper\WordPressHelperException;
/**
 * Description of RewriteApiTrait*
 * @author Justus
 */
trait RewritesTrait
{
    private static $rewrites = [];
    protected static function initialize()
    {
        static::registerWrapperAction('init', function () {
            //            echo "<pre>";
            //            var_dump(static::$rewrites);
            //            die("</pre>");
            foreach (static::$rewrites as $rewrite) {
                add_rewrite_rule($rewrite["pattern"], $rewrite["target"], $rewrite["top"] === true ? "top" : "bottom");
            }
        });
        if (!WP::isAdmin()) {
            return;
        }
        //        static::registerWrapperAction('wp_loaded', function() {
        //
        //            static::flushRewriteRules(true);
        //        });
    }
    public static function addRewriteRule(string $pattern, string $target, bool $top = false) : void
    {
        static::$rewrites[] = ["pattern" => $pattern, "target" => $target, "top" => $top];
    }
    public static function flushRewriteRules(bool $hard = true) : void
    {
        //#TODO: https://premium.wpmudev.org/forums/topic/301-redirects-on-multisite/
        flush_rewrite_rules($hard);
        if (!is_multisite() || !$hard) {
            return;
        }
        $path = static::getSitePath(is_multisite()) . DIRECTORY_SEPARATOR . '.htaccess';
        $data = @file_get_contents($path);
        if ($data === false) {
            return;
        }
        global $wp_rewrite;
        //        echo "<pre>"; var_dump($wp_rewrite->non_wp_rules); echo "</pre>";
        if (PHP::isArray($wp_rewrite->non_wp_rules) && PHP::count($wp_rewrite->non_wp_rules) > 0) {
            $siteUrl = WP::getSiteLink();
            $startTag = "# BEGIN " . $siteUrl;
            $endTag = "# END " . $siteUrl;
            $startPos = strpos($data, $startTag);
            $endPos = strpos($data, $endTag);
            $rewrites = "\n\n{$startTag}\n\n<IfModule mod_rewrite.c>\n\n";
            foreach ($wp_rewrite->non_wp_rules as $pattern => $target) {
                $rewrites .= "RewriteRule {$pattern} {$target} [QSA,L]\n";
            }
            $rewrites .= "\n</IfModule>\n\n{$endTag}\n\n";
            if ($startPos === false || $endPos === false) {
                $data .= $rewrites;
            } else {
                $data = rtrim(substr($data, 0, $startPos)) . $rewrites . ltrim(substr($data, $endPos + strlen($endTag)));
            }
            if (@file_put_contents($path, $data) === false) {
                throw new WordPressHelperException("Could not update .htaccess file (located at '{$path}').");
            }
        }
    }
}