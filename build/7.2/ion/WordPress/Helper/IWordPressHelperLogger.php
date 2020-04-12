<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

use Psr\Log\LoggerInterface;

interface IWordPressHelperLogger extends LoggerInterface
{
    function getSlug();
    
    function purge();
    
    function getEntries($ageInDays = null);
    
    function flush();
    
    function isFlushed();
    
    function clear();
    
    function activate() : void;
    
    function deactivate() : void;

}