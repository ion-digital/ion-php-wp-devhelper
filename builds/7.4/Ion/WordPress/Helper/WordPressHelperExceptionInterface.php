<?php
namespace Ion\WordPress\Helper;

use WP_Error;
interface WordPressHelperExceptionInterface
{
    function getError() : ?WP_Error;
}