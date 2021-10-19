<?php
namespace ion\WordPress\Helper;

use Psr\Log\AbstractLoggerInterface;
interface WordPressHelperLoggerInterface extends AbstractLoggerInterface
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
    function activate(bool $force = false);
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
    function purge(bool $full = false);
}