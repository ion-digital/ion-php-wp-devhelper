<?php
namespace ion\WordPress\Helper;

/**
 * Description of WordPressPostType
 *
 * @author Justus
 */
interface WordPressPostTypeInterface
{
    /**
     * method
     * 
     * @return string
     */
    function getSlug();
    /**
     * method
     * 
     * 
     * @return string
     */
    function setPluralLabel($pluralLabel);
    /**
     * method
     * 
     * @return string
     */
    function getPluralLabel();
    /**
     * method
     * 
     * 
     * @return WordPressPostTypeInterface
     */
    function pluralLabel($pluralLabel);
    /**
     * method
     * 
     * 
     * @return array
     */
    function setLabels(array $labels);
    /**
     * method
     * 
     * @return array
     */
    function getLabels();
    /**
     * method
     * 
     * 
     * @return ?string
     */
    function setDescription($description = null);
    /**
     * method
     * 
     * @return ?string
     */
    function getDescription();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setPublic($public);
    /**
     * method
     * 
     * @return bool
     */
    function getPublic();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setExcludeFromSearch($excludeFromSearch);
    /**
     * method
     * 
     * @return bool
     */
    function getExcludeFromSearch();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setPubliclyQueryable($publiclyQueryable);
    /**
     * method
     * 
     * @return bool
     */
    function getPubliclyQueryable();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setShowUi($showUi = null);
    /**
     * method
     * 
     * @return bool
     */
    function getShowUi();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setShowInNavMenus($showInNavMenus);
    /**
     * method
     * 
     * @return bool
     */
    function getShowInNavMenus();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setShowInMenu($showInMenu);
    /**
     * method
     * 
     * @return bool
     */
    function getShowInMenu();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setShowInAdminBar($showInAdminBar);
    /**
     * method
     * 
     * @return bool
     */
    function getShowInAdminBar();
    /**
     * method
     * 
     * 
     * @return ?int
     */
    function setMenuPosition($menuPosition = null);
    /**
     * method
     * 
     * @return ?int
     */
    function getMenuPosition();
    /**
     * method
     * 
     * 
     * @return ?string
     */
    function setMenuIcon($menuIcon = null);
    /**
     * method
     * 
     * @return ?string
     */
    function getMenuIcon();
    /**
     * method
     * 
     * 
     * @return ?string
     */
    function setSingleCapabilityType($singleCapabilityType = null);
    /**
     * method
     * 
     * @return ?string
     */
    function getSingleCapabilityType();
    /**
     * method
     * 
     * 
     * @return ?string
     */
    function setPluralCapabilityType($pluralCapabilityType = null);
    /**
     * method
     * 
     * @return ?string
     */
    function getPluralCapabilityType();
    /**
     * method
     * 
     * 
     * @return array
     */
    function setCapabilities(array $capabilities);
    /**
     * method
     * 
     * @return array
     */
    function getCapabilities();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setMapMetaCap($mapMetaCap);
    /**
     * method
     * 
     * @return bool
     */
    function getMapMetaCap();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setHierarchical($hierarchical);
    /**
     * method
     * 
     * @return bool
     */
    function getHierarchical();
    /**
     * method
     * 
     * 
     * @return array
     */
    function setSupports(array $supports);
    /**
     * method
     * 
     * @return array
     */
    function getSupports();
    /**
     * method
     * 
     * 
     * @return ?callable
     */
    function setRegisterMetaBox(callable $registerMetaBox = null);
    /**
     * method
     * 
     * @return ?callable
     */
    function getRegisterMetaBox();
    /**
     * method
     * 
     * 
     * @return array
     */
    function setTaxonomies(array $taxonomies);
    /**
     * method
     * 
     * @return array
     */
    function getTaxonomies();
    /**
     * method
     * 
     * 
     * @return WordPressPostTypeInterface
     */
    function addTaxonomy($taxonomy);
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setHasArchive($hasArchive);
    /**
     * method
     * 
     * @return bool
     */
    function getHasArchive();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setRewrite($rewrite);
    /**
     * method
     * 
     * @return bool
     */
    function getRewrite();
    /**
     * method
     * 
     * 
     * @return string
     */
    function setRewriteSlug($rewriteSlug);
    /**
     * method
     * 
     * @return string
     */
    function getRewriteSlug();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setRewriteWithFront($rewriteWithFront);
    /**
     * method
     * 
     * @return bool
     */
    function getRewriteWithFront();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setRewriteFeeds($rewriteFeeds);
    /**
     * method
     * 
     * @return bool
     */
    function getRewriteFeeds();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setRewritePages($rewritePages);
    /**
     * method
     * 
     * @return bool
     */
    function getRewritePages();
    /**
     * method
     * 
     * 
     * @return ?string
     */
    function setRewriteEndPointMask($rewriteEndPointMask = null);
    /**
     * method
     * 
     * @return ?string
     */
    function getRewriteEndPointMask();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setEnableQueryVar($enableQueryVar);
    /**
     * method
     * 
     * @return bool
     */
    function getEnableQueryVar();
    /**
     * method
     * 
     * 
     * @return ?string
     */
    function setQueryVar($queryVar = null);
    /**
     * method
     * 
     * @return ?string
     */
    function getQueryVar();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setCanExport($canExport);
    /**
     * method
     * 
     * @return bool
     */
    function getCanExport();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setDeleteWithUser($deleteWithUser);
    /**
     * method
     * 
     * @return bool
     */
    function getDeleteWithUser();
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setShowInRest($showInRest);
    /**
     * method
     * 
     * @return bool
     */
    function getShowInRest();
    /**
     * method
     * 
     * 
     * @return string
     */
    function setRestBase($restBase);
    /**
     * method
     * 
     * @return string
     */
    function getRestBase();
    /**
     * method
     * 
     * 
     * @return string
     */
    function setRestControllerClass($restControllerClass);
    /**
     * method
     * 
     * @return string
     */
    function getRestControllerClass();
}