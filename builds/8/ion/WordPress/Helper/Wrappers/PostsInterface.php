<?php

namespace ion\WordPress\Helper\Wrappers;

use \WP_Post;
use \WP_Term;


/**
 * Description of PostsTrait*
 * @author Justus
 */
interface PostsInterface {

    static function addCustomPostType(

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

    ): void;

    static function postExists(string $slug, string $postType = "post"): bool;

    static function pageExists(string $slug): bool;

    static function getChildren(bool $depth = null, string $template = null, bool $echo = true): array;

    static function getPostParentPost(int $postId): ?\WP_Post;

    static function getPostParentTerm(int $postId, string $taxonomy = "category"): ?\WP_Term;

    static function getPostParents(int $postId): array;

}
