<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 * Description of WordPressPostType
 *
 * @author Justus
 */
class WordPressPostType implements WordPressPostTypeInterface
{
    private $slug;
    //    private $pluralItemName;
    //    private $singleItemName;
    //    private $labels;
    //    private $description;
    //    private $public;
    //    private $excludeFromSearch;
    //    private $publiclyQueryable;
    //    private $showUi;
    //    private $showInNavMenus;
    //    private $showInMenu;
    //    private $showInAdminBar;
    //    private $menuPosition;
    //    private $menuIcon;
    //    private $singleCapabilityType;
    //    private $pluralCapabilityType;
    //    private $capabilities;
    //    private $mapMetaCap;
    //    private $hierarchical;
    //    private $supports;
    //    private $registerMetaBox;
    //    private $taxonomies;
    //    private $hasArchive;
    //    private $rewrite;
    //    private $rewriteSlug;
    //    private $rewriteWithFront;
    //    private $rewriteFeeds;
    //    private $rewritePages;
    //    private $rewriteEndPointMask;
    //    private $enableQueryVar;
    //    private $queryVar;
    //    private $canExport;
    //    private $deleteWithUser;
    //    private $showInRest;
    //    private $restBase;
    //    private $restControllerClass;
    private $parent;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function __construct(string $slug, array &$parent)
    {
        $this->parent =& $parent;
        $this->slug = $slug;
    }
    //    public function setSlug(string $slug): string {
    //        $this->slug = $slug;
    //        return $this->slug;
    //    }
    /**
     * method
     * 
     * @return string
     */
    public function getSlug() : string
    {
        return $this->slug;
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public function setPluralLabel(string $pluralLabel) : string
    {
        $this->parent['pluralLabel'] = $pluralLabel;
        return $this->pluralItemName;
    }
    /**
     * method
     * 
     * @return string
     */
    public function getPluralLabel() : string
    {
        return $this->parent['pluralLabel'];
    }
    /**
     * method
     * 
     * 
     * @return WordPressPostTypeInterface
     */
    public function pluralLabel(string $pluralLabel) : WordPressPostTypeInterface
    {
        $this->setPluralLabel($pluralLabel);
        return $this;
    }
    /**
     * method
     * 
     * 
     * @return array
     */
    public function setLabels(array $labels) : array
    {
        $this->labels = $labels;
        return $this->labels;
    }
    /**
     * method
     * 
     * @return array
     */
    public function getLabels() : array
    {
        return $this->labels;
    }
    /**
     * method
     * 
     * 
     * @return ?string
     */
    public function setDescription(string $description = null) : ?string
    {
        $this->description = $description;
        return $this->description;
    }
    /**
     * method
     * 
     * @return ?string
     */
    public function getDescription() : ?string
    {
        return $this->description;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setPublic(bool $public) : bool
    {
        $this->public = $public;
        return $this->public;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getPublic() : bool
    {
        return $this->public;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setExcludeFromSearch(bool $excludeFromSearch) : bool
    {
        $this->excludeFromSearch = $excludeFromSearch;
        return $this->excludeFromSearch;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getExcludeFromSearch() : bool
    {
        return $this->excludeFromSearch;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setPubliclyQueryable(bool $publiclyQueryable) : bool
    {
        $this->publiclyQueryable = $publiclyQueryable;
        return $this->publiclyQueryable;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getPubliclyQueryable() : bool
    {
        return $this->publiclyQueryable;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setShowUi(bool $showUi = null) : bool
    {
        $this->showUi = $showUi;
        return $this->showUi;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getShowUi() : bool
    {
        return $this->showUi;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setShowInNavMenus(bool $showInNavMenus) : bool
    {
        $this->showInNavMenus = $showInNavMenus;
        return $this->showInNavMenus;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getShowInNavMenus() : bool
    {
        return $this->showInNavMenus;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setShowInMenu(bool $showInMenu) : bool
    {
        $this->showInMenu = $showInMenu;
        return $this->showInMenu;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getShowInMenu() : bool
    {
        return $this->showInMenu;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setShowInAdminBar(bool $showInAdminBar) : bool
    {
        $this->showInAdminBar = $showInAdminBar;
        return $this->showInAdminBar;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getShowInAdminBar() : bool
    {
        return $this->showInAdminBar;
    }
    /**
     * method
     * 
     * 
     * @return ?int
     */
    public function setMenuPosition(int $menuPosition = null) : ?int
    {
        $this->menuPosition = $menuPosition;
        return $this->menuPosition;
    }
    /**
     * method
     * 
     * @return ?int
     */
    public function getMenuPosition() : ?int
    {
        return $this->menuPosition;
    }
    /**
     * method
     * 
     * 
     * @return ?string
     */
    public function setMenuIcon(string $menuIcon = null) : ?string
    {
        $this->menuIcon = $menuIcon;
        return $this->menuIcon;
    }
    /**
     * method
     * 
     * @return ?string
     */
    public function getMenuIcon() : ?string
    {
        return $this->menuIcon;
    }
    /**
     * method
     * 
     * 
     * @return ?string
     */
    public function setSingleCapabilityType(string $singleCapabilityType = null) : ?string
    {
        $this->singleCapabilityType = $singleCapabilityType;
        return $this->singleCapabilityType;
    }
    /**
     * method
     * 
     * @return ?string
     */
    public function getSingleCapabilityType() : ?string
    {
        return $this->singleCapabilityType;
    }
    /**
     * method
     * 
     * 
     * @return ?string
     */
    public function setPluralCapabilityType(string $pluralCapabilityType = null) : ?string
    {
        $this->pluralCapabilityType = $pluralCapabilityType;
        return $this->pluralCapabilityType;
    }
    /**
     * method
     * 
     * @return ?string
     */
    public function getPluralCapabilityType() : ?string
    {
        return $this->pluralCapabilityType;
    }
    /**
     * method
     * 
     * 
     * @return array
     */
    public function setCapabilities(array $capabilities) : array
    {
        $this->capabilities = $capabilities;
        return $this->capabilities;
    }
    /**
     * method
     * 
     * @return array
     */
    public function getCapabilities() : array
    {
        return $this->capabilities;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setMapMetaCap(bool $mapMetaCap) : bool
    {
        $this->mapMetaCap = $mapMetaCap;
        return $this->mapMetaCap;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getMapMetaCap() : bool
    {
        return $this->mapMetaCap;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setHierarchical(bool $hierarchical) : bool
    {
        $this->hierarchical = $hierarchical;
        return $this->hierarchical;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getHierarchical() : bool
    {
        return $this->hierarchical;
    }
    /**
     * method
     * 
     * 
     * @return array
     */
    public function setSupports(array $supports) : array
    {
        $this->supports = $supports;
        return $this->supports;
    }
    /**
     * method
     * 
     * @return array
     */
    public function getSupports() : array
    {
        return $this->supports;
    }
    /**
     * method
     * 
     * 
     * @return ?callable
     */
    public function setRegisterMetaBox(callable $registerMetaBox = null) : ?callable
    {
        $this->registerMetaBox = $registerMetaBox;
        return $this->registerMetaBox;
    }
    /**
     * method
     * 
     * @return ?callable
     */
    public function getRegisterMetaBox() : ?callable
    {
        return $this->registerMetaBox;
    }
    // taxonomies
    /**
     * method
     * 
     * 
     * @return array
     */
    public function setTaxonomies(array $taxonomies) : array
    {
        $this->parent['taxonomies'] = $taxonomies;
        return $this->taxonomies;
    }
    /**
     * method
     * 
     * @return array
     */
    public function getTaxonomies() : array
    {
        return $this->parent['taxonomies'];
    }
    /**
     * method
     * 
     * 
     * @return WordPressPostTypeInterface
     */
    public function addTaxonomy(string $taxonomy) : WordPressPostTypeInterface
    {
        $this->parent['taxonomies'][] = $taxonomy;
        return $this;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setHasArchive(bool $hasArchive) : bool
    {
        $this->hasArchive = $hasArchive;
        return $this->hasArchive;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getHasArchive() : bool
    {
        return $this->hasArchive;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setRewrite(bool $rewrite) : bool
    {
        $this->rewrite = $rewrite;
        return $this->rewrite;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getRewrite() : bool
    {
        return $this->rewrite;
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public function setRewriteSlug(string $rewriteSlug) : string
    {
        $this->rewriteSlug = $rewriteSlug;
        return $this->rewriteSlug;
    }
    /**
     * method
     * 
     * @return string
     */
    public function getRewriteSlug() : string
    {
        return $this->rewriteSlug;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setRewriteWithFront(bool $rewriteWithFront) : bool
    {
        $this->rewriteWithFront = $rewriteWithFront;
        return $this->rewriteWithFront;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getRewriteWithFront() : bool
    {
        return $this->rewriteWithFront;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setRewriteFeeds(bool $rewriteFeeds) : bool
    {
        $this->rewriteFeeds = $rewriteFeeds;
        return $this->rewriteFeeds;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getRewriteFeeds() : bool
    {
        return $this->rewriteFeeds;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setRewritePages(bool $rewritePages) : bool
    {
        $this->rewritePages = $rewritePages;
        return $this->rewritePages;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getRewritePages() : bool
    {
        return $this->rewritePages;
    }
    /**
     * method
     * 
     * 
     * @return ?string
     */
    public function setRewriteEndPointMask(string $rewriteEndPointMask = null) : ?string
    {
        $this->rewriteEndPointMask = $rewriteEndPointMask;
        return $this->rewriteEndPointMask;
    }
    /**
     * method
     * 
     * @return ?string
     */
    public function getRewriteEndPointMask() : ?string
    {
        return $this->rewriteEndPointMask;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setEnableQueryVar(bool $enableQueryVar) : bool
    {
        $this->enableQueryVar = $enableQueryVar;
        return $this->enableQueryVar;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getEnableQueryVar() : bool
    {
        return $this->enableQueryVar;
    }
    /**
     * method
     * 
     * 
     * @return ?string
     */
    public function setQueryVar(string $queryVar = null) : ?string
    {
        $this->queryVar = $queryVar;
        return $this->queryVar;
    }
    /**
     * method
     * 
     * @return ?string
     */
    public function getQueryVar() : ?string
    {
        return $this->queryVar;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setCanExport(bool $canExport) : bool
    {
        $this->canExport = $canExport;
        return $this->canExport;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getCanExport() : bool
    {
        return $this->canExport;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setDeleteWithUser(bool $deleteWithUser) : bool
    {
        $this->deleteWithUser = $deleteWithUser;
        return $this->deleteWithUser;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getDeleteWithUser() : bool
    {
        return $this->deleteWithUser;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setShowInRest(bool $showInRest) : bool
    {
        $this->showInRest = $showInRest;
        return $this->showInRest;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getShowInRest() : bool
    {
        return $this->showInRest;
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public function setRestBase(string $restBase) : string
    {
        $this->restBase = $restBase;
        return $this->restBase;
    }
    /**
     * method
     * 
     * @return string
     */
    public function getRestBase() : string
    {
        return $this->restBase;
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public function setRestControllerClass(string $restControllerClass) : string
    {
        $this->restControllerClass = $restControllerClass;
        return $this->restControllerClass;
    }
    /**
     * method
     * 
     * @return string
     */
    public function getRestControllerClass() : string
    {
        return $this->restControllerClass;
    }
}