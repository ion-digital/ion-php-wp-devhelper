<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

use Psr\Log\LoggerInterface;
use ion\Logger\Logger;
use ion\WordPress\WordPressHelper;
class WordPressHelperLog implements IWordPressHelperLog
{
    private $logger = null;
    private $slug = null;
    private $name = null;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function __construct($slug, $name, $enable, $logToDatabase, $purgeAge = null)
    {
        $this->slug = WordPressHelper::slugify($slug);
        $this->name = $name;
        if ($enable === true) {
            //            if($logToDatabase === true) {
            //                $this->setLogger(new WordPressHelperDatabaseLogger($this->slug, $purgeAge));
            //            } else {
            //                $this->setLogger(new WordPressHelperFileLogger($this->slug, $purgeAge));
            //            }
            // File loggers are disabled - we log to the database by default, for now.
            $this->setLogger(new WordPressHelperDatabaseLogger($this->slug, $purgeAge));
        }
    }
    /**
     * method
     * 
     * 
     * @return IWordPressHelperLog
     */
    protected function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        return $this;
    }
    /**
     * Get the underlying PSR logging interface implementation.
     *
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }
    /**
     * method
     * 
     * 
     * @return IWordPressHelperLog
     */
    public function setName($name = null)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * method
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * method
     * 
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * System is unusable.
     *
     * @param string $message
     * @param array  $context
     *
     * @return IWordPressHelperLog
     */
    public function emergency($message, array $logContext = [])
    {
        if ($this->getLogger() !== null) {
            $this->getLogger()->emergency($message, $logContext);
        }
        return $this;
    }
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
    public function alert($message, array $logContext = [])
    {
        if ($this->getLogger() !== null) {
            $this->getLogger()->alert($message, $logContext);
        }
        return $this;
    }
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
    public function critical($message, array $logContext = [])
    {
        if ($this->getLogger() !== null) {
            $this->getLogger()->critical($message, $logContext);
        }
        return $this;
    }
    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array  $context
     *
     * @return IWordPressHelperLog
     */
    public function error($message, array $logContext = [])
    {
        if ($this->getLogger() !== null) {
            $this->getLogger()->error($message, $logContext);
        }
        return $this;
    }
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
    public function warning($message, array $logContext = [])
    {
        if ($this->getLogger() !== null) {
            $this->getLogger()->warning($message, $logContext);
        }
        return $this;
    }
    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array  $context
     *
     * @return IWordPressHelperLog
     */
    public function notice($message, array $logContext = [])
    {
        if ($this->getLogger() !== null) {
            $this->getLogger()->notice($message, $logContext);
        }
        return $this;
    }
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
    public function info($message, array $logContext = [])
    {
        if ($this->getLogger() !== null) {
            $this->getLogger()->info($message, $logContext);
        }
        return $this;
    }
    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array  $context
     *
     * @return IWordPressHelperLog
     */
    public function debug($message, array $logContext = [])
    {
        if ($this->getLogger() !== null) {
            $this->getLogger()->debug($message, $logContext);
        }
        return $this;
    }
    /**
     * Logs with an arbitrary level.
     *
     * @param string  $level
     * @param string $message
     * @param array  $context
     *
     * @return IWordPressHelperLog
     */
    public function log($level, $message, array $logContext = [])
    {
        if ($this->getLogger() !== null) {
            $this->getLogger()->log($level, $message, $logContext);
        }
        return $this;
    }
}