<?php

namespace ion\WordPress\Helper;

use \ion\WordPress\Helper\Walker_Nav_Menu_EditInterface;

interface AdminNavMenuEditWalkerInterface extends Walker_Nav_Menu_EditInterface {

    function start_el(

        &$output,
        $item,
        $depth = 0,
        $args = [[  ]],
        $id = 0

    );

}
