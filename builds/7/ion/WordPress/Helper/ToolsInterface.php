<?php

namespace ion\WordPress\Helper;

interface ToolsInterface {

    static function isHidden();

    static function isDisabled();

    static function enable();

    static function disable();

    static function addEnableMenuItem();

}
