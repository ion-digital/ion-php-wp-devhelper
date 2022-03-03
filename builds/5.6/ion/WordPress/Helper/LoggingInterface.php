<?php
namespace ion\WordPress\Helper;

use ion\WordPress\Helper\WordPressHelperLogInterface;
/**
 * Description of LoggingTrait*
 * @author Justus
 */
interface LoggingInterface
{
    /**
     * method
     * 
     * 
     * @return WordPressHelperLogInterface
     */
    static function registerLog($slug, $name = null);
    /**
     * method
     * 
     * 
     * @return WordPressHelperLogInterface
     */
    static function log($message, $level = null, $slug = null, array $logContext = null);
    /**
     * method
     * 
     * @return array
     */
    static function getLogs();
}