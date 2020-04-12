<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */
use ion\WordPress\Helper\IWordPressHelperLog;

interface ILogging
{
    /**
     * method
     * 
     * 
     * @return IWordPressHelperLog
     */
    
    static function registerLog(string $slug, string $name = null) : IWordPressHelperLog;
    
    /**
     * method
     * 
     * 
     * @return IWordPressHelperLog
     */
    
    static function log(string $message, int $level = null, string $slug = null, array $logContext = null) : IWordPressHelperLog;
    
    /**
     * method
     * 
     * @return array
     */
    
    static function getLogs() : array;

}