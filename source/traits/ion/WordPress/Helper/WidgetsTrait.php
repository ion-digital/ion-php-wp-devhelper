<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper;


use \ion\WordPress\Helper\WordPressWidgetInterface;
use \ion\WordPress\WordPressHelperInterface;

/**
 * Description of WidgetsTrait*
 * @author Justus
 */

trait WidgetsTrait {
    
    private static $widgets = [];   
    private static $sideBars = [];
    
    protected static function initialize() {    
        
        static::registerWrapperAction('widgets_init', function() {

            foreach (static::$sideBars as $id => $sideBar) {

                register_sidebar([
                    "name" => $sideBar["name"],
                    "id" => $sideBar["id"],
                    "description" => $sideBar["description"],
                    "class" => $sideBar["class"],
                    "before_widget" => $sideBar["before_widget"],
                    "after_widget" => $sideBar["after_widget"],
                    "before_title" => $sideBar["before_title"],
                    "after_title" => $sideBar["after_title"],
                ]);
            }

            foreach (array_values(static::$widgets) as $widget) {

                register_widget($widget);
            }
        });        
        
    }
    
    public static function addSideBar(string $name,  string $description = null, string $id = null, string $beforeWidget = null, string $afterWidget = null, string $beforeTitle = null, string $afterTitle = null): void {        

        $id = ($id === null ? static::slugify($name) : $id);

        static::$sideBars[$id] = [
            "name" => $name,
            "id" => $id,
            "description" => $description,
            "class" => $id,
            "before_widget" => ($beforeWidget === null ? "<div id=\"%1\" class=\"widget %2\">" : $beforeWidget),
            "after_widget" => ($afterWidget === null ? "</div>\n" : $afterWidget),
            "before_title" => ($beforeTitle === null ? "<h3>" : $beforeTitle),
            "after_title" => ($afterTitle === null ? "</h3>\n" : $afterTitle)
        ];
    }    
    
    public static function addWidget(WordPressWidgetInterface$widget): WordPressWidgetInterface {

        static::$widgets[$widget->getId()] = $widget;
        
        return $widget;
    }
    
    public static function getWidget(string $id): WordPressWidgetInterface {

        return static::$widgets[$id];
    }        
    
}
