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
    
    function addSubMenuPage($title, callable $content, $id = null, $menuTitle = null, $capability = null);
    
    /**
     * method
     * 
     * 
     * @return IAdminMenuPageHelper
     */
    
    function addSubMenuPageTab($title, callable $content, $id = null, $menuTitle = null, $capability = null);

}