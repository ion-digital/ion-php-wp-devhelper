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
    static function registerLog(string $slug, string $name = null) : WordPressHelperLogInterface;
    /**
     * method
     * 
     * 
     * @return WordPressHelperLogInterface
     */
    static function log(string $message, int $level = null, string $slug = null, array $logContext = null) : WordPressHelperLogInterface;
    /**
     * method
     * 
     * @return array
     */
    static function getLogs() : array;
}