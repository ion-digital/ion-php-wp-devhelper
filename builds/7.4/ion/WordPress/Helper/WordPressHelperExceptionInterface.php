<?php
namespace ion\WordPress\Helper;

use WP_Error;
interface WordPressHelperExceptionInterface
{
    function getError() : ?WP_Error;
}