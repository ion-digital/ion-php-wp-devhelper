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
    function setName(string $name = null) : WordPressHelperLogInterface;
    /**
     * method
     * 
     * @return string
     */
    function getName() : string;
    /**
     * method
     * 
     * @return string
     */
    function getSlug() : string;
    /**
     * System is unusable.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function emergency(string $message, array $logContext = []) : WordPressHelperLogInterface;
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
    function alert(string $message, array $logContext = []) : WordPressHelperLogInterface;
    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function critical(string $message, array $logContext = []) : WordPressHelperLogInterface;
    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function error(string $message, array $logContext = []) : WordPressHelperLogInterface;
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
    function warning(string $message, array $logContext = []) : WordPressHelperLogInterface;
    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function notice(string $message, array $logContext = []) : WordPressHelperLogInterface;
    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function info(string $message, array $logContext = []) : WordPressHelperLogInterface;
    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function debug(string $message, array $logContext = []) : WordPressHelperLogInterface;
    /**
     * Logs with an arbitrary level.
     *
     * @param string  $level
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/
    function log(string $level, string $message, array $logContext = []) : WordPressHelperLogInterface;
}