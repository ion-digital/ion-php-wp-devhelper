<?php
namespace ion\WordPress\Helper;

use ion\WordPress\Helper\WordPressHelperLoggerInterface;
interface WordPressHelperFileLoggerInterface extends WordPressHelperLoggerInterface
{
    /**
     * method
     * 
     * @return mixed
     */
    function purge();
    /**
     * method
     * 
     * @return mixed
     */
    function flush();
}