<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

use \Throwable;
use \WP_Post;
use \WP_Term;
use \ion\WordPress\WordPressHelperInterface;
use \ion\WordPress\Helper\Tools;
use \ion\WordPress\Helper\Constants;
use \ion\PhpHelper as PHP;
use \ion\Package;
use \ion\SemVerInterface;
use \ion\SemVer;
use \ion\WordPress\Helper\WordPressPostTypeInterface;
use \ion\WordPress\Helper\WordPressPostType;
use \ion\WordPress\Helper\Wrappers\OptionMetaType;

/**
 * Description of PostsTrait*
 * @author Justus
 */
trait PostsTrait {
    
//    private static $customPostTypes = [];    
    
    protected static function initialize() {    
//        
//        static::registerWrapperAction('init', function() {
//            
//            foreach(static::$customPostTypes as $postTypeSlug => $taxonomy) {
//
//
//            }            
//        });        
    }    
    
    public static function addCustomPostType(
            
        string $slug,
        string $pluralLabel,
        string $singularLabel,
        string $description = null,            
        string $menuIcon = null,  
        array $supports = null,
        array $taxonomies = null,                        
        callable $registerMetaBox = null,
        bool $hierarchical = null,            
        bool $hasArchive = null,    
        string $archiveSlug = null,            
        array $labels = null,
        bool $public = null,
        bool $excludeFromSearch = null,
        bool $publiclyQueryable = null,
        bool $showUi = null,
        bool $showInNavMenus = null,
        bool $showInMenu = null,
        bool $showInAdminBar = null,
        int $menuPosition = null,        
        string $singleCapabilityType = null,
        string $pluralCapabilityType = null,
        array $capabilities = null,
        bool $mapMetaCap = null,
        bool $rewrite = null,
        string $rewriteSlug = null,
        bool $rewriteWithFront = null,
        bool $rewriteFeeds = null,
        bool $rewritePages = null,
        string $rewriteEndPointMask = null,
        bool $enableQueryVar = null,
        string $queryVar = null,
        bool $canExport = null,
        bool $deleteWithUser = null,
        bool $showInRest = null,
        string $restBase = null,
        string $restControllerClass = null 
            
    ): void {
        
        if(PHP::isEmpty($slug)) {

            throw new WordPressHelperException("Please provide a slug for the custom post.");
        }             
        
        if($labels === null) {
            
            $labels = [
                
                'name' => $pluralLabel,
                'singular_name' => $singularLabel,
                'add_new' => _x('Add New', $slug),
                'add_new_item' => "Add New {$singularLabel}",
                'edit_item' => "Edit {$singularLabel}",
                'new_item' => "New {$singularLabel}",
                'view_item' => "View {$singularLabel}",
                'view_items' => "View {$pluralLabel}",
                'search_items' => "Search {$pluralLabel}",
                'not_found' => "No {$pluralLabel} found.",
                'not_found_in_trash' => "No {$pluralLabel} found in Trash",
                'parent_item_colon' => "Parent {$singularLabel}",         
                'all_items' => "All {$pluralLabel}",
                'archives' => "{$singularLabel} Archives",
                'attributes' => "{$singularLabel} Attributes",
                'insert_into_item' => "Insert into {$singularLabel}",
                'uploaded_to_this_item' => "Uploaded to this {$singularLabel}",
                'featured_image' => "Image",
                'set_featured_image' => "Set Image",
                'remove_featured_image' => "Remove Image",
                'use_featured_image' => "Use as image",
                'menu_name' => $pluralLabel
                //'filter_items_list' => null,
                //'items_list_navigation' => null,
                //'items_list' => null,
                //'name_admin_bar' => null
            ];

        } else {
            
            if(!array_key_exists('name', $labels)) {
                
                $labels['name'] = $pluralLabel;
            }
            
            if(!array_key_exists('singular_name', $labels)) {
                
                $labels['singular_name'] = $singularLabel;
            }
        }
        

        if(PHP::isEmpty($labels['name'])) {

            throw new WordPressHelperException("Please provide a name for the custom post ('{$slug}').");
        }            

        if(PHP::isEmpty($labels['singular_name'])) {

            throw new WordPressHelperException("Please provide a singular name for the custom post ('{$slug}').");
        }          
           
//        static::$customPostTypes[$slug] = [
//            
//            'slug' => $slug,
//            'pluralLabel' => $pluralLabel,
//            'labels' => $labels,
//            'description' => $description,
//            'public' => $public,
//            'excludeFromSearch' => $excludeFromSearch,
//            'publiclyQueryable' => $publiclyQueryable,
//            'showUi' => $showUi,
//            'showInNavMenus' => $showInNavMenus,
//            'showInMenu' => $showInMenu,
//            'showInAdminBar' => $showInAdminBar,
//            'menuPosition' => $menuPosition,
//            'menuIcon' => $menuIcon,
//            'singleCapabilityType' => $singleCapabilityType,
//            'pluralCapabilityType' => $pluralCapabilityType,
//            'capabilities' => ($capabilities === null ? null : $capabilities),
//            'mapMetaCap' => $mapMetaCap,
//            'hierarchical' => $hierarchical,
//            'supports' => ($supports === null ? null : $supports),
//            'registerMetaBox' => $registerMetaBox,
//            'taxonomies' => ($taxonomies === null ? null : $taxonomies),
//            'hasArchive' => $hasArchive,
//            'archiveSlug' => $archiveSlug,
//            'rewrite' => $rewrite,
//            'rewriteSlug' => $rewriteSlug,
//            'rewriteWithFront' => $rewriteWithFront,
//            'rewriteFeeds' => $rewriteFeeds,
//            'rewritePages' => $rewritePages,
//            'rewriteEndPointMask' => $rewriteEndPointMask,
//            'enableQueryVar' => $enableQueryVar,
//            'queryVar' => $queryVar,
//            'canExport' => $canExport,
//            'deleteWithUser' => $deleteWithUser,
//            'showInRest' => $showInRest,
//            'restBase' => $restBase,
//            'restControllerClass' => $restControllerClass             
//            
//        ];

        $args = array_filter([
            
            'label' => $pluralLabel,                             
            
            'labels' => array_filter($labels, function($value) { return ($value !== null); }),    
                    
            'description' => $description,
            'public' => ($public ?? true),
            'exclude_from_search' => ($excludeFromSearch ?? false),
            'publicly_queryable' => ($publiclyQueryable ?? false),
            'show_ui' => ($showUi ?? true),
            'show_in_nav_menus' => ($showInNavMenus ?? true),
            'show_in_menu' => ($showInMenu ?? true),
            'show_in_admin_bar' => ($showInAdminBar ? $publiclyQueryable : $showInAdminBar),
            'menu_position' => ($menuPosition ?? 25),
            'menu_icon' => $menuIcon,
            'capability_type' => (PHP::isEmpty($singleCapabilityType) ? (array) [ 'post', 'posts' ] : (PHP::isEmpty($pluralCapabilityType) ? $singleCapabilityType : (array) [ $singleCapabilityType, $pluralCapabilityType ])),                             
            'capabilities' => $capabilities,
            'map_meta_cap' => (PHP::isEmpty($mapMetaCap) ? true : $mapMetaCap ),
            'hierarchical' => ($hierarchical ?? false),
            'supports' => ($supports ?? (PHP::count($supports) > 0 ? (array) $supports : false )),
            'register_meta_box_cb' => $registerMetaBox,
            'taxonomies' => ($taxonomies ? [] : $taxonomies),
            'has_archive' => (PHP::isEmpty($hasArchive) ? false : (PHP::isEmpty($archiveSlug) ? (bool) $hasArchive : (string) $archiveSlug)),                             
                    
            'rewrite' => (PHP::isEmpty($rewrite) ? null : array_filter([
                
                'slug' => $rewriteSlug,
                'with_front' => $rewriteWithFront,
                'feeds' => $rewriteFeeds,
                'pages' => $rewritePages,
                'ep_mask' => $rewriteEndPointMask
                
            ], function($value) { return ($value !== null); })),
                    
            'query_var' => (PHP::isEmpty((bool) $enableQueryVar) ? false : (string) $queryVar),
            'can_export' => $canExport,
            'delete_with_user' => ($deleteWithUser ?? false),
            'show_in_rest' => ($showInRest ?? true),
            'rest_base' => $restBase,
            'rest_controller_class' => $restControllerClass
                
         ], function($value) { return ($value !== null); });


        register_post_type($slug, $args);        
        
        return;
//        return new WordPressPostType($slug, static::$customPostTypes[$slug]);
    }    
    
