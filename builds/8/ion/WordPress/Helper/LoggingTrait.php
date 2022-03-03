<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper;

use \ion\WordPress\Helper\WordPressHelperLogInterface;
use \ion\WordPress\Helper\WordPressHelperLog;
use \ion\WordPress\WordPressHelperInterface;
use \ion\WordPress\Helper\Constants;
use \ion\WordPress\Helper\WordPressHelperException;

/**
 * Description of LoggingTrait*
 * @author Justus
 */
trait LoggingTrait {
    
    private static $logs = [];
    
    protected static function initialize() {    
        
//        static::registerWrapperAction('init', function() {
//            
//        });        
        
    }    
    
    public static function registerLog(string $slug, string $name = null): WordPressHelperLogInterface {
        
        $slug = static::slugify($slug);

        $log = null;

        //echo "registerLog($slug)<br />"; //ERK
        
        if (!array_key_exists($slug, static::$logs)) {
            
            $log = new WordPressHelperLog(
                    
                $slug, $name, (bool) static::getSiteOption(Constants::ENABLE_LOGGING, false), (bool) static::getSiteOption(Constants::LOG_TO_DATABASE, false), (int) static::getSiteOption(Constants::LOGS_PURGE_AGE, 90)
            );

            static::$logs[$slug] = $log;
            
        } else {
            
            $log = static::$logs[$slug];
            $log->setName($name);
        }
        
        return $log;
    }
    
    public static function log(string $message, int $level = null, string $slug = null, array $logContext = null): WordPressHelperLogInterface {
        
        $log = null;

        if ($slug === null) {
            
            $log = static::getCurrentContext()->getLog();
            
        } else {
            $slug = static::slugify($slug);

            if (!array_key_exists($slug, static::$logs)) {
                
                throw new WordPressHelperException("Log '$slug' has not been registered - please register it, before calling log().");
            }

            $log = static::$logs[$slug];
        }

        if ($level === null) {
            
            $level = LogLevel::DEBUG;
        }
        
        $levelString = null;
        
        switch($level) {
            
            case LogLevel::EMERGENCY: $levelString = 'emergency'; break;
            case LogLevel::ALERT: $levelString = 'alert'; break;
            case LogLevel::CRITICAL: $levelString = 'critical'; break;
            case LogLevel::ERROR: $levelString = 'error'; break;
            case LogLevel::WARNING: $levelString = 'warning'; break;
            case LogLevel::NOTICE: $levelString = 'notice'; break;
            case LogLevel::INFO: $levelString = 'info'; break;
            case LogLevel::DEBUG: $levelString = 'debug'; break;
        }
        
        $log->log(strtolower($levelString), $message, ($logContext === null ? [] : $logContext));                        

        return $log;
    }

    public static function getLogs(): array {
        
        return static::$logs;
    }
    
}
