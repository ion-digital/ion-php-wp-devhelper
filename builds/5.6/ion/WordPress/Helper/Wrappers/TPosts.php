<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

use \Exception as Throwable;
use WP_Post;
use WP_Term;
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
use ion\WordPress\Helper\IWordPressPostType;
use ion\WordPress\Helper\WordPressPostType;
use ion\WordPress\Helper\Wrappers\OptionMetaType;
/**
 * Description of TPosts
 *
 * @author Justus
 */
trait TPosts
{
    private static $customPostTypes = [];
    /**
     * method
     * 
     * @return mixed
     */
    
    protected static function initialize_TPosts()
    {
        static::registerWrapperAction('init', function () {
            foreach (static::$customPostTypes as $postTypeSlug => $taxonomy) {
                $args = ['label' => $taxonomy['pluralLabel'], 'labels' => $taxonomy['labels'], 'description' => $taxonomy['description'], 'public' => $taxonomy['public'] === null ? true : $taxonomy['public'], 'exclude_from_search' => $taxonomy['excludeFromSearch'] === null ? false : $taxonomy['excludeFromSearch'], 'publicly_queryable' => $taxonomy['publiclyQueryable'] === null ? false : $taxonomy['publiclyQueryable'], 'show_ui' => $taxonomy['showUi'] === null ? true : $taxonomy['showUi'], 'show_in_nav_menus' => $taxonomy['showInNavMenus'] === null ? true : $taxonomy['showInNavMenus'], 'show_in_menu' => $taxonomy['showInMenu'] === null ? true : $taxonomy['showInMenu'], 'show_in_admin_bar' => $taxonomy['showInAdminBar'] ? false : $taxonomy['showInAdminBar'], 'menu_position' => $taxonomy['menuPosition'] === null ? 25 : $taxonomy['menuPosition'], 'menu_icon' => $taxonomy['menuIcon'], 'capability_type' => PHP::isEmpty($taxonomy['singleCapabilityType']) ? (array) ['post', 'posts'] : (PHP::isEmpty($taxonomy['pluralCapabilityType']) ? $taxonomy['singleCapabilityType'] : (array) [$taxonomy['singleCapabilityType'], $taxonomy['pluralCapabilityType']]), 'capabilities' => $taxonomy['capabilities'] === null ? null : $taxonomy['capabilities'], 'map_meta_cap' => PHP::isEmpty($taxonomy['mapMetaCap']) ? true : $taxonomy['mapMetaCap'], 'hierarchical' => $taxonomy['hierarchical'] === null ? false : $taxonomy['hierarchical'], 'supports' => $taxonomy['supports'] === null ? null : (count($taxonomy['supports']) > 0 ? (array) $taxonomy['supports'] : false), 'register_meta_box_cb' => $taxonomy['registerMetaBox'], 'taxonomies' => $taxonomy['taxonomies'] === null ? [] : $taxonomy['taxonomies'], 'has_archive' => PHP::isEmpty($taxonomy['hasArchive']) ? false : (PHP::isEmpty($taxonomy['archiveSlug']) ? (bool) $taxonomy['hasArchive'] : (string) $taxonomy['archiveSlug']), 'rewrite' => PHP::isEmpty($taxonomy['rewrite']) ? null : ['slug' => $taxonomy['rewriteSlug'], 'with_front' => $taxonomy['rewriteWithFront'], 'feeds' => $taxonomy['rewriteFeeds'], 'pages' => $taxonomy['rewritePages'], 'ep_mask' => $taxonomy['rewriteEndPointMask']], 'query_var' => PHP::isEmpty((bool) $taxonomy['enableQueryVar']) ? false : (string) $taxonomy['queryVar'], 'can_export' => $taxonomy['canExport'], 'delete_with_user' => $taxonomy['deleteWithUser'] === null ? false : $taxonomy['deleteWithUser'], 'show_in_rest' => $taxonomy['showInRest'] === null ? true : $taxonomy['showInRest'], 'rest_base' => $taxonomy['restBase'], 'rest_controller_class' => $taxonomy['restControllerClass']];
                // Remove all NULL values from the array to enforce defaults on WordPress' side
                $args = array_filter($args, function ($value) {
                    return $value !== null;
                });
                register_post_type($postTypeSlug, $args);
            }
        });
    }
    
