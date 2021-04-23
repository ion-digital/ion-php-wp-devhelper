<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

use ion\WordPress\Helper\IWordPressWidget;
use ion\WordPress\IWordPressHelper;
/**
 * Description of TWidgets
 *
 * @author Justus
 */
trait TWidgets
{
    private static $widgets = [];
    private static $sideBars = [];
    /**
     * method
     * 
     * @return mixed
     */
    protected static function initialize_TWidgets()
    {
        static::registerWrapperAction('widgets_init', function () {
            foreach (static::$sideBars as $id => $sideBar) {
                register_sidebar(["name" => $sideBar["name"], "id" => $sideBar["id"], "description" => $sideBar["description"], "class" => $sideBar["class"], "before_widget" => $sideBar["before_widget"], "after_widget" => $sideBar["after_widget"], "before_title" => $sideBar["before_title"], "after_title" => $sideBar["after_title"]]);
            }
            foreach (array_values(static::$widgets) as $widget) {
                register_widget($widget);
            }
        });
    }
    /**
     * method
     * 
     * 
     * @return void
     */
    public static function addSideBar(string $name, string $description = null, string $id = null, string $beforeWidget = null, string $afterWidget = null, string $beforeTitle = null, string $afterTitle = null)
    {
        $id = $id === null ? static::slugify($name) : $id;
        static::$sideBars[$id] = ["name" => $name, "id" => $id, "description" => $description, "class" => $id, "before_widget" => $beforeWidget === null ? "<div id=\"%1\" class=\"widget %2\">" : $beforeWidget, "after_widget" => $afterWidget === null ? "</div>\n" : $afterWidget, "before_title" => $beforeTitle === null ? "<h3>" : $beforeTitle, "after_title" => $afterTitle === null ? "</h3>\n" : $afterTitle];
    }
    /**
     * method
     * 
     * 
     * @return IWordPressWidget
     */
    public static function addWidget(IWordPressWidget $widget) : IWordPressWidget
    {
        static::$widgets[$widget->getId()] = $widget;
        return $widget;
    }
    /**
     * method
     * 
     * 
     * @return IWordPressWidget
     */
    public static function getWidget(string $id) : IWordPressWidget
    {
        return static::$widgets[$id];
    }
}