<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

use \Throwable;
use \WP_Post;
use \WP_Error;
use \WP_Term;
use \ion\WordPress\Helper\WordPressHelperException;
//use \ion\WordPress\Helper\WordPressException;
use \ion\WordPress\WordPressHelperInterface;
use \ion\WordPress\Helper\Tools;
use \ion\WordPress\Helper\Constants;
use \ion\PhpHelper as PHP;
use \ion\Package;
use \ion\SemVerInterface;
use \ion\SemVer;
use \ion\WordPress\Helper\WordPressTaxonomyInterface;
use \ion\WordPress\Helper\WordPressTerm;

/**
 * Description of TaxonomiesTrait*
 * @author Justus
 */
trait TaxonomiesTrait {
    
//    private static $taxonomies = [];
//    private static $taxonomiesToLink = []; 
    
    
    protected static function initialize() {
//        
//        static::registerWrapperAction('init', function() {            
//            
//            foreach(static::$taxonomies as $taxonomySlug => $taxonomy) {
//
//
//
//                //echo "<pre>"; var_dump($GLOBALS['wp_post_types']['qualifications']); die("</pre>");
//            }
//
//            foreach(static::$taxonomiesToLink as $taxonomySlug => $postTypes) {
//
//                foreach($postTypes as $postType) {
//                    
//                    register_taxonomy_for_object_type($taxonomySlug, $postType);
//                }
//            }    
//            
//        }, 1);            
    }
    
    public static function addTaxonomy(
            
        string $slug,
        string $pluralLabel,
        string $singularLabel,
        array $postTypes = null,
        string $description = null,                                  
        bool $registerMetaBox = true,
        callable $metaBoxCallback = null,
        bool $hierarchical = null, 
        bool $sort = null,
        array $labels = null,
        bool $public = null,
        bool $publiclyQueryable = null,
        bool $showUi = null,
        bool $showInNavMenus = null,
        bool $showInMenu = null,
        bool $showTagcloud = null,
        bool $showInQuickEdit = null,
        bool $showAdminColumn = null,
        array $capabilities = null,
        bool $rewrite = null,
        string $rewriteSlug = null,
        bool $rewriteWithFront = null,
        bool $rewriteHierarchical = null,
        string $rewriteEndPointMask = null,
        bool $enableQueryVar = null,
        string $queryVar = null,
        bool $showInRest = null,
        string $restBase = null,
        string $restControllerClass = null,        
        callable $updateCountCallback = null 
            
    ): void {
        
        if(PHP::isEmpty($slug)) {

            throw new WordPressHelperException("Please provide a slug for the taxonomy.");
        }             
        
        if($labels === null) {
            
            $labels = [
                
                'name' => $pluralLabel,
                'singular_name' => $singularLabel,                                
                'menu_name' => $pluralLabel,
                'all_items' => "All {$pluralLabel}",
                'edit_item' => "Edit {$singularLabel}",
                'view_item' => "View {$singularLabel}",
                'update_item' => "Update {$singularLabel}",
                'add_new_item' => "Add New {$singularLabel}",
                'new_item_name' => "New {$singularLabel} Name",
                'parent_item' => "Parent {$singularLabel}",
                'parent_item_colon' => "Parent {$singularLabel}:",
                'search_items' => "Search {$pluralLabel}",
                'popular_items' => "Popular {$pluralLabel}",
                'separate_items_with_commas' => __( "Separate {$pluralLabel} with commas" ),
                'add_or_remove_items' => __( "Add or remove {$pluralLabel}" ),
                'choose_from_most_used' => __( "Choose from the most used {$pluralLabel}" ),
                'not_found'  => "No {$pluralLabel} found.",               
            ];

        } else {
            
            if(!array_key_exists('name', $labels)) {
                
                $labels['name'] = $pluralLabel;
            }
            
            if(!array_key_exists('singular_name', $labels)) {
                
                $labels['singular_name'] =  $singularLabel;
            }
        }

        if(PHP::isEmpty($labels['name'])) {

            throw new WordPressHelperException("Please provide a name for the taxonomy ('{$slug}').");
        }            

        if(PHP::isEmpty($labels['singular_name'])) {

            throw new WordPressHelperException("Please provide a singular name for the taxonomy ('{$slug}').");
        }        
        
//        static::$taxonomies[$slug] = [
//            'slug' => $slug,
//            'pluralLabel' => $pluralLabel,
//            'singularLabel' => $singularLabel,
//            'postTypes' => ($postTypes === null ? null : $postTypes),
//            'description' => $description,                                  
//            'registerMetaBox' => $registerMetaBox,
//            'metaBoxCallback' => $metaBoxCallback,
//            'hierarchical' => $hierarchical, 
//            'sort' => $sort,
//            'labels' => $labels,
//            'public' => $public,
//            'publiclyQueryable' => $publiclyQueryable,
//            'showUi' => $showUi,
//            'showInNavMenus' => $showInNavMenus,
//            'showInMenu' => $showInMenu,
//            'showTagcloud' => $showTagcloud,
//            'showInQuickEdit' => $showInQuickEdit,
//            'showAdminColumn' => $showAdminColumn,            
//            'capabilities' => ($capabilities === null ? null : $capabilities),
//            'rewrite' => $rewrite,
//            'rewriteSlug' => $rewriteSlug,
//            'rewriteWithFront' => $rewriteWithFront,
//            'rewriteHierarchical' => $rewriteHierarchical,
//            'rewriteEndPointMask' => $rewriteEndPointMask,
//            'enableQueryVar' => $enableQueryVar,
//            'queryVar' => $queryVar,
//            'showInRest' => $showInRest,
//            'restBase' => $restBase,
//            'restControllerClass' => $restControllerClass,        
//            'updateCountCallback' => $updateCountCallback              
//            
//        ];
        
        // Remove all NULL values from the array to enforce defaults on WordPress' side
        
        $args = array_filter([

            'label' => $pluralLabel,
            
            'labels' => array_filter($labels, function($value) { return ($value !== null); }),
                    
            'public' => ($public === null ? true : $public),
            'publicly_queryable' => ($publiclyQueryable === null ? false : $publiclyQueryable),        
            'show_ui' => ($showUi === null ? true : $showUi),
            'show_in_menu' => ($showInMenu === null ? true : $showInMenu),                        
            'show_in_nav_menus' => ($showInNavMenus === null ? true : $showInNavMenus),                        
            'show_in_rest' => ($showInRest === null ? true : $showInRest),
            'rest_base' => $restBase,
            'rest_controller_class' => $restControllerClass, 
            'show_tagcloud' => $showTagcloud,
            'show_in_quick_edit' => $showInQuickEdit,
            'meta_box_cb' => ($registerMetaBox === true ? $metaBoxCallback : false),
            'show_admin_column' => $showAdminColumn,
            'description' => $description,
            'hierarchical' => ($hierarchical === null ? false : $hierarchical), 
            'update_count_callback' => $updateCountCallback,
            'query_var' => (PHP::isEmpty((bool) $enableQueryVar) ? false : (string) $queryVar),
                    
            'rewrite' => (PHP::isEmpty($rewrite) ? null : array_filter([
                
                'slug' => $rewriteSlug,
                'with_front' => $rewriteWithFront,
                'hierarchical' => $rewriteHierarchical,
                'ep_mask' => $rewriteEndPointMask
                
            ], function($value) { return ($value !== null); })),    
            
            'capabilities' => $capabilities,            
            'sort' => $sort

        ], function($value) { return ($value !== null); });

        register_taxonomy($slug, $postTypes, $args);
        
//        foreach($postTypes as $postType) {
//
//            register_taxonomy_for_object_type($slug, $postType);
//        }        
        
        return;   
    }
    
