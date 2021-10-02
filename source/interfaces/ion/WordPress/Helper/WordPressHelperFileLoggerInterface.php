<?php

namespace ion\WordPress\Helper;

use \ion\WordPress\Helper\WordPressHelperLoggerInterface;

interface WordPressHelperFileLoggerInterface extends WordPressHelperLoggerInterface {

    function purge();

    function flush();

}
