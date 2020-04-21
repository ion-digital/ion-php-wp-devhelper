<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

use \Throwable;
use \WP_Post;
use \ion\WordPress\IWordPressHelper;
use \ion\Types\Arrays\IMap;
use \ion\Types\Arrays\Map;
use \ion\Types\Arrays\IVector;
use \ion\Types\Arrays\Vector;
use \ion\WordPress\Helper\Tools;
use \ion\WordPress\Helper\Constants;
use \ion\Logging\LogLevel;
use \ion\PhpHelper as PHP;
use \ion\Package;
use \ion\System\File;
use \ion\System\Path;
use \ion\System\FileMode;
use \ion\ISemVer;
use \ion\SemVer;
use \ion\Types\StringObject;
use \ion\WordPress\Helper\Wrappers\OptionMetaType;
use \WP_Customize_Manager;
use \WP_Customize_Media_Control;
use \ion\WordPress\Helper\IAdminCustomizeHelper;
use \ion\WordPress\Helper\AdminCustomizeHelper;

/**
 * Description of TRewriteApi
 *
 * @author Justus
 */

trait TOptions {
    
    private static $themeOptions = [];
    
    protected static function initialize_TOptions() {    
        
        static::registerWrapperAction('customize_register', function(WP_Customize_Manager $wpCustomize) {

//            echo("<pre>");
//        var_dump(static::$themeOptions);
//            die("</pre>");
            
            foreach(static::$themeOptions as $sectionSlug => $themeOption) {
                
                $wpCustomize->add_section($sectionSlug, [
                    
                    'title' => $themeOption['title'],
                    'priority' => $themeOption['priority']
                ]);
                
                foreach($themeOption['settings'] as $settingSlug => $setting) {
                
                    $wpCustomize->add_setting($settingSlug, [

                        'default' => null,
                        'transport' => 'refresh'
                    ]);
                    
                    $label = (!PHP::isEmpty($themeOption['textDomain']) ? __($setting['label'], $themeOption['textDomain']) : $setting['label']);

                    if($setting['type'] == 'media') {
                        
                        $wpCustomize->add_control(new WP_Customize_Media_Control(
                                
                            $wpCustomize, 
                            $settingSlug, 
                            [

                                'label' => $label,
                                'section' => $sectionSlug,
                                'settings' => $settingSlug,
                                'priority' => 8
                            ]));                              
                        
                        continue;
                    }                    
                    
                    if($setting['type'] == 'select') {
                        
                        $wpCustomize->add_control(

                            $settingSlug,
                            [
                                'label' => $label,
                                'section' => $sectionSlug,
                                'settings' => $settingSlug,
                                'type' => 'select',
                                'choices' => $setting['options']
                            ]
                        );      
                        
                        continue;
                    }       
                    
                    if($setting['type'] == 'checkbox') {
                        
                        $wpCustomize->add_control(

                            $settingSlug,
                            [
                                'label' => $label,
                                'section' => $sectionSlug,
                                'settings' => $settingSlug,
                                'type' => 'checkbox'
                            ]
                        );                             
                        
                        continue;
                    }
                    
                    if($setting['type'] == 'text') {
                        
                        if($setting['multiLine'] === true) {
                            
                            $wpCustomize->add_control(

                                $settingSlug,
                                [
                                    'label' => $label,
                                    'section' => $sectionSlug,
                                    'settings' => $settingSlug,
                                    'type' => 'textarea'
                                ]
                            );                                 
                            
                            continue;
                        }
                        
                        $wpCustomize->add_control(

                            $settingSlug,
                            [
                                'label' => $label,
                                'section' => $sectionSlug,
                                'settings' => $settingSlug,
                                'type' => 'text'
                            ]
                        );                             
                        
                        continue;
                    }
                    
                    
                    
           
                }
            }
            
        });        
        
    }
    
    public static function addCustomizationSection(string $title, string $slug = null, int $priority = null, string $textDomain = null): IAdminCustomizeHelper {
        
        $themeOption = [
            
            'slug' => ($slug === null ? WP::slugify($title) : $slug),
            'title' => $title,
            'priority' => ($priority === null ? 30 : $priority),
            'textDomain' => $textDomain,
            'settings' => []
        ];
        
        static::$themeOptions[$themeOption['slug']] = &$themeOption;
        
        return new AdminCustomizeHelper($themeOption['settings']);
    }

