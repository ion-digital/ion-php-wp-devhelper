<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 *
 * @author Justus
 */

interface IAdminMenuPageHelper
{
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    function __construct(array &$parent);
    
    /**
     * method
     * 
     * 
     * @return IAdminMenuPageHelper
     */
    
    function addSubMenuPage(string $title, callable $content, string $id = null, string $menuTitle = null, string $capability = null) : IAdminMenuPageHelper;
    
    /**
     * method
     * 
     * 
     * @return IAdminMenuPageHelper
     */
    
    function addSubMenuPageTab(string $title, callable $content, string $id = null, string $menuTitle = null, string $capability = null) : IAdminMenuPageHelper;

}