<?php
namespace ion\WordPress\Helper;

use WP_Term;
interface WordPressTermInterface
{
    /**
     * method
     * 
     * @return WP_Term
     */
    function getTermObject() : WP_Term;
    /**
     * method
     * 
     * @return array
     */
    function &getChildren() : array;
}