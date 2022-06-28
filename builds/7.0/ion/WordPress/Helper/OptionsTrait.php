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
//use \ion\Logging\LogLevel;
use ion\WordPress\Helper\LogLevel;
use ion\PhpHelper as PHP;
use ion\PhpHelperException;
use ion\Package;
use ion\SemVerInterface;
use ion\SemVer;
use ion\WordPress\Helper\Wrappers\OptionMetaType;
use WP_Customize_Manager;
use WP_Customize_Media_Control;
use ion\WordPress\Helper\AdminCustomizeHelperInterface;
use ion\WordPress\Helper\AdminCustomizeHelper;
/**
 * Description of RewriteApiTrait*
 * @author Justus
 */
trait OptionsTrait
{
    private static $themeOptions = [];
    /**
     * method
     * 
     * @return mixed
     */
    protected static function initialize()
    {
        static::registerWrapperAction('customize_register', function (\WP_Customize_Manager $wpCustomize) {
            foreach (static::$themeOptions as $sectionSlug => $themeOption) {
                $wpCustomize->add_section($sectionSlug, ['title' => $themeOption['title'], 'priority' => $themeOption['priority']]);
                foreach ($themeOption['settings'] as $settingSlug => $setting) {
                    $wpCustomize->add_setting($settingSlug, ['default' => null, 'transport' => 'refresh']);
                    $label = !PHP::isEmpty($themeOption['textDomain']) ? __($setting['label'], $themeOption['textDomain']) : $setting['label'];
                    if ($setting['type'] == 'media') {
                        $wpCustomize->add_control(new WP_Customize_Media_Control($wpCustomize, $settingSlug, ['label' => $label, 'section' => $sectionSlug, 'settings' => $settingSlug, 'priority' => 8]));
                        continue;
                    }
                    if ($setting['type'] == 'select') {
                        $wpCustomize->add_control($settingSlug, ['label' => $label, 'section' => $sectionSlug, 'settings' => $settingSlug, 'type' => 'select', 'choices' => $setting['options']]);
                        continue;
                    }
                    if ($setting['type'] == 'checkbox') {
                        $wpCustomize->add_control($settingSlug, ['label' => $label, 'section' => $sectionSlug, 'settings' => $settingSlug, 'type' => 'checkbox']);
                        continue;
                    }
                    if ($setting['type'] == 'text') {
                        if ($setting['multiLine'] === true) {
                            $wpCustomize->add_control($settingSlug, ['label' => $label, 'section' => $sectionSlug, 'settings' => $settingSlug, 'type' => 'textarea']);
                            continue;
                        }
                        $wpCustomize->add_control($settingSlug, ['label' => $label, 'section' => $sectionSlug, 'settings' => $settingSlug, 'type' => 'text']);
                        continue;
                    }
                }
            }
        });
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    private static function _hasOption(string $name, string $type = null, int $id = null) : bool
    {
        global $wpdb;
        $sqlQuery = null;
        $optionField = 'option_name';
        if ($id === null || $type === null) {
            $sqlQuery = "SELECT * FROM `{$wpdb->prefix}options` WHERE {$optionField} LIKE ('{$name}') LIMIT 1";
        } else {
            $sqlQuery = "SELECT * FROM `{$wpdb->prefix}{$type}meta` WHERE `meta_key` LIKE ('{$name}') AND `{$type}_id` = {$id} LIMIT 1";
        }
        $results = $wpdb->get_results($sqlQuery, 'OBJECT');
        if (PHP::count($results) > 0) {
            return true;
        }
        return false;
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public static function getSiteOption(string $name, $default = null)
    {
        if (!static::hasSiteOption($name)) {
            return $default;
        }
        $value = get_option($name, null);
        if (PHP::isEmpty($value, false, false)) {
            return $default;
        }
        return $value;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function setSiteOption(string $name, $value = null, bool $autoLoad = false) : bool
    {
        return (bool) update_option($name, $value, $autoLoad);
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function hasSiteOption(string $name) : bool
    {
        return static::_hasOption($name);
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function removeSiteOption(string $name) : bool
    {
        return (bool) delete_option($name);
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public static function getPostOption(string $name, int $metaId, $default = null)
    {
        if (!static::hasPostOption($name, $metaId)) {
            return $default;
        }
        $value = get_post_meta($metaId, $name, true);
        if (PHP::isEmpty($value, false, false)) {
            return $default;
        }
        return $value;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function setPostOption(string $name, int $metaId, $value = null, bool $autoLoad = false) : bool
    {
        return (bool) update_post_meta($metaId, $name, $value);
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function hasPostOption(string $name, int $metaId) : bool
    {
        return static::_hasOption($name, 'post', $metaId);
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function removePostOption(string $name, int $metaId, $value = null) : bool
    {
        return (bool) delete_post_meta($metaId, $name, $value);
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public static function getTermOption(string $name, int $metaId, $default = null)
    {
        if (!static::hasTermOption($name, $metaId)) {
            return $default;
        }
        $value = get_term_meta($metaId, $name, true);
        if (PHP::isEmpty($value, false, false)) {
            return $default;
        }
        return $value;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function setTermOption(string $name, int $metaId, $value = null, bool $autoLoad = false) : bool
    {
        return (bool) update_term_meta($metaId, $name, $value);
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function hasTermOption(string $name, int $metaId) : bool
    {
        return static::_hasOption($name, 'term', $metaId);
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function removeTermOption(string $name, int $metaId, $value = null) : bool
    {
        return (bool) delete_term_meta($metaId, $name, $value);
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public static function getUserOption(string $name, int $metaId, $default = null)
    {
        if (!static::hasUserOption($name, $metaId)) {
            return $default;
        }
        $value = get_user_meta($metaId, $name, true);
        if (PHP::isEmpty($value, false, false)) {
            return $default;
        }
        return $value;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function setUserOption(string $name, int $metaId, $value = null, bool $autoLoad = false) : bool
    {
        return (bool) update_user_meta($metaId, $name, $value);
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function hasUserOption(string $name, int $metaId) : bool
    {
        return static::_hasOption($name, 'user', $metaId);
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function removeUserOption(string $name, int $metaId, $value = null) : bool
    {
        return (bool) delete_user_meta($metaId, $name, $value);
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public static function getCommentOption(string $name, int $metaId, $default = null)
    {
        if (!static::hasCommentOption($name)) {
            return $default;
        }
        $value = get_comment_meta($metaId, $name, true);
        if (PHP::isEmpty($value, false, false)) {
            return $default;
        }
        return $value;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function setCommentOption(string $name, int $metaId, $value = null, bool $autoLoad = false) : bool
    {
        return (bool) update_comment_meta($metaId, $name, $value);
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function hasCommentOption(string $name, int $metaId) : bool
    {
        return static::_hasOption($name, 'comment', $metaId);
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function removeCommentOption(string $name, int $metaId, $value = null) : bool
    {
        return (bool) delete_comment_meta($metaId, $name, $value);
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public static function getCustomizationOption(string $name, $default = null)
    {
        if (!static::hasCustomizationOption($name)) {
            return $default;
        }
        return get_theme_mod($name, null);
    }
    /**
     * method
     * 
     * 
     * @return void
     */
    public static function setCustomizationOption(string $name, $value = null)
    {
        set_theme_mod($name, $value);
        return;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public static function hasCustomizationOption(string $name) : bool
    {
        return PHP::isEmpty(get_theme_mod($name)) !== null;
    }
    /**
     * method
     * 
     * 
     * @return void
     */
    public static function removeCustomizationOption(string $name)
    {
        remove_theme_mod($name);
        return;
    }
    /**
     * method
     * 
     * 
     * @return AdminCustomizeHelperInterface
     */
    public static function addCustomizationSection(string $title, string $slug = null, int $priority = null, string $textDomain = null) : AdminCustomizeHelperInterface
    {
        $themeOption = ['slug' => $slug === null ? WP::slugify($title) : $slug, 'title' => $title, 'priority' => $priority ?? 30, 'textDomain' => $textDomain, 'settings' => []];
        static::$themeOptions[$themeOption['slug']] =& $themeOption;
        return new AdminCustomizeHelper($themeOption['settings']);
    }
}