<?php

namespace ion\WordPress\Helper;

use \ion\IPackage;
use \ion\WordPress\Helper\IHelperContext;

interface ContextInterface {

    function getHelperContext(): IHelperContext;

    function getPackage(): IPackage;

}
