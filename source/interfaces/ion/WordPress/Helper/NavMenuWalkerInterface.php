<?php

use \Walker_Nav_MenuInterface;

interface NavMenuWalkerInterface extends Walker_Nav_MenuInterface {

    /**
     * Starts the element output.
     *
     * @since 3.0.0
     * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
     *
     * @see Walker::start_el()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */

    function start_el(

        &$output,
        $item,
        $depth = 0,
        $args = [[  ]],
        $id = 0

    );

}
