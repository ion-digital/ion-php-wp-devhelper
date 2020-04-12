<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */
use ion\WordPress\Helper\IWordPressWidget;

interface IWidgets
{
    static function addSideBar(string $name, string $description = null, string $id = null, string $beforeWidget = null, string $afterWidget = null, string $beforeTitle = null, string $afterTitle = null) : void;
    
    static function addWidget(IWordPressWidget $widget) : IWordPressWidget;
    
    static function getWidget(string $id) : IWordPressWidget;

}