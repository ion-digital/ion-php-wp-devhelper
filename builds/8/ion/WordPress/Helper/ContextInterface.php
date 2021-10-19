<?php

namespace ion\WordPress\Helper;

use \ion\PackageInterface;
use \ion\WordPress\Helper\HelperContextInterface;

interface ContextInterface {

    function getHelperContext(): HelperContextInterface;

    function getPackage(): PackageInterface;

}
