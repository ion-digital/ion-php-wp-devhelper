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
use ion\Types\EnumObject;

class OptionMetaType extends EnumObject
{
    const POST = 1;
    const TERM = 2;
    const USER = 3;
    const COMMENT = 4;
}