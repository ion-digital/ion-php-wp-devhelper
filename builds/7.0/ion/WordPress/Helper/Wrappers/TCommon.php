<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

use Throwable;
use WP_Post;
use DateTime;
use ion\WordPress\IWordPressHelper;
use ion\Types\Arrays\IMap;
use ion\Types\Arrays\Map;
use ion\Types\Arrays\IVector;
use ion\Types\Arrays\Vector;
use ion\WordPress\Helper\Tools;
use ion\WordPress\Helper\Constants;
use ion\PhpHelper as PHP;
use ion\Package;
use ion\System\File;
use ion\System\Path;
use ion\System\FileMode;
use ion\ISemVer;
use ion\SemVer;
use ion\Types\StringObject;
/**
 * Description of TCommon
 *
 * @author Justus
 */
trait TCommon
{
    private static $scripts = [];
    private static $styles = [];
    private static $imageSizes = [];
    /**
     * method
     * 
     * @return mixed
     */
    
    protected static function initialize_TCommon()
    {
        static::registerWrapperAction('admin_enqueue_scripts', function () {
            // Add any required scripts / styles for the back-end here
            // Colour Picker
            wp_enqueue_script("wordpresshelper_colorpicker_colorpicker", static::getHelperUri() . "assets/external/colorpicker/js/colorpicker.js", [], false, false);
            wp_enqueue_style("wordpresshelper_colorpicker_colorpicker", static::getHelperUri() . "assets/external/colorpicker/css/colorpicker.css", [], false, "screen");
            // DateTime Picker
            wp_enqueue_script("wordpresshelper_datetimepicker", static::getHelperUri() . "assets/external/datetimepicker-master/build/jquery.datetimepicker.full.js", [], false, false);
            wp_enqueue_style("wordpresshelper_datetimepicker", static::getHelperUri() . "assets/external/datetimepicker-master/jquery.datetimepicker.css", [], false, "screen");
            // WP Helper Admin
            wp_enqueue_style("wordpresshelper-admin", static::getHelperUri() . "assets/styles/wp-helper-admin.css", [], false, "screen");
            wp_enqueue_script("wordpresshelper-admin", static::getHelperUri() . "assets/scripts/wp-helper-admin.js", [], false, false);
            foreach (array_values(static::$scripts) as $script) {
                if ($script["backEnd"] === true && $script["inline"] === false) {
                    wp_enqueue_script($script["id"], $script["src"], $script["dependencies"], false, $script["addToEnd"]);
                }
            }
            foreach (array_values(static::$styles) as $style) {
                if ($style["backEnd"] === true && $style["inline"] === false) {
                    wp_enqueue_style($style["id"], $style["src"], $style["dependencies"], false, $style["media"]);
                }
            }
        });
        static::registerWrapperAction('wp_enqueue_scripts', function () {
            foreach (array_values(static::$scripts) as $script) {
                if ($script["frontEnd"] === true && $script["inline"] === false) {
                    wp_enqueue_script($script["id"], $script["src"], $script["dependencies"], $script['version'], $script["addToEnd"]);
                }
            }
            foreach (array_values(static::$styles) as $style) {
                if ($style["frontEnd"] === true && $style["inline"] === false) {
                    wp_enqueue_style($style["id"], $style["src"], $style["dependencies"], $style['version'], $style["media"]);
                }
            }
        });
        static::registerWrapperAction('wp_head', function () {
            $ajaxUrl = admin_url('admin-ajax.php');
            echo <<<JS
<script id="wp-helper" type="text/javascript">
var ajaxurl;
ajaxurl = '{$ajaxUrl}';
</script>
JS;
            foreach (array_values(static::$scripts) as $script) {
                if ($script["frontEnd"] === true && $script["inline"] === true && $script["addToEnd"] === false) {
                    echo "<script id=\"" . $script["id"] . "\" type=\"text/javascript\"><!--\n" . $script["src"] . "\n--></script>\n";
                }
            }
            foreach (array_values(static::$styles) as $style) {
                if ($style["frontEnd"] === true && $style["inline"] === true) {
                    echo "<style id=\"" . $style["id"] . "\" type=\"text/css\" media=\"" . $style["media"] . "\">\n" . $style["src"] . "\n</style>\n";
                }
            }
        });
        static::registerWrapperAction('wp_footer', function () {
            foreach (array_values(static::$scripts) as $script) {
                if ($script["frontEnd"] === true && $script["inline"] === true && $script["addToEnd"] === true) {
                    echo "<script id=\"" . $script["id"] . "\" type=\"text/javascript\"><!--\n" . $script["src"] . "\n--></script>\n";
                }
            }
        });
        static::registerWrapperAction('admin_head', function () {
            foreach (array_values(static::$scripts) as $script) {
                if ($script["backEnd"] === true && $script["inline"] === true && $script["addToEnd"] === false) {
                    echo "<script id=\"" . $script["id"] . "\" type=\"text/javascript\"><!--\n" . $script["src"] . "\n--></script>\n";
                }
            }
            foreach (array_values(static::$styles) as $style) {
                if ($style["backEnd"] === true && $style["inline"] === true) {
                    echo "<style id=\"" . $style["id"] . "\" type=\"text/css\" media=\"" . $style["media"] . "\">\n" . $style["src"] . "\n</style>\n";
                }
            }
        });
        static::registerWrapperAction('admin_footer', function () {
            foreach (array_values(static::$scripts) as $script) {
                if ($script["backEnd"] === true && $script["inline"] === true && $script["addToEnd"] === true) {
                    echo "<script id=\"" . $script["id"] . "\" type=\"text/javascript\"><!--\n" . $script["src"] . "\n--></script>\n";
                }
            }
        });
        static::registerWrapperAction('init', function () {
            add_filter('wp_setup_nav_menu_item', function ($wpMenuItem) {
                $locations = get_nav_menu_locations();
                foreach (static::$settingsMenuFields as $menuId => $fields) {
                    if (!property_exists($wpMenuItem, 'meta')) {
                        $wpMenuItem->meta = [];
                    }
                    if (!array_key_exists($menuId, $locations) && !PHP::isEmpty($menuId)) {
                        continue;
                    }
                    $menus = PHP::isEmpty($menuId) ? array_keys($locations) : $menuId;
                    foreach ($menus as $affectedMenuId) {
                        $wpMenu = wp_get_nav_menu_object($locations[$affectedMenuId]);
                        if ($wpMenu === false) {
                            continue;
                        }
                        //TODO: Check if this item is part of the menu
                        foreach ($fields as $field) {
                            $wpMenuItem->meta[$field['name']] = static::getOption($field['name'], null, (int) $wpMenuItem->ID);
                        }
                    }
                }
                return $wpMenuItem;
            });
        });
        static::registerWrapperAction('after_setup_theme', function () {
            $selectable = [];
            foreach (static::$imageSizes as $name => $imageSize) {
                add_image_size($imageSize['name'], $imageSize['height'], $imageSize['width'], $imageSize['crop']);
                if ($imageSize['selectable'] === true) {
                    $selectable[$name] = $imageSize['caption'] === null ? $name : __($imageSize['caption']);
                }
            }
            add_filter('image_size_names_choose', function (array $sizes) use($selectable) {
                return array_merge($sizes, $selectable);
            });
        });
    }
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    private static function getUrl(string $url, array $controllers = null, array $parameters = null)
    {
        $output = $url;
        if ($controllers !== null) {
            $output .= implode('/', $controllers);
        }
        if ($parameters !== null && count(array_values($parameters)) > 0) {
            $pCnt = 0;
            $tmp = [];
            foreach ($parameters as $key => $value) {
                if (!empty($value)) {
                    $tmp[] = "{$key}=" . rawurlencode($value);
                    $pCnt++;
                }
            }
            if ($pCnt > 0) {
                $output .= (strpos($url, '?') === false ? '?' : '&') . implode("&", $tmp);
            }
        }
        return $output;
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function applyTemplate(string $template, array $parameters) : string
    {
        $output = $template;
        foreach (array_keys($parameters) as $key) {
            $value = $parameters[$key];
            $type = gettype($value);
            if ($type === "boolean" || $type === "integer" || $type === "double" || $type === "string") {
                $output = preg_replace("/{\\s*({$key})\\s*}/", $value, $output);
            } else {
                if ($type === 'object') {
                    $output = preg_replace("/{\\s*({$key})\\s*}/", get_class($value), $output);
                } else {
                    if ($type === 'NULL') {
                        $output = preg_replace("/{\\s*({$key})\\s*}/", '', $output);
                    }
                }
            }
            //TODO: Revisit this?
            //else {
            //
            //    $output = (gettype($value) == 'object' ? get_class($value) : gettype($value));
            //}
        }
        return $output;
    }
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    public static function redirect(string $url, array $parameters = null, int $status = null)
    {
        if ($status === null) {
            $status = 302;
        }
        //die(static::getUrl($url, null, $parameters, false));
        wp_redirect(static::getUrl($url, null, $parameters, false));
        exit($status);
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function getSiteLink(array $controllers = null, array $parameters = null, bool $absolute = true) : string
    {
        $url = "/";
        if ($absolute === true) {
            $url = get_home_url(null, $url);
        }
        return static::getUrl($url, $controllers, $parameters);
    }
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    public static function addScript(string $id, string $src, bool $backEnd = true, bool $frontEnd = false, bool $inline = false, bool $addToEnd = false, int $priority = 1, ISemVer $version = null, array $dependencies = [])
    {
        static::$scripts[$id] = ["id" => (string) $id, "src" => (string) $src, "backEnd" => (bool) $backEnd, "frontEnd" => (bool) $frontEnd, "inline" => (bool) $inline, "addToEnd" => (bool) $addToEnd, "priority" => (int) $priority, 'version' => $version === null ? static::isDebugMode() ? (string) time() : null : $version->toString(), "dependencies" => $dependencies];
    }
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    public static function hasScript(string $id) : bool
    {
        return array_key_exists($id, static::$scripts);
    }
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    public static function addStyle(string $id, string $src, bool $backEnd = true, bool $frontEnd = false, bool $inline = false, string $media = "screen", int $priority = 1, ISemVer $version = null, array $dependencies = [])
    {
        static::$styles[$id] = ["id" => (string) $id, "src" => (string) $src, "backEnd" => (bool) $backEnd, "frontEnd" => (bool) $frontEnd, "inline" => (bool) $inline, "media" => (string) $media, "priority" => (int) $priority, 'version' => $version === null ? static::isDebugMode() ? (string) time() : null : $version->toString(), "dependencies" => $dependencies];
    }
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    public static function hasStyle(string $id) : bool
    {
        return array_key_exists($id, static::$styles);
    }
    
    /**
     * method
     * 
     * @return bool
     */
    
    public static function isWordPress() : bool
    {
        if (!defined('ABSPATH')) {
            return false;
        }
        return true;
    }
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    public static function isAdmin(bool $includeLoginPage = false) : bool
    {
        if (defined('WP_HELPER_ADMIN')) {
            return constant('WP_HELPER_ADMIN');
        }
        if ($includeLoginPage === true) {
            global $pagenow;
            $tmp = in_array($pagenow, ['wp-login.php', 'wp-register.php']);
            if ($tmp === true) {
                return true;
            }
        }
        if (function_exists('is_user_logged_in')) {
            return is_admin() && is_user_logged_in();
        }
        return is_admin();
    }
    
    /**
     * method
     * 
     * @return bool
     */
    
    public static function hasPermalinks() : bool
    {
        return PHP::toBool(static::getRawOption('permalink_structure') !== null);
    }
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    public static function addImageSize(string $name, int $width = null, int $height = null, bool $crop = null, bool $selectable = null, string $caption = null)
    {
        static::$imageSizes[$name] = ['name' => $name, 'width' => $width === null ? 0 : $width, 'height' => $height === null ? 0 : $height, 'crop' => $crop === null ? false : true, 'selectable' => $selectable === null ? false : true, 'caption' => $caption];
        return;
    }
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    public static function exitWithCode(int $code)
    {
        status_header($code);
        nocache_headers();
        switch ($code) {
            case 404:
                include_once get_query_template('404');
                break;
        }
        exit;
    }
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    public static function setCookie(string $name, string $value, int $expiryTimeStamp = null, string $domain = null, string $path = null, bool $secure = null, bool $httpOnly = null) : bool
    {
        if ($secure === null) {
            $secure = false;
        }
        if ($httpOnly === null) {
            $httpOnly = false;
        }
        if (is_multisite()) {
            $blogInfo = get_blog_details(get_current_blog_id());
            $domain = $blogInfo->domain;
            $path = $blogInfo->path;
        }
        if ($domain === null) {
            $domain = (string) Uri::parse(WP::getSiteUri())->getHost();
        }
        if ($path === null) {
            $path = '/';
        }
        return setcookie($name, $value, $expiryTimeStamp != null ? $expiryTimeStamp : 0, $path, $domain, $secure, $httpOnly);
    }
    
    /**
     * method
     * 
     * 
     * @return ?string
     */
    
    public static function getCurrentObjectType(bool $ignoreTheLoop = false)
    {
        if (static::isAdmin()) {
            return static::getCurrentAdminObjectType();
        }
        return static::getCurrentTemplateObjectType($ignoreTheLoop);
    }
    
    /**
     * method
     * 
     * 
     * @return ?object
     */
    
    public static function getCurrentObject(bool $ignoreTheLoop = false)
    {
        if (static::isAdmin()) {
            return static::getCurrentAdminObject();
        }
        return static::getCurrentTemplateObject($ignoreTheLoop);
    }
    
    /**
     * method
     * 
     * 
     * @return ?int
     */
    
    public static function getCurrentObjectId(bool $ignoreTheLoop = false)
    {
        if (static::isAdmin()) {
            return static::getCurrentAdminObjectId();
        }
        return static::getCurrentTemplateObjectId($ignoreTheLoop);
    }

}