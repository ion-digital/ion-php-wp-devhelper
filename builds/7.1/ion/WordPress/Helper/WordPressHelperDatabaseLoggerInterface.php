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
    function activate(bool $force = false) : void;
    /**
     * method
     * 
     * @return void
     */
    function deactivate() : void;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    function purge(bool $full = false);
    /**
     * method
     * 
     * @return mixed
     */
    function flush();
}