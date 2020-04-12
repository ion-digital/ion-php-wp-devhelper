<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */

interface IOptions {

    static function getOption(string $key, /* mixed */ $default = null, int $id = null, OptionMetaType $type = null, bool $raw = false) /* mixed */;

    static function getRawOption(string $key, /* mixed */ $default = null, int $id = null, OptionMetaType $type = null) /* mixed */;
    
    static function setOption(string $key, /* mixed */ $value = null, int $id = null, OptionMetaType $type = null, bool $raw = false, bool $autoLoad = false): bool;
    
    static function setRawOption(string $key, /* mixed */ $value = null, int $id = null, OptionMetaType $type = null, bool $autoLoad = false): bool;

    static function hasOption(string $key, int $id = null, OptionMetaType $type = null): bool;
    
    static function removeOption(string $key,  int $postId = null, OptionMetaType $type = null): bool;    
    
}
