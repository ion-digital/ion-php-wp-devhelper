<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

use \Exception as Throwable;
use WP_Post;
use WP_Error;
use WP_Term;
use ion\WordPress\Helper\WordPressHelperException;
//use \ion\WordPress\Helper\WordPressException;
use ion\WordPress\IWordPressHelper;
use ion\WordPress\Helper\Tools;
use ion\WordPress\Helper\Constants;
use ion\PhpHelper as PHP;
use ion\Package;
use ion\ISemVer;
use ion\SemVer;
use ion\WordPress\Helper\IWordPressTaxonomy;
use ion\WordPress\Helper\WordPressTaxonomy;
use ion\WordPress\Helper\WordPressTerm;
/**
 * Description of TTaxonomies
 *
 * @author Justus
 */
trait TTaxonomies
{
    private static $taxonomies = [];
    private static $taxonomiesToLink = [];
    /**
     * method
     * 
     * @return mixed
     */
    protected static function initialize_TTaxonomies()
    {
        static::registerWrapperAction('init', function () {
            foreach (static::$taxonomies as $taxonomySlug => $taxonomy) {
                $args = ['label' => $taxonomy['pluralLabel'], 'labels' => $taxonomy['labels'], 'public' => $taxonomy['public'] === null ? true : $taxonomy['public'], 'publicly_queryable' => $taxonomy['publiclyQueryable'] === null ? false : $taxonomy['publiclyQueryable'], 'show_ui' => $taxonomy['showUi'] === null ? true : $taxonomy['showUi'], 'show_in_menu' => $taxonomy['showInMenu'] === null ? true : $taxonomy['showInMenu'], 'show_in_nav_menus' => $taxonomy['showInNavMenus'] === null ? true : $taxonomy['showInNavMenus'], 'show_in_rest' => $taxonomy['showInRest'] === null ? true : $taxonomy['showInRest'], 'rest_base' => $taxonomy['restBase'], 'rest_controller_class' => $taxonomy['restControllerClass'], 'show_tagcloud' => $taxonomy['showTagcloud'], 'show_in_quick_edit' => $taxonomy['showInQuickEdit'], 'meta_box_cb' => $taxonomy['registerMetaBox'] === true ? $taxonomy['metaBoxCallback'] : false, 'show_admin_column' => $taxonomy['showAdminColumn'], 'description' => $taxonomy['description'], 'hierarchical' => $taxonomy['hierarchical'] === null ? false : $taxonomy['hierarchical'], 'update_count_callback' => $taxonomy['updateCountCallback'], 'query_var' => PHP::isEmpty((bool) $taxonomy['enableQueryVar']) ? false : (string) $taxonomy['queryVar'], 'rewrite' => PHP::isEmpty($taxonomy['rewrite']) ? null : ['slug' => $taxonomy['rewriteSlug'], 'with_front' => $taxonomy['rewriteWithFront'], 'hierarchical' => $taxonomy['rewriteHierarchical'], 'ep_mask' => $taxonomy['rewriteEndPointMask']], 'capabilities' => $taxonomy['capabilities'] === null ? null : $taxonomy['capabilities'], 'sort' => $taxonomy['sort']];
                // Remove all NULL values from the array to enforce defaults on WordPress' side
                $args = array_filter($args, function ($value) {
                    return $value !== null;
                });
                //echo "<pre>"; var_dump($args); die("</pre>");
                register_taxonomy($taxonomySlug, $taxonomy['postTypes'], $args);
                //echo "<pre>"; var_dump($GLOBALS['wp_post_types']['qualifications']); die("</pre>");
            }
            foreach (static::$taxonomiesToLink as $taxonomySlug => $postTypes) {
                foreach ($postTypes as $postType) {
                    register_taxonomy_for_object_type($taxonomySlug, $postType);
                }
            }
        }, 1);
    }
    /**
     * method
     * 
     * 
     * @return IWordPressTaxonomy
     */
    public static function addTaxonomy($slug, $pluralLabel, $singularLabel, array $postTypes = null, $description = null, $registerMetaBox = true, callable $metaBoxCallback = null, $hierarchical = null, $sort = null, array $labels = null, $public = null, $publiclyQueryable = null, $showUi = null, $showInNavMenus = null, $showInMenu = null, $showTagcloud = null, $showInQuickEdit = null, $showAdminColumn = null, array $capabilities = null, $rewrite = null, $rewriteSlug = null, $rewriteWithFront = null, $rewriteHierarchical = null, $rewriteEndPointMask = null, $enableQueryVar = null, $queryVar = null, $showInRest = null, $restBase = null, $restControllerClass = null, callable $updateCountCallback = null)
    {
        if ($labels === null) {
            if ($pluralLabel === null) {
                $pluralLabel = 'Custom Taxonomies';
            }
            if ($singularLabel === null) {
                $singularLabel = 'Custom Taxonomy';
            }
            $labels = ['name' => $pluralLabel, 'singular_name' => $singularLabel, 'menu_name' => $pluralLabel, 'all_items' => "All {$pluralLabel}", 'edit_item' => "Edit {$singularLabel}", 'view_item' => "View {$singularLabel}", 'update_item' => "Update {$singularLabel}", 'add_new_item' => "Add New {$singularLabel}", 'new_item_name' => "New {$singularLabel} Name", 'parent_item' => "Parent {$singularLabel}", 'parent_item_colon' => "Parent {$singularLabel}:", 'search_items' => "Search {$pluralLabel}", 'popular_items' => "Popular {$pluralLabel}", 'separate_items_with_commas' => __("Separate {$pluralLabel} with commas"), 'add_or_remove_items' => __("Add or remove {$pluralLabel}"), 'choose_from_most_used' => __("Choose from the most used {$pluralLabel}"), 'not_found' => "No {$pluralLabel} found."];
        } else {
            if (!$labels->hasKey('name')) {
                $labels->set('name', $pluralLabel);
            }
            if (!$labels->hasKey('singular_name')) {
                $labels->set('singular_name', $singularLabel);
            }
        }
        static::$taxonomies[$slug] = ['slug' => $slug, 'pluralLabel' => $pluralLabel, 'singularLabel' => $singularLabel, 'postTypes' => $postTypes === null ? null : $postTypes, 'description' => $description, 'registerMetaBox' => $registerMetaBox, 'metaBoxCallback' => $metaBoxCallback, 'hierarchical' => $hierarchical, 'sort' => $sort, 'labels' => $labels, 'public' => $public, 'publiclyQueryable' => $publiclyQueryable, 'showUi' => $showUi, 'showInNavMenus' => $showInNavMenus, 'showInMenu' => $showInMenu, 'showTagcloud' => $showTagcloud, 'showInQuickEdit' => $showInQuickEdit, 'showAdminColumn' => $showAdminColumn, 'capabilities' => $capabilities === null ? null : $capabilities, 'rewrite' => $rewrite, 'rewriteSlug' => $rewriteSlug, 'rewriteWithFront' => $rewriteWithFront, 'rewriteHierarchical' => $rewriteHierarchical, 'rewriteEndPointMask' => $rewriteEndPointMask, 'enableQueryVar' => $enableQueryVar, 'queryVar' => $queryVar, 'showInRest' => $showInRest, 'restBase' => $restBase, 'restControllerClass' => $restControllerClass, 'updateCountCallback' => $updateCountCallback];
        return new WordPressTaxonomy($slug, static::$taxonomies[$slug]);
    }
    /**
     * method
     * 
     * 
     * @return void
     */
    public static function addPostTypesToTaxonomy($taxonomy, array $postTypes)
    {
        foreach ($postTypes as $postType) {
            static::$taxonomiesToLink[$taxonomy][] = $postType;
        }
    }
    /**
     * method
     * 
     * 
     * @return ?string
     */
    public static function getTaxonomyFromTerm($termSlug)
    {
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
    //    private static function getTermsForId(array $taxonomies, int $id, bool $hideEmpty): array {
    //
    //        $result = get_terms([
    //            'taxonomy' => $taxonomies,
    //            'hide_empty' => $hideEmpty
    //        ]);
    //
    //        if($result instanceof WP_Error) {
    //
    //            throw new WordPressException($result);
    //        }
    //
    //    }
    /**
     * method
     * 
     * 
     * @return ?WP_Term
     */
    public static function getTermParent($termId)
    {
        $term = get_term($termId);
        if (is_wp_error($term) || $term === null) {
            return null;
        }
        $parent = get_term($term->parent);
        if (is_wp_error($parent) || $parent === null) {
            return null;
        }
        return $parent;
    }
    /**
     * method
     * 
     * 
     * @return array
     */
    public static function getTermParents($termId)
    {
        $terms = [];
        $term = static::getTermParent($termId);
        while ($term !== null) {
            $terms[] = $term;
            $term = static::getTermParent($term->term_id);
        }
        //       $terms = $terms;
        return $terms;
    }
    /**
     * method
     * 
     * 
     * @return array
     */
    public static function getTerms(array $taxonomies, $hierarchy = true, $parent = null, $hideEmpty = false)
    {
        $result = get_terms(['taxonomy' => $taxonomies, 'hide_empty' => $hideEmpty]);
        if ($result instanceof WP_Error) {
            throw new WordPressHelperException($result->get_error_message());
        }
        if (!PHP::isArray($result)) {
            return [];
        }
        $terms = [];
        foreach ($result as $termObject) {
            if ($termObject->parent === ($parent === null ? 0 : $parent)) {
                $term = null;
                if ($hierarchy) {
                    $term = new WordPressTerm($termObject, static::getTerms($taxonomies, $hierarchy, $termObject->term_id, $hideEmpty));
                } else {
                    $term = new WordPressTerm($termObject, []);
                }
                $terms[] = $term;
            }
        }
        return $terms;
    }
}