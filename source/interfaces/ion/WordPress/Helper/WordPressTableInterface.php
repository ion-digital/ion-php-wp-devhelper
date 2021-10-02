<?php

namespace ion\WordPress\Helper;

use \ion\WordPress\Helper\WP_List_TableInterface;

interface WordPressTableInterface extends WP_List_TableInterface {

    function column_cb($item);

    function get_columns();

    function get_sortable_columns();

    function get_bulk_actions();

    function process_bulk_action();

    function &get_data();

    function prepare_items();

    function display();

}
