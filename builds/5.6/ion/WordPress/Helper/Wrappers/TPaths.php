<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

use \Exception as Throwable;
use WP_Post;
use ion\WordPress\IWordPressHelper;
use ion\WordPress\Helper\Tools;
use ion\WordPress\Helper\Constants;
use ion\PhpHelper as PHP;
use ion\Package;
use ion\ISemVer;
use ion\SemVer;
/**
 * Description of TPaths
 *
 * @author Justus
 */
trait TPaths
{
    private static $helperDir = null;
    private static $helperUri = null;
    /**
     * method
     * 
     * @return mixed
     */
    protected static function initialize_TPaths()
    {
        //        static::registerWrapperAction('init', function() {
        //
        //        });
    }
    /**
     * method
     * 
     * @return string
     */
    public static function getHelperDirectory()
    {
        return static::$helperDir;
    }
    /**
     * method
     * 
     * @return string
     */
    public static function getHelperUri()
    {
        return static::$helperUri;
    }
    /**
     * method
     * 
     * @return string
     */
    public static function getWordPressPath()
    {
        //if(is_multisite() && $network) {
        return rtrim((string) ABSPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        //}
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function getWordPressUri($network = false)
    {
        if (!is_multisite() || !$network) {
            return rtrim(get_home_url(), '/') . '/';
        }
        return rtrim(static::getSiteUri(true) . str_replace(static::getSitePath(true), '', static::getWordPressPath()), '/') . '/';
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function getSitePath($network = false)
    {
        if (is_multisite() && $network) {
            return PHP::getServerDocumentRoot();
        }
        return rtrim(get_home_path(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function getSiteUri($network = false)
    {
        if (!is_multisite() || !$network) {
            return rtrim(get_bloginfo('url'), '/') . '/';
        }
        return rtrim(network_site_url(), '/') . '/';
    }
    /**
     * method
     * 
     * @return string
     */
    public static function getContentPath()
    {
        return rtrim(defined('WP_CONTENT_DIR') ? constant('WP_CONTENT_DIR') : ABSPATH . 'wp-content', DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }
    /**
     * method
     * 
     * @return string
     */
    public static function getContentUri()
    {
        return rtrim(content_url(), '/') . '/';
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function ensureTemporaryFilePath($filename, $relativePath = null)
    {
        return static::ensureTemporaryFileDirectory($relativePath) . $filename;
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function getThemePath($includeChildTheme = true)
    {
        if ($includeChildTheme) {
            return get_stylesheet_directory() . DIRECTORY_SEPARATOR;
        }
        return get_template_directory() . DIRECTORY_SEPARATOR;
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function getThemeUri($includeChildTheme = true)
    {
        if ($includeChildTheme) {
            return get_stylesheet_directory_uri() . '/';
        }
        return get_template_directory_uri() . "/";
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function getTemporaryFileDirectory($relativePath = null)
    {
        return get_temp_dir() . ($relativePath === null ? "" : trim($relativePath, "/ ")) . "/";
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function getTemporaryFilePath($filename, $relativePath = null)
    {
        return static::getTemporaryFileDirectory($relativePath) . $filename;
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function ensureTemporaryFileDirectory($relativePath = null)
    {
        $directory = static::GetTemporaryFileDirectory($relativePath);
        if (is_dir($directory) === false) {
            if (wp_mkdir_p($directory) === false) {
                throw new WordPressHelperException('Could not created temporary path.');
            }
        }
        return $directory;
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function getAdminUrl($filename, $page = null, $network = false)
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
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function getAjaxUrl($name = null, array $parameters = null, $encodeParameters = true, $network = false)
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
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function getBackEndUri($path = null, $blogId = null)
    {
        return get_admin_url($blogId, $path === null ? '' : $path, 'admin');
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public static function getPostUri($id = null)
    {
        if ($id === null) {
            global $post;
            $id = $post->ID;
        }
        return get_permalink($id);
    }
}