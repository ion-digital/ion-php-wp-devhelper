<?php
namespace ion\WordPress\Helper;

interface AdminMenuPageHelperInterface
{
    /**
     * method
     * 
     * 
     * @return AdminMenuPageHelperInterface
     */
    function addSubMenuPage($title, callable $content, $id = null, $menuTitle = null, $capability = null);
    /**
     * method
     * 
     * 
     * @return AdminMenuPageHelperInterface
     */
    function addSubMenuPageTab($title, callable $content, $id = null, $menuTitle = null, $capability = null);
}