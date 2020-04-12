<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */
use ion\Types\Arrays\IVector;
use ion\Types\Arrays\IMap;
use ion\WordPress\Helper\IWordPressPostType;
use WP_Term;
use WP_Post;

interface IPosts
{
    static function addCustomPostType(string $slug, string $pluralLabel, string $singularLabel, string $description = null, string $menuIcon = null, IVector $supports = null, IVector $taxonomies = null, callable $registerMetaBox = null, bool $hierarchical = null, bool $hasArchive = null, string $archiveSlug = null, IMap $labels = null, bool $public = null, bool $excludeFromSearch = null, bool $publiclyQueryable = null, bool $showUi = null, bool $showInNavMenus = null, bool $showInMenu = null, bool $showInAdminBar = null, int $menuPosition = null, string $singleCapabilityType = null, string $pluralCapabilityType = null, IMap $capabilities = null, bool $mapMetaCap = null, bool $rewrite = null, string $rewriteSlug = null, bool $rewriteWithFront = null, bool $rewriteFeeds = null, bool $rewritePages = null, string $rewriteEndPointMask = null, bool $enableQueryVar = null, string $queryVar = null, bool $canExport = null, bool $deleteWithUser = null, bool $showInRest = null, string $restBase = null, string $restControllerClass = null) : IWordPressPostType;
    
    static function getPostParentTerm(int $postId, string $taxonomy = 'category') : ?WP_Term;
    
    static function getChildren(bool $depth = null, string $template = null, bool $echo = true) : array;
    
    static function getPostParentPost(int $postId) : ?WP_Post;
    
    static function getPostParents(int $postId) : array;
    
    static function postExists(string $slug, string $postType = "post") : bool;
    
    static function pageExists(string $slug) : bool;

}