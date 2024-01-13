<?php

namespace Ion\WordPress\Helper;

use \Ion\WordPress\Helper\WordPressWidgetInterface;


/**
 * Description of WidgetsTrait*
 * @author Justus
 */
interface WidgetsInterface {

    static function addSideBar(

        string $name,
        string $description = null,
        string $id = null,
        string $beforeWidget = null,
        string $afterWidget = null,
        string $beforeTitle = null,
        string $afterTitle = null

    ): void;

    static function addWidget(WordPressWidgetInterface $widget): WordPressWidgetInterface;

    static function getWidget(string $id): WordPressWidgetInterface;

}
