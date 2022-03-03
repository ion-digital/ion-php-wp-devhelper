<?php
namespace ion\WordPress\Helper;

use ion\WordPress\Helper\WordPressWidgetInterface;
/**
 * Description of WidgetsTrait*
 * @author Justus
 */
interface WidgetsInterface
{
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addSideBar(string $name, string $description = null, string $id = null, string $beforeWidget = null, string $afterWidget = null, string $beforeTitle = null, string $afterTitle = null) : void;
    /**
     * method
     * 
     * 
     * @return WordPressWidgetInterface
     */
    static function addWidget(WordPressWidgetInterface $widget) : WordPressWidgetInterface;
    /**
     * method
     * 
     * 
     * @return WordPressWidgetInterface
     */
    static function getWidget(string $id) : WordPressWidgetInterface;
}