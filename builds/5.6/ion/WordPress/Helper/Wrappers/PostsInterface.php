<?php
namespace ion\WordPress\Helper\Wrappers;

use WP_Post;
use WP_Term;
/**
 * Description of PostsTrait*
 * @author Justus
 */
interface PostsInterface
{
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addCustomPostType($slug, $pluralLabel, $singularLabel, $description = null, $menuIcon = null, array $supports = null, array $taxonomies = null, callable $registerMetaBox = null, $hierarchical = null, $hasArchive = null, $archiveSlug = null, array $labels = null, $public = null, $excludeFromSearch = null, $publiclyQueryable = null, $showUi = null, $showInNavMenus = null, $showInMenu = null, $showInAdminBar = null, $menuPosition = null, $singleCapabilityType = null, $pluralCapabilityType = null, array $capabilities = null, $mapMetaCap = null, $rewrite = null, $rewriteSlug = null, $rewriteWithFront = null, $rewriteFeeds = null, $rewritePages = null, $rewriteEndPointMask = null, $enableQueryVar = null, $queryVar = null, $canExport = null, $deleteWithUser = null, $showInRest = null, $restBase = null, $restControllerClass = null);
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function postExists($slug, $postType = "post");
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function pageExists($slug);
    /**
     * method
     * 
     * 
     * @return array
     */
    static function getChildren($depth = null, $template = null, $echo = true);
    /**
     * method
     * 
     * 
     * @return ?WP_Post
     */
    static function getPostParentPost($postId);
    /**
     * method
     * 
     * 
     * @return ?WP_Term
     */
    static function getPostParentTerm($postId, $taxonomy = "category");
    /**
     * method
     * 
     * 
     * @return array
     */
    static function getPostParents($postId);
}