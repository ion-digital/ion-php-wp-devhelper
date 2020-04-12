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
    function widget($args, $instance);
    
    function update($new_instance, $old_instance);
    
    function form($instance);
    
    function GetId();
    
    function GetBaseId();

}