    /**
     * method
     * 
     * 
     * @return IWordPressPostType
     */
    
    public static function addCustomPostType($slug, $pluralLabel, $singularLabel, $description = null, $menuIcon = null, array $supports = null, array $taxonomies = null, callable $registerMetaBox = null, $hierarchical = null, $hasArchive = null, $archiveSlug = null, array $labels = null, $public = null, $excludeFromSearch = null, $publiclyQueryable = null, $showUi = null, $showInNavMenus = null, $showInMenu = null, $showInAdminBar = null, $menuPosition = null, $singleCapabilityType = null, $pluralCapabilityType = null, array $capabilities = null, $mapMetaCap = null, $rewrite = null, $rewriteSlug = null, $rewriteWithFront = null, $rewriteFeeds = null, $rewritePages = null, $rewriteEndPointMask = null, $enableQueryVar = null, $queryVar = null, $canExport = null, $deleteWithUser = null, $showInRest = null, $restBase = null, $restControllerClass = null)
    {
        if ($labels === null) {
            if ($pluralLabel === null) {
                $pluralLabel = 'Custom Posts';
            }
            if ($singularLabel === null) {
                $singularLabel = 'Custom Post';
            }
            $labels = ['name' => $pluralLabel, 'singular_name' => $singularLabel, 'add_new' => _x('Add New', $slug), 'add_new_item' => "Add New {$singularLabel}", 'edit_item' => "Edit {$singularLabel}", 'new_item' => "New {$singularLabel}", 'view_item' => "View {$singularLabel}", 'view_items' => "View {$pluralLabel}", 'search_items' => "Search {$pluralLabel}", 'not_found' => "No {$pluralLabel} found.", 'not_found_in_trash' => "No {$pluralLabel} found in Trash", 'parent_item_colon' => "Parent {$singularLabel}", 'all_items' => "All {$pluralLabel}", 'archives' => "{$singularLabel} Archives", 'attributes' => "{$singularLabel} Attributes", 'insert_into_item' => "Insert into {$singularLabel}", 'uploaded_to_this_item' => "Uploaded to this {$singularLabel}", 'featured_image' => "Image", 'set_featured_image' => "Set Image", 'remove_featured_image' => "Remove Image", 'use_featured_image' => "Use as image", 'menu_name' => $pluralLabel];
        } else {
            if (!$labels->hasKey('name')) {
                $labels->set('name', $pluralLabel);
            }
            if (!$labels->hasKey('singular_name')) {
                $labels->set('singular_name', $singularLabel);
            }
        }
        static::$customPostTypes[$slug] = ['slug' => $slug, 'pluralLabel' => $pluralLabel, 'labels' => $labels, 'description' => $description, 'public' => $public, 'excludeFromSearch' => $excludeFromSearch, 'publiclyQueryable' => $publiclyQueryable, 'showUi' => $showUi, 'showInNavMenus' => $showInNavMenus, 'showInMenu' => $showInMenu, 'showInAdminBar' => $showInAdminBar, 'menuPosition' => $menuPosition, 'menuIcon' => $menuIcon, 'singleCapabilityType' => $singleCapabilityType, 'pluralCapabilityType' => $pluralCapabilityType, 'capabilities' => $capabilities === null ? null : $capabilities, 'mapMetaCap' => $mapMetaCap, 'hierarchical' => $hierarchical, 'supports' => $supports === null ? null : $supports, 'registerMetaBox' => $registerMetaBox, 'taxonomies' => $taxonomies === null ? null : $taxonomies, 'hasArchive' => $hasArchive, 'archiveSlug' => $archiveSlug, 'rewrite' => $rewrite, 'rewriteSlug' => $rewriteSlug, 'rewriteWithFront' => $rewriteWithFront, 'rewriteFeeds' => $rewriteFeeds, 'rewritePages' => $rewritePages, 'rewriteEndPointMask' => $rewriteEndPointMask, 'enableQueryVar' => $enableQueryVar, 'queryVar' => $queryVar, 'canExport' => $canExport, 'deleteWithUser' => $deleteWithUser, 'showInRest' => $showInRest, 'restBase' => $restBase, 'restControllerClass' => $restControllerClass];
        return new WordPressPostType($slug, static::$customPostTypes[$slug]);
    }
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    public static function postExists($slug, $postType = "post")
    {
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
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    public static function pageExists($slug)
    {
        return static::postExists($slug, 'page');
    }
    
    //FIXME: Method not complete!!!
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function getChildren($depth = null, $template = null, $echo = true)
    {
        $result = [];
        $output = "";
        $objId = null;
        $post = get_post();
        if (!empty($post)) {
            $objId = $post->ID;
        } else {
            $objId = get_queried_object_id();
        }
        if ($objId !== null) {
            //TODO: Expand to beyond pages
            $children = get_children(['post_parent' => $objId, 'post_type' => 'page', 'numberposts' => -1, 'post_status' => 'publish']);
            foreach ($children as $child) {
                $result[] = ['title' => $child->post_title, 'url' => get_permalink($child->ID)];
            }
            //print_r($children);
        }
        if ($echo === true) {
            echo $output;
        }
        return $result;
    }
    
    //TODO
    /**
     * method
     * 
     * 
     * @return ?WP_Post
     */
    
    public static function getPostParentPost($postId)
    {
        $post = get_post($postId);
        //        if(is_post_type_hierarchical($post->post_type)) {
        //
        //
        //        }
        if ($post->post_parent === 0) {
            return null;
        }
        return get_post($post->post_parent);
    }
    
    /**
     * method
     * 
     * 
     * @return ?WP_Term
     */
    
    public static function getPostParentTerm($postId, $taxonomy = 'category')
    {
        $post = get_post($postId);
        $terms = [];
        while (PHP::isCountable($terms) && count($terms) === 0 && $post !== null) {
            $tmp = get_the_terms($post->ID, $taxonomy);
            if (!is_wp_error($tmp) && $tmp !== false) {
                $terms = $tmp;
            }
            $post = static::getPostParentPost($post->ID);
        }
        // There are no terms ... ABORT!
        if (PHP::isCountable($terms) && count($terms) === 0 || !PHP::isCountable($terms)) {
            return null;
        }
        // There is exactly one term, so this is easy
        if (PHP::isCountable($terms) && count($terms) === 1) {
            return $terms[0];
        }
        // It gets more complicated... there are multiple terms to choose from; so we have to add criteria where we can
        $uri = PHP::getServerRequestUri();
        //        if(!is_array($terms))
        //        var_dump($terms);
        if ($uri !== null) {
            $uriElements = explode('/', $uri);
            foreach ($uriElements as $uriElement) {
                if (strlen(trim($uriElement)) !== 0) {
                    foreach ($terms as $term) {
                        if (strtolower($uriElement) == strtolower($term->slug)) {
                            return $term;
                        }
                    }
                }
            }
        }
        return $terms[0];
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function getPostParents($postId)
    {
        $terms = [];
        $term = static::getPostParentTerm($postId);
        while ($term !== null) {
            $terms[] = $term;
            $term = static::getTermParent($term->term_id);
        }
        //       $terms = array_reverse($terms);
        $posts = [];
        $post = static::getPostParentPost($postId);
        while ($post !== null) {
            $posts[] = $post;
            $post = static::getPostParentPost($post->ID);
        }
        //       $posts = array_reverse($posts);
        return array_merge($terms, $posts);
    }

}