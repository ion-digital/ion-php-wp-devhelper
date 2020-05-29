<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper;

/**
 *
 * @author Justus
 */
interface IAdminMenuPageHelper {
    
    function __construct(array &$parent);
    
    function addSubMenuPage(string $title, callable $content, string $id = null, string $menuTitle = null, string $capability = null): IAdminMenuPageHelper;
    
    function addSubMenuPageTab(string $title, callable $content, string $id = null, string $menuTitle = null, string $capability = null): IAdminMenuPageHelper;              
    
    
}
