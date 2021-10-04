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
    function addSubMenuPage(string $title, callable $content, string $id = null, string $menuTitle = null, string $capability = null) : AdminMenuPageHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminMenuPageHelperInterface
     */
    function addSubMenuPageTab(string $title, callable $content, string $id = null, string $menuTitle = null, string $capability = null) : AdminMenuPageHelperInterface;
}