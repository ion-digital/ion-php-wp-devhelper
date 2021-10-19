<?php

namespace ion\WordPress\Helper;


/**
 * Description of WordPressPostType
 *
 * @author Justus
 */
interface WordPressPostTypeInterface {

    function getSlug(): string;

    function setPluralLabel(string $pluralLabel): string;

    function getPluralLabel(): string;

    function pluralLabel(string $pluralLabel): WordPressPostTypeInterface;

    function setLabels(array $labels): array;

    function getLabels(): array;

    function setDescription(string $description = null): ?string;

    function getDescription(): ?string;

    function setPublic(bool $public): bool;

    function getPublic(): bool;

    function setExcludeFromSearch(bool $excludeFromSearch): bool;

    function getExcludeFromSearch(): bool;

    function setPubliclyQueryable(bool $publiclyQueryable): bool;

    function getPubliclyQueryable(): bool;

    function setShowUi(bool $showUi = null): bool;

    function getShowUi(): bool;

    function setShowInNavMenus(bool $showInNavMenus): bool;

    function getShowInNavMenus(): bool;

    function setShowInMenu(bool $showInMenu): bool;

    function getShowInMenu(): bool;

    function setShowInAdminBar(bool $showInAdminBar): bool;

    function getShowInAdminBar(): bool;

    function setMenuPosition(int $menuPosition = null): ?int;

    function getMenuPosition(): ?int;

    function setMenuIcon(string $menuIcon = null): ?string;

    function getMenuIcon(): ?string;

    function setSingleCapabilityType(string $singleCapabilityType = null): ?string;

    function getSingleCapabilityType(): ?string;

    function setPluralCapabilityType(string $pluralCapabilityType = null): ?string;

    function getPluralCapabilityType(): ?string;

    function setCapabilities(array $capabilities): array;

    function getCapabilities(): array;

    function setMapMetaCap(bool $mapMetaCap): bool;

    function getMapMetaCap(): bool;

    function setHierarchical(bool $hierarchical): bool;

    function getHierarchical(): bool;

    function setSupports(array $supports): array;

    function getSupports(): array;

    function setRegisterMetaBox(callable $registerMetaBox = null): ?callable;

    function getRegisterMetaBox(): ?callable;

    function setTaxonomies(array $taxonomies): array;

    function getTaxonomies(): array;

    function addTaxonomy(string $taxonomy): WordPressPostTypeInterface;

    function setHasArchive(bool $hasArchive): bool;

    function getHasArchive(): bool;

    function setRewrite(bool $rewrite): bool;

    function getRewrite(): bool;

    function setRewriteSlug(string $rewriteSlug): string;

    function getRewriteSlug(): string;

    function setRewriteWithFront(bool $rewriteWithFront): bool;

    function getRewriteWithFront(): bool;

    function setRewriteFeeds(bool $rewriteFeeds): bool;

    function getRewriteFeeds(): bool;

    function setRewritePages(bool $rewritePages): bool;

    function getRewritePages(): bool;

    function setRewriteEndPointMask(string $rewriteEndPointMask = null): ?string;

    function getRewriteEndPointMask(): ?string;

    function setEnableQueryVar(bool $enableQueryVar): bool;

    function getEnableQueryVar(): bool;

    function setQueryVar(string $queryVar = null): ?string;

    function getQueryVar(): ?string;

    function setCanExport(bool $canExport): bool;

    function getCanExport(): bool;

    function setDeleteWithUser(bool $deleteWithUser): bool;

    function getDeleteWithUser(): bool;

    function setShowInRest(bool $showInRest): bool;

    function getShowInRest(): bool;

    function setRestBase(string $restBase): string;

    function getRestBase(): string;

    function setRestControllerClass(string $restControllerClass): string;

    function getRestControllerClass(): string;

}
