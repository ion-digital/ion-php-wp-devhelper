<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

/**
 * Description of OptionType
 *
 * @author Justus
 */

use \ion\Types\EnumObject;

class OptionMetaType extends EnumObject {
    
    public const POST = 1;
    public const TERM = 2;
    public const USER = 3;
    public const COMMENT = 4;
}
