<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

use ion\Logger\Logger;
use Psr\Log\LoggerInterface;
interface IWordPressHelperLog
{
    /**
     * Get the underlying PSR logging interface implementation.
     *
     * @return LoggerInterface
     */
    function getLogger() : ?IWordPressHelperLogger;
    /**
     * method
     * 
     * 
     * @return IWordPressHelperLog
     */
    function setName(string $name = null) : IWordPressHelperLog;
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
     * @return void
     */
    function emergency(string $message, array $logContext = []) : IWordPressHelperLog;
    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array  $context
     *
     * @return IWordPressHelperLog
     */
    function alert(string $message, array $logContext = []) : IWordPressHelperLog;
    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array  $context
     *
     * @return IWordPressHelperLog
     */
    function critical(string $message, array $logContext = []) : IWordPressHelperLog;
    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array  $context
     *
     * @return IWordPressHelperLog
     */
    function error(string $message, array $logContext = []) : IWordPressHelperLog;
    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array  $context
     *
     * @return IWordPressHelperLog
     */
    function warning(string $message, array $logContext = []) : IWordPressHelperLog;
    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array  $context
     *
     * @return IWordPressHelperLog
     */
    function notice(string $message, array $logContext = []) : IWordPressHelperLog;
    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array  $context
     *
     * @return IWordPressHelperLog
     */
    function info(string $message, array $logContext = []) : IWordPressHelperLog;
    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array  $context
     *
     * @return IWordPressHelperLog
     */
    function debug(string $message, array $logContext = []) : IWordPressHelperLog;
    /**
     * Logs with an arbitrary level.
     *
     * @param string  $level
     * @param string $message
     * @param array  $context
     *
     * @return IWordPressHelperLog
     */
    function log(string $level, string $message, array $logContext = []) : IWordPressHelperLog;
}