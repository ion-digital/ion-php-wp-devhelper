<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 *
 * @author Justus
 */
interface IWordPressWidget
{
    /**
     * method
     * 
     * 
     * @return mixed
     */
    function widget($args, $instance);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    function update($new_instance, $old_instance);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    function form($instance);
    /**
     * method
     * 
     * @return mixed
     */
    function GetId();
    /**
     * method
     * 
     * @return mixed
     */
    function GetBaseId();
}