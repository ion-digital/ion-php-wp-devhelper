<?php

namespace ion\WordPress\Helper\Wrappers;

use \ion\WordPress\Helper\Wrappers\OptionMetaType;

interface OptionMetaTypeInterface {

    static function create(string $value = null): OptionMetaType;

    function toString(): string;

    function toValue(): ?string;

}
