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


class WordPressPostType implements WordPressPostTypeInterface {

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
    
    public function __construct(string $slug, array &$parent
//        string $slug,
//        string $pluralItemName,
//        string $singleItemName,
//        array $labels = null,
//        string $description = null,
//        bool $public = true,
//        bool $excludeFromSearch = null,
//        bool $publiclyQueryable = null,
//        bool $showUi = null,
//        bool $showInNavMenus = null,
//        bool $showInMenu = null,
//        bool $showInAdminBar = null,
//        int $menuPosition = null,
//        string $menuIcon = null,
//        string $singleCapabilityType = null,
//        string $pluralCapabilityType = null,
//        array $capabilities = null,
//        bool $mapMetaCap = null,
//        bool $hierarchical = false,
//        array $supports = null,
//        callable $registerMetaBox = null,
//        VectorInterface $taxonomies = null,
//        bool $rewriteWithFront = true,
//        bool $rewriteFeeds = null,
//        bool $rewritePages = true,
//        string $rewriteEndPointMask = null,
//        bool $enableQueryVar = false,
//        string $queryVar = null,
//        bool $canExport = true,
//        bool $deleteWithUser = null,
//        bool $showInRest = false,
//        string $restBase = null,
//        string $restControllerClass = null    
//        bool $hasArchive = false,
//        bool $rewrite = true,
//        string $rewriteSlug = null,
//        bool $rewriteWithFront = true,
//        bool $rewriteFeeds = null,
//        bool $rewritePages = true,
//        string $rewriteEndPointMask = null,
//        bool $enableQueryVar = false,
//        string $queryVar = null,
//        bool $canExport = true,
//        bool $deleteWithUser = null,
//        bool $showInRest = false,
//        string $restBase = null,
//        string $restControllerClass = null        
    ) {
        $this->parent = &$parent;
        $this->slug = $slug;
        
    }
    
    
//    public function setSlug(string $slug): string {
//        $this->slug = $slug;
//        return $this->slug;
//    }
    
    public function getSlug(): string {
        
        return $this->slug;
    }        
    
    public function setPluralLabel(string $pluralLabel): string {
        
        $this->parent['pluralLabel'] = $pluralLabel;
        return $this->pluralItemName;
    }
    
    public function getPluralLabel(): string {
        
        return $this->parent['pluralLabel'];
    }
    
    public function pluralLabel(string $pluralLabel): WordPressPostTypeInterface {
        
        $this->setPluralLabel($pluralLabel);
        return $this;
    }
    
    public function setLabels(array $labels): array {
        
        $this->labels = $labels;
        return $this->labels;
    }
    
    public function getLabels(): array {
        
        return $this->labels;
    }
    
    
    public function setDescription(string $description = null): ?string {
        
        $this->description = $description;
        return $this->description;
    }
    
    public function getDescription(): ?string {
        
        return $this->description;
    }
    
    
    public function setPublic(bool $public): bool {
        
        $this->public = $public;
        return $this->public;
    }
    
    public function getPublic(): bool {
        
        return $this->public;
    }
    
    
    public function setExcludeFromSearch(bool $excludeFromSearch): bool {
        
        $this->excludeFromSearch = $excludeFromSearch;
        return $this->excludeFromSearch;
    }
    
    public function getExcludeFromSearch(): bool {
        
        return $this->excludeFromSearch;
    }
    
    
    public function setPubliclyQueryable(bool $publiclyQueryable): bool {
        
        $this->publiclyQueryable = $publiclyQueryable;
        return $this->publiclyQueryable;
    }
    
    public function getPubliclyQueryable(): bool {
        
        return $this->publiclyQueryable;
    }
    
    
    public function setShowUi(bool $showUi = null): bool {
        
        $this->showUi = $showUi;
        return $this->showUi;
    }
    
    public function getShowUi(): bool {
        
        return $this->showUi;
    }
    
    
    public function setShowInNavMenus(bool $showInNavMenus): bool {
        
        $this->showInNavMenus = $showInNavMenus;
        return $this->showInNavMenus;
    }
    
    public function getShowInNavMenus(): bool {
        
        return $this->showInNavMenus;
    }
    
    
    public function setShowInMenu(bool $showInMenu): bool {
        
        $this->showInMenu = $showInMenu;
        return $this->showInMenu;
    }
    
    public function getShowInMenu(): bool {
        
        return $this->showInMenu;
    }
    
    
    public function setShowInAdminBar(bool $showInAdminBar): bool {
        
        $this->showInAdminBar = $showInAdminBar;
        return $this->showInAdminBar;
    }
    
    public function getShowInAdminBar(): bool {
        
        return $this->showInAdminBar;
    }
    
    
    public function setMenuPosition(int $menuPosition = null): ?int {
        
        $this->menuPosition = $menuPosition;
        return $this->menuPosition;
    }
    
    public function getMenuPosition(): ?int {
        
        return $this->menuPosition;
    }
    
    
    public function setMenuIcon(string $menuIcon = null): ?string {
        
        $this->menuIcon = $menuIcon;
        return $this->menuIcon;
    }
    
    public function getMenuIcon(): ?string {
        
        return $this->menuIcon;
    }
    
    
    public function setSingleCapabilityType(string $singleCapabilityType = null): ?string {
        
        $this->singleCapabilityType = $singleCapabilityType;
        return $this->singleCapabilityType;
    }
    
    public function getSingleCapabilityType(): ?string {
        
        return $this->singleCapabilityType;
    }
    
    
    public function setPluralCapabilityType(string $pluralCapabilityType = null): ?string {
        
        $this->pluralCapabilityType = $pluralCapabilityType;
        return $this->pluralCapabilityType;
    }
    
