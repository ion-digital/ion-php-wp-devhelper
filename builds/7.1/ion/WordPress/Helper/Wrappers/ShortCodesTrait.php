<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

use Throwable;
use WP_Post;
use ion\WordPress\WordPressHelperInterface;
use ion\WordPress\Helper\Tools;
use ion\WordPress\Helper\Constants;
use ion\PhpHelper as PHP;
use ion\Package;
use ion\SemVerInterface;
use ion\SemVer;
/**
 * Description of ShortCodesTrait*
 * @author Justus
 */
trait ShortCodesTrait
{
    private static $shortCodes = [];
    /**
     * method
     * 
     * @return mixed
     */
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
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public static function addShortCode(string $code, callable $action, array $defaults = [])
    {
        // https://codex.wordpress.org/Shortcode_API
        static::$shortCodes[$code] = ["action" => $action, "defaults" => $defaults];
    }
    /**
     * method
     * 
     * 
     * @return string
     */
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
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function processShortCodes(string $content) : string
    {
        $output = (string) do_shortcode($content);
        return $output;
    }
    /**
     * method
     * 
     * 
     * @return void
     */
    public static function removeShortCode(string $code) : void
    {
        remove_shortcode($code);
        return;
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function stripShortCodes(string $input) : string
    {
        return strip_shortcodes($input);
    }
}