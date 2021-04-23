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
    static function registerLog($slug, $name = null);
    /**
     * method
     * 
     * 
     * @return IWordPressHelperLog
     */
    static function log($message, $level = null, $slug = null, array $logContext = null);
    /**
     * method
     * 
     * @return array
     */
    static function getLogs();
}