    public static function addPostTypesToTaxonomy(string $taxonomy, array $postTypes): void {
        
        foreach($postTypes as $postType) {
            
//            static::$taxonomiesToLink[$taxonomy][] = $postType;
            register_taxonomy_for_object_type($taxonomy, $postType);
        }
     
        return;
    }
    
    public static function getTaxonomyFromTerm(string $termSlug): ?string {

        global $wpdb;

        $sql = <<<SQL

SELECT taxonomy FROM `wp_term_taxonomy`
WHERE term_id IN (
    SELECT term_id FROM `wp_terms` WHERE slug LIKE (%s)
)
SQL;

        $result = $wpdb->get_var($wpdb->prepare($sql, $termSlug));

        if ($result !== null) {
            
            return $result;
        }

        return null;
    }
        
    public static function getTermParent(int $termId): ?\WP_Term {
        
        $term = get_term($termId);
        
        if(is_wp_error($term) || $term === null) {
            
            return null;
        }
        
        $parent = get_term($term->parent);
        
        if(is_wp_error($parent) || $parent === null) {
            
            return null;
        }        
        
        return $parent;
    }
    
    
    public static function getTermParents(int $termId): array {        
     
        $terms = [];
        $term = static::getTermParent($termId); 
        
        while($term !== null) {
        
            $terms[] = $term;
            
            $term = static::getTermParent($term->term_id);                        
        }         
         
        return $terms;
    }    
    
    public static function getTerms(array $taxonomies, bool $hierarchy = true, int $parent = null, bool $hideEmpty = false): array {
        
        $result = get_terms([
            
            'taxonomy' => $taxonomies,
            'hide_empty' => $hideEmpty
        ]);       
        
        if($result instanceof \WP_Error) {
            
            throw new WordPressHelperException(null, $result);
        }
        
        if(!PHP::isArray($result)) {
            
            return [];
        }       

        $terms = [];
        
        foreach($result as $termObject) {

            if($termObject->parent === $parent ?? 0) {
                
//                $term = null;
//                
//                if($hierarchy) {
//                    
//                    $children = static::getTerms($taxonomies, $hierarchy, $termObject->term_id, $hideEmpty);
//                    
//                    $term = new WordPressTerm($termObject, );     
//                    
//                } else {
//                    
//                    $term = $termObject; 
//                }
                
                $terms[] = $termObject;                                
            }                                    
        }
        
        return $terms;
    }
    
}