    public static function getOption(string $key, /* mixed */ $default = null, int $id = null, OptionMetaType $type = null, bool $raw = false) {

        if (static::hasOption($key, $id, $type) === false) {
            
            return $default;
        }

        $value = null;
        
//        var_dump($type);
        
        if($id === null) {
            
            $value = get_option($key, null);            
            
        } else {
            
            if($type === null) {
                
                $type = OptionMetaType::POST();
            }            
        
//            var_dump($type->toValue());
            
            switch($type->toValue()) {
    
                case OptionMetaType::TERM: {
                    
                    $value = get_term_meta($id, $key, true);
                    
//                    echo "<pre>";
//                    var_dump($id);
//                    var_dump($key);
//                    var_dump($value);
//                    echo "</pre>";                    
                    
                    break;
                }

                case OptionMetaType::USER: {
                    
                    $value = get_user_meta($id, $key, true);
                    break;
                }         
                
                case OptionMetaType::COMMENT: {
                    
                    $value = get_comment_meta($id, $key, true);
                    break;
                }                    
                
                case OptionMetaType::POST: {
                    
                    $value = get_post_meta($id, $key, true);
                    break;
                }                
            }            
        }

        if ($value === null || ($value !== null && $value === '')) {
            
            return $default;
        }

        if ($raw === true) {
            
            return $value;
        }

        $tmp = @unserialize($value);
        
        if($tmp !== false) {
            
            return $tmp;
        }
        
        return false;
    }


    public static function setOption(string $key, /* mixed */ $value = null, int $id = null, OptionMetaType $type = null, bool $raw = false, bool $autoLoad = false): bool {

        if (!$raw /* && $value !== null */) {
               
            $value = serialize($value);
            
        } else {
            
            $value = ($value === null ? '' : $value);
        }
        
        //($id === null ? update_option($key, $value, $autoLoad) : ($term ?  : ));
        
        
        if($id === null) {
            
            return update_option($key, $value, $autoLoad);            
            
        } else {
            
            if($type === null) {
                
                $type = OptionMetaType::POST();
            }               
                    
            switch($type->toValue()) {
    
                case OptionMetaType::TERM: {
                    
                    return update_term_meta($id, $key, $value);
                }

                case OptionMetaType::USER: {
                    
                    return update_user_meta($id, $key, $value);                    
                }          
                
                case OptionMetaType::COMMENT: {
                    
                    return update_comment_meta($id, $key, $value); 
                }                    
                                
                
                case OptionMetaType::POST: {
                    
                    return update_post_meta($id, $key, $value);                    
                }                
            }            
        }   
        
        return false;
    }           
    
    public static function hasOption(string $key, int $id = null, OptionMetaType $type = null): bool {

        global $wpdb;

        $sqlQuery = null;
        $optionField = 'option_name';            
        
        if($id === null) {
            
            $sqlQuery = "SELECT * FROM `{$wpdb->prefix}options` WHERE {$optionField} LIKE ('{$key}') LIMIT 1";
            
        } else {
            
            $tbl = null;
            $field = null;
            
            if($type === null) {
                
                $type = OptionMetaType::POST();
            }               
            

            
            switch($type->toValue()) {
    
                case OptionMetaType::TERM: {
                    
                    $tbl = 'termmeta';
                    $field = 'term_id';
                    break;
                }

                case OptionMetaType::USER: {
                    
                    $tbl = 'usermeta';
                    $field = 'user_id';
                    break;
                }          
                
                case OptionMetaType::COMMENT: {
                    
                    $tbl = 'commentmeta';
                    $field = 'comment_id';
                    break;
                }                      
                
                case OptionMetaType::POST: {
                    
                    $tbl = 'postmeta';
                    $field = 'post_id';
                    break;
                }                
            }                 
            
            $sqlQuery = "SELECT * FROM `{$wpdb->prefix}{$tbl}` WHERE `meta_key` LIKE ('{$key}') AND `{$field}` = {$id} LIMIT 1";
            
            
        }

        $results = $wpdb->get_results($sqlQuery, OBJECT);       
        
        if (count($results) > 0) {
            
            return true;
        }

        return false;
    }

    public static function removeOption(string $key, int $id = null, OptionMetaType $type = null): bool {

        if($id === null) {
            
            return delete_option($key);            
        }
            
        if($type === null) {

            $type = OptionMetaType::POST();
        }               

        switch($type->toValue()) {

            case OptionMetaType::TERM: {

                return delete_term_meta($id, $key);
            }

            case OptionMetaType::USER: {

                return delete_user_meta($id, $key);                    
            }          

            case OptionMetaType::POST: {

                return delete_post_meta($id, $key);
            }                
        }            

    }      
    
    
    public static function getRawOption(string $key, /* mixed */ $default = null, int $id = null, OptionMetaType $type = null) /* mixed */ {
        
        return static::getOption($key, $default, $id, $type, true);
    }
    
    
    
    public static function setRawOption(string $key, /* mixed */ $value = null, int $id = null, OptionMetaType $type = null, bool $autoLoad = false): bool {
        
        return static::setOption($key, $value, $id, $type, true, $autoLoad);
    }
    
}
