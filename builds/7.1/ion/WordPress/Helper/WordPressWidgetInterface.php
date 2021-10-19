<?php
namespace ion\WordPress\Helper;

interface WordPressWidgetInterface
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
    function getId();
    /**
     * method
     * 
     * @return mixed
     */
    function getBaseId();
}