<?php

namespace ion\WordPress\Helper;

use \ion\WordPress\Helper\WordPressHelperLoggerInterface;

interface WordPressHelperDatabaseLoggerInterface extends WordPressHelperLoggerInterface {

    function __destruct();

    function activate(bool $force = false): void;

    function deactivate(): void;

    function purge(bool $full = false);

    function flush();

}