    public static function postExists(string $slug, string $postType = "post"): bool {

        global $wpdb;

        $sql = <<<SQL
SELECT post_name FROM `wp_posts`
WHERE post_name LIKE (%s)
AND post_type LIKE ('%s')
SQL;

        $result = $wpdb->get_var($wpdb->prepare($sql, $slug, $postType));

        if ($result !== null) {
            return true;
        }

        return false;
    }
    
    public static function pageExists(string $slug): bool {
        
        return static::postExists($slug, 'page');
    }
    
    //TODO: Method not complete!!!
    public static function getChildren(bool $depth = null, string $template = null, bool $echo = true): array {

        throw new Exception("getChildren() has not been fully implemented yet - its on the TODO list!");
        
//        $result = [];
//
//
//        $output = "";
//        $objId = null;
//
//        $post = get_post();
//
//        if (!empty($post)) {
//            $objId = $post->ID;
//        } else {
//            $objId = get_queried_object_id();
//        }
//
//        if ($objId !== null) {
//
//            //TODO: Expand to beyond pages
//
//            $children = get_children([
//                'post_parent' => $objId,
//                'post_type' => 'page',
//                'numberposts' => -1,
//                'post_status' => 'publish'
//            ]);
//
//            foreach ($children as $child) {
//                $result[] = [
//                    'title' => $child->post_title,
//                    'url' => get_permalink($child->ID)
//                ];
//            }
//
//
//            //print_r($children);
//        }
//
//        if ($echo === true) {
//            
//            echo $output;
//        }
//
//        return $result;
    }
    
