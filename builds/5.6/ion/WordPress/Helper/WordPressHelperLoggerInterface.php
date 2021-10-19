<?php
namespace ion\WordPress\Helper;

interface WordPressHelperLoggerInterface
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
     * @return ?string
     */
    function getSlug();
    /**
     * method
     * 
     * @return ?int
     */
    function getPurgeAge();
    /**
     * method
     * 
     * 
     * @return mixed
     */
    function getEntries($ageInDays = null);
    /**
     * method
     * 
     * @return mixed
     */
    function getFlushImmediately();
    /**
     * method
     * 
     * 
     * @return mixed
     */
    function log($level, $message, array $context = []);
    /**
     * method
     * 
     * @return mixed
     */
    function isFlushed();
    /**
     * method
     * 
     * @return mixed
     */
    function clear();
    /**
     * method
     * 
     * 
     * @return mixed
     */
    function purge($full = false);
}