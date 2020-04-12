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
    
    static function addSideBar($name, $description = null, $id = null, $beforeWidget = null, $afterWidget = null, $beforeTitle = null, $afterTitle = null);
    
    /**
     * method
     * 
     * 
     * @return IWordPressWidget
     */
    
    static function addWidget(IWordPressWidget $widget);
    
    /**
     * method
     * 
     * 
     * @return IWordPressWidget
     */
    
    static function getWidget($id);

}