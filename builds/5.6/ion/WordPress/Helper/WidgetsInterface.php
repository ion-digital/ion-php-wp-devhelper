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
    static function addSideBar($name, $description = null, $id = null, $beforeWidget = null, $afterWidget = null, $beforeTitle = null, $afterTitle = null);
    /**
     * method
     * 
     * 
     * @return WordPressWidgetInterface
     */
    static function addWidget(WordPressWidgetInterface $widget);
    /**
     * method
     * 
     * 
     * @return WordPressWidgetInterface
     */
    static function getWidget($id);
}