    public function getPluralCapabilityType(): ?string {
        
        return $this->pluralCapabilityType;
    }
    
    
    public function setCapabilities(array $capabilities): array {
        
        $this->capabilities = $capabilities;
        return $this->capabilities;
    }
    
    public function getCapabilities(): array {
        
        return $this->capabilities;
    }
    
    
    public function setMapMetaCap(bool $mapMetaCap): bool {
        
        $this->mapMetaCap = $mapMetaCap;
        return $this->mapMetaCap;
    }
    
    public function getMapMetaCap(): bool {
        
        return $this->mapMetaCap;
    }
    
    
    public function setHierarchical(bool $hierarchical): bool {
        
        $this->hierarchical = $hierarchical;
        return $this->hierarchical;
    }
    
    public function getHierarchical(): bool {
        
        return $this->hierarchical;
    }
    
    
    public function setSupports(array $supports): array {
        
        $this->supports = $supports;
        return $this->supports;
    }
    
    public function getSupports(): array {
        
        return $this->supports;
    }
    
    
    public function setRegisterMetaBox(callable $registerMetaBox = null): ?callable {
        
        $this->registerMetaBox = $registerMetaBox;
        return $this->registerMetaBox;
    }
    
    public function getRegisterMetaBox(): ?callable {
        
        return $this->registerMetaBox;
    }
    
    // taxonomies
    
    public function setTaxonomies(array $taxonomies): array {
        
        $this->parent['taxonomies'] = $taxonomies;
        return $this->taxonomies;
    }
    
    public function getTaxonomies(): array {
        
        return $this->parent['taxonomies'];
    }
    
    public function addTaxonomy(string $taxonomy): WordPressPostTypeInterface {
        
        $this->parent['taxonomies'][] = $taxonomy;
        return $this;
    }
    
    
    public function setHasArchive(bool $hasArchive): bool {
        
        $this->hasArchive = $hasArchive;
        return $this->hasArchive;
    }
    
    public function getHasArchive(): bool {
        
        return $this->hasArchive;
    }
    
    
    public function setRewrite(bool $rewrite): bool {
        
        $this->rewrite = $rewrite;
        return $this->rewrite;
    }
    
    public function getRewrite(): bool {
        
        return $this->rewrite;
    }
    
    
    public function setRewriteSlug(string $rewriteSlug): string {
        
        $this->rewriteSlug = $rewriteSlug;
        return $this->rewriteSlug;
    }
    
    public function getRewriteSlug(): string {
        
        return $this->rewriteSlug;
    }
    
    
    public function setRewriteWithFront(bool $rewriteWithFront): bool {
        
        $this->rewriteWithFront = $rewriteWithFront;
        return $this->rewriteWithFront;
    }
    
    public function getRewriteWithFront(): bool {
        
        return $this->rewriteWithFront;
    }
    
    
    public function setRewriteFeeds(bool $rewriteFeeds): bool {
        
        $this->rewriteFeeds = $rewriteFeeds;
        return $this->rewriteFeeds;
    }
    
    public function getRewriteFeeds(): bool {
        
        return $this->rewriteFeeds;
    }
    
    
    public function setRewritePages(bool $rewritePages): bool {
        
        $this->rewritePages = $rewritePages;
        return $this->rewritePages;
    }
    
    public function getRewritePages(): bool {
        
        return $this->rewritePages;
    }
    
    
    public function setRewriteEndPointMask(string $rewriteEndPointMask = null): ?string {
        
        $this->rewriteEndPointMask = $rewriteEndPointMask;
        return $this->rewriteEndPointMask;
    }
    
    public function getRewriteEndPointMask(): ?string {
        
        return $this->rewriteEndPointMask;
    }
    
    
    public function setEnableQueryVar(bool $enableQueryVar): bool {
        
        $this->enableQueryVar = $enableQueryVar;
        return $this->enableQueryVar;
    }
    
    public function getEnableQueryVar(): bool {
        
        return $this->enableQueryVar;
    }
    
    
    public function setQueryVar(string $queryVar = null): ?string {
        
        $this->queryVar = $queryVar;
        return $this->queryVar;
    }
    
    public function getQueryVar(): ?string {
        
        return $this->queryVar;
    }
    
    
    public function setCanExport(bool $canExport): bool {
        
        $this->canExport = $canExport;
        return $this->canExport;
    }
    
    public function getCanExport(): bool {
        
        return $this->canExport;
    }
    
    
    public function setDeleteWithUser(bool $deleteWithUser): bool {
        
        $this->deleteWithUser = $deleteWithUser;
        return $this->deleteWithUser;
    }
    
    public function getDeleteWithUser(): bool {
        
        return $this->deleteWithUser;
    }
    
    
    public function setShowInRest(bool $showInRest): bool {
        
        $this->showInRest = $showInRest;
        return $this->showInRest;
    }
    
    public function getShowInRest(): bool {
        
        return $this->showInRest;
    }
    
    
    public function setRestBase(string $restBase): string {
        
        $this->restBase = $restBase;
        return $this->restBase;
    }
    
    public function getRestBase(): string {
        
        return $this->restBase;
    }
    
       
    public function setRestControllerClass(string $restControllerClass): string {
        
        $this->restControllerClass = $restControllerClass;
        return $this->restControllerClass;
    }
    
    
    public function getRestControllerClass(): string {
        
        return $this->restControllerClass;
    }    
    
    
}
