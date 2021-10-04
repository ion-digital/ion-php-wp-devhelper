<?php
namespace ion\WordPress\Helper;

use ion\WordPress\Helper\WP_List_TableInterface;
interface WordPressTableInterface extends WP_List_TableInterface
{
    /**
     * method
     * 
     * 
     * @return mixed
     */
    function column_cb($item);
    /**
     * method
     * 
     * @return mixed
     */
    function get_columns();
    /**
     * method
     * 
     * @return mixed
     */
    function get_sortable_columns();
    /**
     * method
     * 
     * @return mixed
     */
    function get_bulk_actions();
    /**
     * method
     * 
     * @return mixed
     */
    function process_bulk_action();
    /**
     * method
     * 
     * @return mixed
     */
    function &get_data();
    /**
     * method
     * 
     * @return mixed
     */
    function prepare_items();
    /**
     * method
     * 
     * @return mixed
     */
    function display();
}