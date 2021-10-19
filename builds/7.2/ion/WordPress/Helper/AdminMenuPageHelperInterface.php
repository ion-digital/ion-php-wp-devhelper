<?php
namespace ion\WordPress\Helper;

interface AdminMenuPageHelperInterface
{
    function addSubMenuPage(string $title, callable $content, string $id = null, string $menuTitle = null, string $capability = null) : AdminMenuPageHelperInterface;
    function addSubMenuPageTab(string $title, callable $content, string $id = null, string $menuTitle = null, string $capability = null) : AdminMenuPageHelperInterface;
}