<?php

namespace ion\WordPress\Helper;

use \WP_Term;

interface WordPressTermInterface {

    function getTermObject(): WP_Term;

    function &getChildren(): array;

}
