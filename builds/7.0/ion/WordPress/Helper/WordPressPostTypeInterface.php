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
    function getSlug() : string;
    /**
     * method
     * 
     * 
     * @return string
     */
    function setPluralLabel(string $pluralLabel) : string;
    /**
     * method
     * 
     * @return string
     */
    function getPluralLabel() : string;
    /**
     * method
     * 
     * 
     * @return WordPressPostTypeInterface
     */
    function pluralLabel(string $pluralLabel) : WordPressPostTypeInterface;
    /**
     * method
     * 
     * 
     * @return array
     */
    function setLabels(array $labels) : array;
    /**
     * method
     * 
     * @return array
     */
    function getLabels() : array;
    /**
     * method
     * 
     * 
     * @return ?string
     */
    function setDescription(string $description = null);
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
    function setPublic(bool $public) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getPublic() : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setExcludeFromSearch(bool $excludeFromSearch) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getExcludeFromSearch() : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setPubliclyQueryable(bool $publiclyQueryable) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getPubliclyQueryable() : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setShowUi(bool $showUi = null) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getShowUi() : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setShowInNavMenus(bool $showInNavMenus) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getShowInNavMenus() : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setShowInMenu(bool $showInMenu) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getShowInMenu() : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setShowInAdminBar(bool $showInAdminBar) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getShowInAdminBar() : bool;
    /**
     * method
     * 
     * 
     * @return ?int
     */
    function setMenuPosition(int $menuPosition = null);
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
    function setMenuIcon(string $menuIcon = null);
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
    function setSingleCapabilityType(string $singleCapabilityType = null);
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
    function setPluralCapabilityType(string $pluralCapabilityType = null);
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
    function setCapabilities(array $capabilities) : array;
    /**
     * method
     * 
     * @return array
     */
    function getCapabilities() : array;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setMapMetaCap(bool $mapMetaCap) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getMapMetaCap() : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setHierarchical(bool $hierarchical) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getHierarchical() : bool;
    /**
     * method
     * 
     * 
     * @return array
     */
    function setSupports(array $supports) : array;
    /**
     * method
     * 
     * @return array
     */
    function getSupports() : array;
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
    function setTaxonomies(array $taxonomies) : array;
    /**
     * method
     * 
     * @return array
     */
    function getTaxonomies() : array;
    /**
     * method
     * 
     * 
     * @return WordPressPostTypeInterface
     */
    function addTaxonomy(string $taxonomy) : WordPressPostTypeInterface;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setHasArchive(bool $hasArchive) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getHasArchive() : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setRewrite(bool $rewrite) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getRewrite() : bool;
    /**
     * method
     * 
     * 
     * @return string
     */
    function setRewriteSlug(string $rewriteSlug) : string;
    /**
     * method
     * 
     * @return string
     */
    function getRewriteSlug() : string;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setRewriteWithFront(bool $rewriteWithFront) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getRewriteWithFront() : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setRewriteFeeds(bool $rewriteFeeds) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getRewriteFeeds() : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setRewritePages(bool $rewritePages) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getRewritePages() : bool;
    /**
     * method
     * 
     * 
     * @return ?string
     */
    function setRewriteEndPointMask(string $rewriteEndPointMask = null);
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
    function setEnableQueryVar(bool $enableQueryVar) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getEnableQueryVar() : bool;
    /**
     * method
     * 
     * 
     * @return ?string
     */
    function setQueryVar(string $queryVar = null);
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
    function setCanExport(bool $canExport) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getCanExport() : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setDeleteWithUser(bool $deleteWithUser) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getDeleteWithUser() : bool;
    /**
     * method
     * 
     * 
     * @return bool
     */
    function setShowInRest(bool $showInRest) : bool;
    /**
     * method
     * 
     * @return bool
     */
    function getShowInRest() : bool;
    /**
     * method
     * 
     * 
     * @return string
     */
    function setRestBase(string $restBase) : string;
    /**
     * method
     * 
     * @return string
     */
    function getRestBase() : string;
    /**
     * method
     * 
     * 
     * @return string
     */
    function setRestControllerClass(string $restControllerClass) : string;
    /**
     * method
     * 
     * @return string
     */
    function getRestControllerClass() : string;
}