<?php

namespace ion\WordPress\Helper;

use \ion\WordPress\Helper\WP_Term;

interface WordPressTermInterface {

    function getTermObject(): WP_Term;

    function &getChildren(): array;

}
