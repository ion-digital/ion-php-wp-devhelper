<?php
namespace ion\WordPress\Helper;

use ion\WordPress\Helper\WP_WidgetInterface;
interface WordPressWidgetInterface extends WP_WidgetInterface
{
    function widget($args, $instance);
    function update($new_instance, $old_instance);
    function form($instance);
    function getId();
    function getBaseId();
}