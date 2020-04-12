<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */

use \ion\WordPress\Helper\IWordPressHelperLog;

interface ILogging {
    
    static function registerLog(string $slug, string $name = null): IWordPressHelperLog;

    static function log(string $message, int $level = null, string $slug = null, array $logContext = null): IWordPressHelperLog;

    static function getLogs(): array;

    
}
