<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper;


use \Psr\Log\LoggerInterface;
use \ion\Logger\Logger;
use \ion\WordPress\WordPressHelper;

class WordPressHelperLog implements WordPressHelperLogInterface{
    private $logger = null;
    private $slug = null;
    private $name = null;

    public function __construct(string $slug, string $name, bool $enable, bool $logToDatabase, int $purgeAge = null)
    {
        $this->slug = WordPressHelper::slugify($slug);
        $this->name = $name;

        if($enable === true) {
//            if($logToDatabase === true) {
//                $this->setLogger(new WordPressHelperDatabaseLogger($this->slug, $purgeAge));
//            } else {
//                $this->setLogger(new WordPressHelperFileLogger($this->slug, $purgeAge));
//            }
            
            // File loggers are disabled - we log to the database by default, for now.
            $this->setLogger(new WordPressHelperDatabaseLogger($this->slug, $purgeAge));
        }
    }
    
    protected function setLogger(LoggerInterface $logger): WordPressHelperLogInterface{
        $this->logger = $logger;
        return $this;
    }    

    /**
     * Get the underlying PSR logging interface implementation.
     *
     * @return LoggerInterface
     */

    public function getLogger(): ?WordPressHelperLoggerInterface{
        return $this->logger;
    }

    public function setName(string $name = null): WordPressHelperLogInterface{
        $this->name = $name;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSlug(): string {
        return $this->slug;
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array  $context
     *
     * @return WordPressHelperLogInterface*/

    public function emergency(string $message, array $logContext = []): WordPressHelperLogInterface{
        if($this->getLogger() !== null) {
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
     * @return WordPressHelperLogInterface*/

    public function alert(string $message, array $logContext = []): WordPressHelperLogInterface{
        if($this->getLogger() !== null) {
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
     * @return WordPressHelperLogInterface*/

    public function critical(string $message, array $logContext = []): WordPressHelperLogInterface{
        if($this->getLogger() !== null) {
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
     * @return WordPressHelperLogInterface*/

    public function error(string $message, array $logContext = []): WordPressHelperLogInterface{
        if($this->getLogger() !== null) {
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
     * @return WordPressHelperLogInterface*/

    public function warning(string $message, array $logContext = []): WordPressHelperLogInterface{
        if($this->getLogger() !== null) {
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
     * @return WordPressHelperLogInterface*/

    public function notice(string $message, array $logContext = []): WordPressHelperLogInterface{
        if($this->getLogger() !== null) {
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
     * @return WordPressHelperLogInterface*/

    public function info(string $message, array $logContext = []): WordPressHelperLogInterface{
        if($this->getLogger() !== null) {
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
     * @return WordPressHelperLogInterface*/

    public function debug(string $message, array $logContext = []): WordPressHelperLogInterface{
        if($this->getLogger() !== null) {
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
     * @return WordPressHelperLogInterface*/

    public function log(string $level, string $message, array $logContext = []): WordPressHelperLogInterface{
        if($this->getLogger() !== null) {
            $this->getLogger()->log($level, $message, $logContext);
        }

        return $this;
    }
}