<?php
namespace ion\WordPress\Helper;

use ion\WordPress\Helper\WP_Term;
interface WordPressTermInterface
{
    /**
     * method
     * 
     * @return WP_Term
     */
    function getTermObject();
    /**
     * method
     * 
     * @return array
     */
    function &getChildren();
}