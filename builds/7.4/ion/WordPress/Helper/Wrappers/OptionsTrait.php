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
use ion\Logging\LogLevel;
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
    // --- USE THESE INSTEAD ---
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
    public static function setSiteOption(string $name, $value = null, bool $autoLoad = false) : bool
    {
        return (bool) update_option($name, $value, $autoLoad);
    }
    public static function hasSiteOption(string $name) : bool
    {
        return static::_hasOption($name);
    }
    public static function removeSiteOption(string $name) : bool
    {
        return (bool) delete_option($name);
    }
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
    public static function setPostOption(string $name, int $metaId, $value = null, bool $autoLoad = false) : bool
    {
        return (bool) update_post_meta($metaId, $name, $value);
    }
    public static function hasPostOption(string $name, int $metaId) : bool
    {
        return static::_hasOption($name, 'post', $metaId);
    }
    public static function removePostOption(string $name, int $metaId, $value = null) : bool
    {
        return (bool) delete_post_meta($metaId, $name, $value);
    }
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
    public static function setTermOption(string $name, int $metaId, $value = null, bool $autoLoad = false) : bool
    {
        return (bool) update_term_meta($metaId, $name, $value);
    }
    public static function hasTermOption(string $name, int $metaId) : bool
    {
        return static::_hasOption($name, 'term', $metaId);
    }
    public static function removeTermOption(string $name, int $metaId, $value = null) : bool
    {
        return (bool) delete_term_meta($metaId, $name, $value);
    }
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
    public static function setUserOption(string $name, int $metaId, $value = null, bool $autoLoad = false) : bool
    {
        return (bool) update_user_meta($metaId, $name, $value);
    }
    public static function hasUserOption(string $name, int $metaId) : bool
    {
        return static::_hasOption($name, 'user', $metaId);
    }
    public static function removeUserOption(string $name, int $metaId, $value = null) : bool
    {
        return (bool) delete_user_meta($metaId, $name, $value);
    }
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
    public static function setCommentOption(string $name, int $metaId, $value = null, bool $autoLoad = false) : bool
    {
        return (bool) update_comment_meta($metaId, $name, $value);
    }
    public static function hasCommentOption(string $name, int $metaId) : bool
    {
        return static::_hasOption($name, 'comment', $metaId);
    }
    public static function removeCommentOption(string $name, int $metaId, $value = null) : bool
    {
        return (bool) delete_comment_meta($metaId, $name, $value);
    }
    public static function getCustomizationOption(string $name, $default = null)
    {
        if (!static::hasCustomizationOption($name)) {
            return $default;
        }
        return get_theme_mod($name, null);
    }
    public static function setCustomizationOption(string $name, $value = null) : void
    {
        set_theme_mod($name, $value);
        return;
    }
    public static function hasCustomizationOption(string $name) : bool
    {
        return PHP::isEmpty(get_theme_mod($name)) !== null;
    }
    public static function removeCustomizationOption(string $name) : void
    {
        remove_theme_mod($name);
        return;
    }
    public static function addCustomizationSection(string $title, string $slug = null, int $priority = null, string $textDomain = null) : AdminCustomizeHelperInterface
    {
        $themeOption = ['slug' => $slug === null ? WP::slugify($title) : $slug, 'title' => $title, 'priority' => $priority === null ? 30 : $priority, 'textDomain' => $textDomain, 'settings' => []];
        static::$themeOptions[$themeOption['slug']] =& $themeOption;
        return new AdminCustomizeHelper($themeOption['settings']);
    }
    // --- DEPRECATED ---
    public static function getOption(string $key, $default = null, int $id = null, OptionMetaType $type = null, bool $raw = false)
    {
        if (static::hasOption($key, $id, $type) === false) {
            return $default;
        }
        $value = null;
        //        var_dump($type);
        if ($id === null) {
            $value = get_option($key, null);
        } else {
            if ($type === null) {
                $type = new OptionMetaType(OptionMetaType::POST);
            }
            //            var_dump($type->toValue());
            switch ($type->toValue()) {
                case OptionMetaType::TERM:
                    $value = get_term_meta($id, $key, true);
                    //                    echo "<pre>";
                    //                    var_dump($id);
                    //                    var_dump($key);
                    //                    var_dump($value);
                    //                    echo "</pre>";
                    break;
                case OptionMetaType::USER:
                    $value = get_user_meta($id, $key, true);
                    break;
                case OptionMetaType::COMMENT:
                    $value = get_comment_meta($id, $key, true);
                    break;
                case OptionMetaType::POST:
                    $value = get_post_meta($id, $key, true);
                    break;
            }
        }
        if ($value === null || $value !== null && $value === '') {
            return $default;
        }
        if ($raw === true) {
            return $value;
        }
        $tmp = null;
        try {
            $tmp = PHP::unserialize($value);
        } catch (PhpHelperException $ex) {
            $tmp = $value;
        }
        return $tmp;
    }
    public static function setOption(string $key, $value = null, int $id = null, OptionMetaType $type = null, bool $raw = false, bool $autoLoad = false) : bool
    {
        if ($raw === false) {
            $value = PHP::serialize($value);
        } else {
            $value = $value === null ? '' : $value;
        }
        //($id === null ? update_option($key, $value, $autoLoad) : ($term ?  : ));
        if ($id === null) {
            return update_option($key, $value, $autoLoad);
        } else {
            if ($type === null) {
                $type = new OptionMetaType(OptionMetaType::POST);
            }
            switch ($type->toValue()) {
                case OptionMetaType::TERM:
                    return update_term_meta($id, $key, $value);
                case OptionMetaType::USER:
                    return update_user_meta($id, $key, $value);
                case OptionMetaType::COMMENT:
                    return update_comment_meta($id, $key, $value);
                case OptionMetaType::POST:
                    return update_post_meta($id, $key, $value);
            }
        }
        return false;
    }
    public static function hasOption(string $key, int $id = null, OptionMetaType $type = null) : bool
    {
        $tmp = null;
        if ($type === null) {
            $type = new OptionMetaType(OptionMetaType::POST);
        }
        switch ($type->toValue()) {
            case OptionMetaType::TERM:
                $tmp = 'term';
                break;
            case OptionMetaType::USER:
                $tmp = 'user';
                break;
            case OptionMetaType::COMMENT:
                $tmp = 'comment';
                break;
            case OptionMetaType::POST:
                $tmp = 'post';
                break;
        }
        return static::_hasOption($key, $tmp, $id);
    }
    public static function removeOption(string $key, int $id = null, OptionMetaType $type = null) : bool
    {
        if ($id === null) {
            return delete_option($key);
        }
        if ($type === null) {
            $type = new OptionMetaType(OptionMetaType::POST);
        }
        switch ($type->toValue()) {
            case OptionMetaType::TERM:
                return delete_term_meta($id, $key);
            case OptionMetaType::USER:
                return delete_user_meta($id, $key);
            case OptionMetaType::POST:
                return delete_post_meta($id, $key);
            case OptionMetaType::COMMENT:
                return delete_comment_meta($id, $key);
        }
    }
    public static function getRawOption(string $key, $default = null, int $id = null, OptionMetaType $type = null)
    {
        return static::getOption($key, $default, $id, $type, true);
    }
    public static function setRawOption(string $key, $value = null, int $id = null, OptionMetaType $type = null, bool $autoLoad = false) : bool
    {
        return static::setOption($key, $value, $id, $type, true, $autoLoad);
    }
}