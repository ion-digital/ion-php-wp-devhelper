<?php
namespace ion\WordPress\Helper;

use ion\WordPress\Helper\WordPressHelperLoggerInterface;
interface WordPressHelperDatabaseLoggerInterface extends WordPressHelperLoggerInterface
{
    /**
     * method
     * 
     * @return mixed
     */
    function __destruct();
    /**
     * method
     * 
     * 
     * @return void
     */
    function activate($force = false);
    /**
     * method
     * 
     * @return void
     */
    function deactivate();
    /**
     * method
     * 
     * 
     * @return mixed
     */
    function purge($full = false);
    /**
     * method
     * 
     * @return mixed
     */
    function flush();
}