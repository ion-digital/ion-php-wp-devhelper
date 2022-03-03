<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

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
 * Description of PathsTrait*
 * @author Justus
 */
trait PathsTrait
{
    private static $helperDir = null;
    private static $helperUri = null;
    protected static function initialize()
    {
        //        static::registerWrapperAction('init', function() {
        //
        //        });
    }
    public static function getHelperDirectory() : string
    {
        return static::$helperDir;
    }
    public static function getHelperUri() : string
    {
        return static::$helperUri;
    }
    public static function getWordPressPath() : string
    {
        //if(is_multisite() && $network) {
        return rtrim((string) ABSPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        //}
    }
    public static function getWordPressUri(bool $network = false) : string
    {
        if (!is_multisite() || !$network) {
            return rtrim(get_home_url(), '/') . '/';
        }
        return rtrim(static::getSiteUri(true) . str_replace(static::getSitePath(true), '', static::getWordPressPath()), '/') . '/';
    }
    public static function getSitePath(bool $network = false) : string
    {
        if (is_multisite() && $network) {
            return PHP::getServerDocumentRoot();
        }
        return rtrim(get_home_path(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }
    public static function getSiteUri(bool $network = false) : string
    {
        if (!is_multisite() || !$network) {
            return rtrim(get_bloginfo('url'), '/') . '/';
        }
        return rtrim(network_site_url(), '/') . '/';
    }
    public static function getContentPath() : string
    {
        return rtrim(defined('WP_CONTENT_DIR') ? constant('WP_CONTENT_DIR') : ABSPATH . 'wp-content', DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }
    public static function getContentUri() : string
    {
        return rtrim(content_url(), '/') . '/';
    }
    public static function ensureTemporaryFilePath(string $filename, string $relativePath = null) : string
    {
        return static::ensureTemporaryFileDirectory($relativePath) . $filename;
    }
    public static function getThemePath(bool $includeChildTheme = true) : string
    {
        if ($includeChildTheme) {
            return get_stylesheet_directory() . DIRECTORY_SEPARATOR;
        }
        return get_template_directory() . DIRECTORY_SEPARATOR;
    }
    public static function getThemeUri(bool $includeChildTheme = true) : string
    {
        if ($includeChildTheme) {
            return get_stylesheet_directory_uri() . '/';
        }
        return get_template_directory_uri() . "/";
    }
    public static function getTemporaryFileDirectory(string $relativePath = null) : string
    {
        return get_temp_dir() . ($relativePath === null ? "" : trim($relativePath, "/ ")) . "/";
    }
    public static function getTemporaryFilePath(string $filename, string $relativePath = null) : string
    {
        return static::getTemporaryFileDirectory($relativePath) . $filename;
    }
    public static function ensureTemporaryFileDirectory(string $relativePath = null) : string
    {
        $directory = static::GetTemporaryFileDirectory($relativePath);
        if (is_dir($directory) === false) {
            if (wp_mkdir_p($directory) === false) {
                throw new WordPressHelperException('Could not created temporary path.');
            }
        }
        return $directory;
    }
    public static function getAdminUrl(string $filename, string $page = null, bool $network = false) : string
    {
        $uri = null;
        $ext = !PHP::strEndsWith($filename, '.php') ? '.php' : '';
        if (!is_multisite() || !$network) {
            $uri = admin_url($filename . $ext);
        } else {
            $uri = static::getWordPressUri($network) . '/wp-admin/' . $filename . $ext;
        }
        if ($page !== null) {
            $uri .= "?page={$page}";
        }
        return esc_url($uri);
    }
    public static function getAjaxUrl(string $name = null, array $parameters = null, bool $encodeParameters = true, bool $network = false) : string
    {
        $url = static::getAdminUrl('admin-ajax', null, $network);
        if ($name === null) {
            return static::getUrl($url, null, [], $encodeParameters);
        }
        $tmp = [];
        $tmp['action'] = $name;
        if ($parameters !== null) {
            foreach ($parameters as $key => $value) {
                $tmp[$key] = $value;
            }
        }
        return static::getUrl($url, null, $tmp, $encodeParameters);
    }
    public static function getBackEndUri(string $path = null, int $blogId = null) : string
    {
        return get_admin_url($blogId, $path === null ? '' : $path, 'admin');
    }
    public static function getPostUri(int $id = null) : string
    {
        if ($id === null) {
            global $post;
            $id = $post->ID;
        }
        return get_permalink($id);
    }
}