<?php
namespace Ion\WordPress\Helper;

use Ion\PackageInterface;
use Ion\WordPress\Helper\HelperContextInterface;
interface ContextInterface
{
    function getHelperContext() : HelperContextInterface;
    function getPackage() : PackageInterface;
}