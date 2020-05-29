<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */

use \ion\WordPress\Helper\IWordPressWidget;

interface ITemplate {       

    static function addMenu(string $id, string $description = null): void;

    static function isFrontPage(int $postId = null): bool;
    
    static function isPostsPage(int $postId = null): bool;
    
    static function isBlogPage(): bool;
    
    static function isPage(): bool;
    
    static function isPost(string $name = null): bool;
       
    static function isCategory(string $name = null): bool;
    
    static function isArchive(): bool;   

    static function getCurrentTemplateObjectType(bool $ignoreTheLoop = false): ?string;
    
    static function getCurrentTemplateObject(bool $ignoreTheLoop = false): ?object;
   
    static function getCurrentTemplateObjectId(bool $ignoreTheLoop = false): ?int;    
    
    // --- Deprecated ---
    
    static function getUriObject(): ?object;
    
    static function getUriPostId(): ?int;
    
    // --- Convenience methods for use in templates ---
    
    static function menu(string $id, string $template = null, string $menuId = null, int $depth = 0, bool $echo = false): string;
    
    static function theLoop(callable $generator = null, int $limit = null,  string $emptyText = null, bool $echo = false): string;       
    
    static function title(bool $echo = true): string;
    
    static function content(bool $echo = true): string; 
    
    static function siteLink(array $controllers = null, array $parameters = null, bool $absolute = true, bool $echo = true): string;
    
    static function sideBar(string $id, bool $echo = true): string;   
    
    static function widget(IWordPressWidget $widget, array $values = null, string $beforeWidget = null, string $afterWidget = null, string $beforeTitle = null, string $afterTitle = null, bool $echo = true): string;
    
    static function isPaginated(): bool;
    
    static function getCurrentPage(): int;
    
    static function getPageLinks(bool $prevNext = false, string $prevText = null, string $nextText = null): array;
    
    static function getSearchTerms(): array;
    
    static function getPostsPerPage(): int;
    
    static function getTotalPostCount(WP_Query $wpQuery = null): int;
}
