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
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addSideBar(string $name, string $description = null, string $id = null, string $beforeWidget = null, string $afterWidget = null, string $beforeTitle = null, string $afterTitle = null);
    /**
     * method
     * 
     * 
     * @return IWordPressWidget
     */
    static function addWidget(IWordPressWidget $widget) : IWordPressWidget;
    /**
     * method
     * 
     * 
     * @return IWordPressWidget
     */
    static function getWidget(string $id) : IWordPressWidget;
}