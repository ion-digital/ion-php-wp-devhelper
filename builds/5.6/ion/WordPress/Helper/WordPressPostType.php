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
class WordPressPostType implements IWordPressPostType
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
    public function __construct($slug, array &$parent)
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
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public function setPluralLabel($pluralLabel)
    {
        $this->parent['pluralLabel'] = $pluralLabel;
        return $this->pluralItemName;
    }
    /**
     * method
     * 
     * @return string
     */
    public function getPluralLabel()
    {
        return $this->parent['pluralLabel'];
    }
    /**
     * method
     * 
     * 
     * @return IWordPressPostType
     */
    public function pluralLabel($pluralLabel)
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
    public function setLabels(array $labels)
    {
        $this->labels = $labels;
        return $this->labels;
    }
    /**
     * method
     * 
     * @return array
     */
    public function getLabels()
    {
        return $this->labels;
    }
    /**
     * method
     * 
     * 
     * @return ?string
     */
    public function setDescription($description = null)
    {
        $this->description = $description;
        return $this->description;
    }
    /**
     * method
     * 
     * @return ?string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setPublic($public)
    {
        $this->public = $public;
        return $this->public;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getPublic()
    {
        return $this->public;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setExcludeFromSearch($excludeFromSearch)
    {
        $this->excludeFromSearch = $excludeFromSearch;
        return $this->excludeFromSearch;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getExcludeFromSearch()
    {
        return $this->excludeFromSearch;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setPubliclyQueryable($publiclyQueryable)
    {
        $this->publiclyQueryable = $publiclyQueryable;
        return $this->publiclyQueryable;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getPubliclyQueryable()
    {
        return $this->publiclyQueryable;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setShowUi($showUi = null)
    {
        $this->showUi = $showUi;
        return $this->showUi;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getShowUi()
    {
        return $this->showUi;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setShowInNavMenus($showInNavMenus)
    {
        $this->showInNavMenus = $showInNavMenus;
        return $this->showInNavMenus;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getShowInNavMenus()
    {
        return $this->showInNavMenus;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setShowInMenu($showInMenu)
    {
        $this->showInMenu = $showInMenu;
        return $this->showInMenu;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getShowInMenu()
    {
        return $this->showInMenu;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setShowInAdminBar($showInAdminBar)
    {
        $this->showInAdminBar = $showInAdminBar;
        return $this->showInAdminBar;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getShowInAdminBar()
    {
        return $this->showInAdminBar;
    }
    /**
     * method
     * 
     * 
     * @return ?int
     */
    public function setMenuPosition($menuPosition = null)
    {
        $this->menuPosition = $menuPosition;
        return $this->menuPosition;
    }
    /**
     * method
     * 
     * @return ?int
     */
    public function getMenuPosition()
    {
        return $this->menuPosition;
    }
    /**
     * method
     * 
     * 
     * @return ?string
     */
    public function setMenuIcon($menuIcon = null)
    {
        $this->menuIcon = $menuIcon;
        return $this->menuIcon;
    }
    /**
     * method
     * 
     * @return ?string
     */
    public function getMenuIcon()
    {
        return $this->menuIcon;
    }
    /**
     * method
     * 
     * 
     * @return ?string
     */
    public function setSingleCapabilityType($singleCapabilityType = null)
    {
        $this->singleCapabilityType = $singleCapabilityType;
        return $this->singleCapabilityType;
    }
    /**
     * method
     * 
     * @return ?string
     */
    public function getSingleCapabilityType()
    {
        return $this->singleCapabilityType;
    }
    /**
     * method
     * 
     * 
     * @return ?string
     */
    public function setPluralCapabilityType($pluralCapabilityType = null)
    {
        $this->pluralCapabilityType = $pluralCapabilityType;
        return $this->pluralCapabilityType;
    }
    /**
     * method
     * 
     * @return ?string
     */
    public function getPluralCapabilityType()
    {
        return $this->pluralCapabilityType;
    }
    /**
     * method
     * 
     * 
     * @return array
     */
    public function setCapabilities(array $capabilities)
    {
        $this->capabilities = $capabilities;
        return $this->capabilities;
    }
    /**
     * method
     * 
     * @return array
     */
    public function getCapabilities()
    {
        return $this->capabilities;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setMapMetaCap($mapMetaCap)
    {
        $this->mapMetaCap = $mapMetaCap;
        return $this->mapMetaCap;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getMapMetaCap()
    {
        return $this->mapMetaCap;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setHierarchical($hierarchical)
    {
        $this->hierarchical = $hierarchical;
        return $this->hierarchical;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getHierarchical()
    {
        return $this->hierarchical;
    }
    /**
     * method
     * 
     * 
     * @return array
     */
    public function setSupports(array $supports)
    {
        $this->supports = $supports;
        return $this->supports;
    }
    /**
     * method
     * 
     * @return array
     */
    public function getSupports()
    {
        return $this->supports;
    }
    /**
     * method
     * 
     * 
     * @return ?callable
     */
    public function setRegisterMetaBox(callable $registerMetaBox = null)
    {
        $this->registerMetaBox = $registerMetaBox;
        return $this->registerMetaBox;
    }
    /**
     * method
     * 
     * @return ?callable
     */
    public function getRegisterMetaBox()
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
    public function setTaxonomies(array $taxonomies)
    {
        $this->parent['taxonomies'] = $taxonomies;
        return $this->taxonomies;
    }
    /**
     * method
     * 
     * @return array
     */
    public function getTaxonomies()
    {
        return $this->parent['taxonomies'];
    }
    /**
     * method
     * 
     * 
     * @return IWordPressPostType
     */
    public function addTaxonomy($taxonomy)
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
    public function setHasArchive($hasArchive)
    {
        $this->hasArchive = $hasArchive;
        return $this->hasArchive;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getHasArchive()
    {
        return $this->hasArchive;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setRewrite($rewrite)
    {
        $this->rewrite = $rewrite;
        return $this->rewrite;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getRewrite()
    {
        return $this->rewrite;
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public function setRewriteSlug($rewriteSlug)
    {
        $this->rewriteSlug = $rewriteSlug;
        return $this->rewriteSlug;
    }
    /**
     * method
     * 
     * @return string
     */
    public function getRewriteSlug()
    {
        return $this->rewriteSlug;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setRewriteWithFront($rewriteWithFront)
    {
        $this->rewriteWithFront = $rewriteWithFront;
        return $this->rewriteWithFront;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getRewriteWithFront()
    {
        return $this->rewriteWithFront;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setRewriteFeeds($rewriteFeeds)
    {
        $this->rewriteFeeds = $rewriteFeeds;
        return $this->rewriteFeeds;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getRewriteFeeds()
    {
        return $this->rewriteFeeds;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setRewritePages($rewritePages)
    {
        $this->rewritePages = $rewritePages;
        return $this->rewritePages;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getRewritePages()
    {
        return $this->rewritePages;
    }
    /**
     * method
     * 
     * 
     * @return ?string
     */
    public function setRewriteEndPointMask($rewriteEndPointMask = null)
    {
        $this->rewriteEndPointMask = $rewriteEndPointMask;
        return $this->rewriteEndPointMask;
    }
    /**
     * method
     * 
     * @return ?string
     */
    public function getRewriteEndPointMask()
    {
        return $this->rewriteEndPointMask;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setEnableQueryVar($enableQueryVar)
    {
        $this->enableQueryVar = $enableQueryVar;
        return $this->enableQueryVar;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getEnableQueryVar()
    {
        return $this->enableQueryVar;
    }
    /**
     * method
     * 
     * 
     * @return ?string
     */
    public function setQueryVar($queryVar = null)
    {
        $this->queryVar = $queryVar;
        return $this->queryVar;
    }
    /**
     * method
     * 
     * @return ?string
     */
    public function getQueryVar()
    {
        return $this->queryVar;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setCanExport($canExport)
    {
        $this->canExport = $canExport;
        return $this->canExport;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getCanExport()
    {
        return $this->canExport;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setDeleteWithUser($deleteWithUser)
    {
        $this->deleteWithUser = $deleteWithUser;
        return $this->deleteWithUser;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getDeleteWithUser()
    {
        return $this->deleteWithUser;
    }
    /**
     * method
     * 
     * 
     * @return bool
     */
    public function setShowInRest($showInRest)
    {
        $this->showInRest = $showInRest;
        return $this->showInRest;
    }
    /**
     * method
     * 
     * @return bool
     */
    public function getShowInRest()
    {
        return $this->showInRest;
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public function setRestBase($restBase)
    {
        $this->restBase = $restBase;
        return $this->restBase;
    }
    /**
     * method
     * 
     * @return string
     */
    public function getRestBase()
    {
        return $this->restBase;
    }
    /**
     * method
     * 
     * 
     * @return string
     */
    public function setRestControllerClass($restControllerClass)
    {
        $this->restControllerClass = $restControllerClass;
        return $this->restControllerClass;
    }
    /**
     * method
     * 
     * @return string
     */
    public function getRestControllerClass()
    {
        return $this->restControllerClass;
    }
}