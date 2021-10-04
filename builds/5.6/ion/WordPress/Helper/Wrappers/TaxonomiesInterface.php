<?php
namespace ion\WordPress\Helper\Wrappers;

use ion\WordPress\Helper\Wrappers\WP_Term;
use ion\WordPress\Helper\WordPressTaxonomyInterface;
/**
 * Description of TaxonomiesTrait*
 * @author Justus
 */
interface TaxonomiesInterface
{
    /**
     * method
     * 
     * 
     * @return WordPressTaxonomyInterface
     */
    static function addTaxonomy($slug, $pluralLabel, $singularLabel, array $postTypes = null, $description = null, $registerMetaBox = true, callable $metaBoxCallback = null, $hierarchical = null, $sort = null, array $labels = null, $public = null, $publiclyQueryable = null, $showUi = null, $showInNavMenus = null, $showInMenu = null, $showTagcloud = null, $showInQuickEdit = null, $showAdminColumn = null, array $capabilities = null, $rewrite = null, $rewriteSlug = null, $rewriteWithFront = null, $rewriteHierarchical = null, $rewriteEndPointMask = null, $enableQueryVar = null, $queryVar = null, $showInRest = null, $restBase = null, $restControllerClass = null, callable $updateCountCallback = null);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addPostTypesToTaxonomy($taxonomy, array $postTypes);
    /**
     * method
     * 
     * 
     * @return ?string
     */
    static function getTaxonomyFromTerm($termSlug);
    /**
     * method
     * 
     * 
     * @return ?WP_Term
     */
    static function getTermParent($termId);
    /**
     * method
     * 
     * 
     * @return array
     */
    static function getTermParents($termId);
    /**
     * method
     * 
     * 
     * @return array
     */
    static function getTerms(array $taxonomies, $hierarchy = true, $parent = null, $hideEmpty = false);
}