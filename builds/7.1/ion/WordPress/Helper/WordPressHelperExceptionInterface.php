<?php
namespace ion\WordPress\Helper;

use WP_Error;
interface WordPressHelperExceptionInterface
{
    /**
     * method
     * 
     * @return ?WP_Error
     */
    function getError() : ?WP_Error;
}