    public static function getPostParentPost(int $postId): ?\WP_Post {

        $post = get_post($postId);        
 
        if($post->post_parent === 0) {
            
            return null;
        }        
        
        return get_post($post->post_parent);        
    }
    
    public static function getPostParentTerm(int $postId, string $taxonomy = 'category'): ?\WP_Term {
        
        $post = get_post($postId);                
        
        $terms = [];

        while((PHP::count($terms) === 0) && $post !== null) {
        
            $tmp = get_the_terms($post->ID, $taxonomy);
            
            if(!is_wp_error($tmp) && $tmp !== false) {
                
                $terms = $tmp;
            }

            $post = static::getPostParentPost($post->ID);
        }
        
        // There are no terms ... ABORT!
        
        if((PHP::isCountable($terms) && count($terms) === 0) || !PHP::isCountable($terms)) {
            
            return null;
        }        
        
        // There is exactly one term, so this is easy
        
        if(PHP::count($terms) === 1) {
            
            return $terms[0];
        }
        
        // It gets more complicated... there are multiple terms to choose from; so we have to add criteria where we can
        
        $uri = PHP::getServerRequestUri();
        
        if($uri !== null) {                        
            
            $uriElements = explode('/', $uri);
            
            foreach($uriElements as $uriElement) {
                
                if(strlen(trim($uriElement)) !== 0) {
                
                    foreach($terms as $term) {
                  
                        if(strtolower($uriElement) == strtolower($term->slug)) {
                            
                            return $term;
                        }
                    }
                }
            } 
        }
        
        // Argh, we'll just prioritise and return the first one
        
        return $terms[0];
    }
        
    
    public static function getPostParents(int $postId): array {        
     
        $terms = [];
        $term = static::getPostParentTerm($postId); 
        
        while($term !== null) {
        
            $terms[] = $term;
            
            $term = static::getTermParent($term->term_id);                        
        }         
        
 //       $terms = array_reverse($terms);
        
        $posts = [];
        $post = static::getPostParentPost($postId);
        
        while($post !== null) {
            
            $posts[] = $post;
            $post = static::getPostParentPost($post->ID);
        }
        
 //       $posts = array_reverse($posts);
        
        return array_merge($terms, $posts);
    }

}
