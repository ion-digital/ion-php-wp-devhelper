<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace Ion\WordPress\Helper;

use Throwable;
use WP_Post;
use Ion\WordPress\WordPressHelperInterface;
use Ion\WordPress\Helper\Tools;
use Ion\WordPress\Helper\Constants;
use Ion\PhpHelper as PHP;
use Ion\Package;
use Ion\SemVerInterface;
use Ion\SemVer;
/**
 * Description of ShortCodesTrait*
 * @author Justus
 */
trait ShortCodesTrait
{
    private static $shortCodes = [];
    protected static function initialize()
    {
        static::registerWrapperAction('init', function () {
            foreach (static::$shortCodes as $code => $shortCode) {
                add_shortcode($code, function ($atts = [], $content = null, $tags = '') use($code, $shortCode) {
                    return $shortCode["action"]($atts, $content, $tags);
                });
            }
        });
    }
    public static function addShortCode(string $code, callable $action, array $defaults = [])
    {
        // https://codex.wordpress.org/Shortcode_API
        static::$shortCodes[$code] = ["action" => $action, "defaults" => $defaults];
    }
    public static function doShortCode(string $code, array $attributes = null) : string
    {
        $output = "";
        if (array_key_exists($code, static::$shortCodes)) {
            $attrString = "";
            if ($attributes !== null) {
                foreach ($attributes as $key => $value) {
                    $attrString .= $key . "=\"" . $value . "\" ";
                }
                $attrString = trim($attrString);
            }
            $input = "[{$code}" . ($attributes !== null && count($attributes) > 0 ? " " . $attrString : "") . "]";
            //$output = $input;
            $output = (string) do_shortcode($input);
        }
        return $output;
    }
    public static function processShortCodes(string $content) : string
    {
        $output = (string) do_shortcode($content);
        return $output;
    }
    public static function removeShortCode(string $code) : void
    {
        remove_shortcode($code);
        return;
    }
    public static function stripShortCodes(string $input) : string
    {
        return strip_shortcodes($input);
    }
}