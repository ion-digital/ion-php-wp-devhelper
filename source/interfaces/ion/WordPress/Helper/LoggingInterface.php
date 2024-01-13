<?php

namespace Ion\WordPress\Helper;

use \Ion\WordPress\Helper\WordPressHelperLogInterface;


/**
 * Description of LoggingTrait*
 * @author Justus
 */
interface LoggingInterface {

    static function registerLog(string $slug, string $name = null): WordPressHelperLogInterface;

    static function log(

        string $message,
        int $level = null,
        string $slug = null,
        array $logContext = null

    ): WordPressHelperLogInterface;

    static function getLogs(): array;

}
