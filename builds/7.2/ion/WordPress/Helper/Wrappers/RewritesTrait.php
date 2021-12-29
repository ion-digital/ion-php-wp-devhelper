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
            // NOTE: The quotes around the URI's are essential to make sure
            // we don't break the .htaccess file when finding the root site's
            // section.
            $startTag = "# BEGIN \"{$siteUrl}\"";
            $endTag = "# END \"{$siteUrl}\"";
            $startPos = strpos($data, $startTag);
            $endPos = strpos($data, $endTag);
            if ($endPos !== false) {
                $endPos += strlen($endTag);
            }
            $rewrites = "\n\n{$startTag}\n\n";
            foreach ($wp_rewrite->non_wp_rules as $pattern => $target) {
                $rewrites .= "RewriteRule {$pattern} {$target} [QSA,L]\n";
            }
            $rewrites .= "\n{$endTag}\n\n";
            if ($startPos === false || $endPos === false) {
                $startPos = strpos($data, static::WORDPRESS_HTACCESS_START);
                if ($startPos === false) {
                    throw new WordPressHelperException("Could not find '" . static::WORDPRESS_HTACCESS_START . "' in .htaccess.");
                }
                $startPos += strlen(static::WORDPRESS_HTACCESS_START);
                $startPos = strpos($data, "RewriteBase", $startPos);
                if ($startPos === false) {
                    throw new WordPressHelperException("Could not find 'RewriteBase' in .htaccess.");
                }
                $startPos += strlen("RewriteBase");
                $startPos = strpos($data, "\n", $startPos);
                if ($startPos === false) {
                    throw new WordPressHelperException("Could not find the end of the 'RewriteBase' line in .htaccess.");
                }
                $startPos += 1;
                if ($endPos === false) {
                    $endPos = $startPos;
                }
            }
            $data = rtrim(substr($data, 0, $startPos)) . $rewrites . ltrim(substr($data, $endPos));
            //            die("<pre>{$data}</pre>");
            if (@file_put_contents($path, $data) === false) {
                throw new WordPressHelperException("Could not update .htaccess file (located at '{$path}').");
            }
        }
    }
}