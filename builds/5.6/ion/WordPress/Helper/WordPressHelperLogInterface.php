<?php
namespace ion\WordPress\Helper;

use ion\WordPress\Helper\WordPressHelperLoggerInterface;
interface WordPressHelperLogInterface
{
    /**
     * Get the underlying PSR logging interface implementation.
     *
     * @return LoggerInterface
     */
    function getLogger();
    /**
     * method
     * 
     * 
     * @return WordPressHelperLogInterface
     */
    function setName($name = null);
    /**
     * method
     * 
     * @return string
     */
    function getName();
    /**
     * method
     * 
     * @return string
     */
    function getSlug();
    /**
     * System is unusable.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function emergency($message, array $logContext = []);
    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function alert($message, array $logContext = []);
    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function critical($message, array $logContext = []);
    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function error($message, array $logContext = []);
    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function warning($message, array $logContext = []);
    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function notice($message, array $logContext = []);
    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function info($message, array $logContext = []);
    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function debug($message, array $logContext = []);
    /**
     * Logs with an arbitrary level.
     *
     * @param string  $level
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function log($level, $message, array $logContext = []);
}