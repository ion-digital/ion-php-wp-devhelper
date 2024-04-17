<?php
namespace Ion\WordPress\Helper;

interface WordPressWidgetInterface
{
    function widget($args, $instance);
    function update($new_instance, $old_instance);
    function form($instance);
    function getId();
    function getBaseId();
}