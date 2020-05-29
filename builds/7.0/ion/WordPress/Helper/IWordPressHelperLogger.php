<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

use Psr\Log\LoggerInterface;

interface IWordPressHelperLogger extends LoggerInterface
{
    /**
     * method
     * 
     * @return mixed
     */
    
    function getSlug();
    
    /**
     * method
     * 
     * @return mixed
     */
    
    function purge();
    
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
    
    function flush();
    
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
     * @return void
     */
    
    function activate();
    
    /**
     * method
     * 
     * @return void
     */
    
    function deactivate();

}