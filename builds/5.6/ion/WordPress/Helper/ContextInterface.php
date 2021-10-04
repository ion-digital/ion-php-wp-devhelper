<?php
namespace ion\WordPress\Helper;

use ion\PackageInterface;
use ion\WordPress\Helper\HelperContextInterface;
interface ContextInterface
{
    /**
     * method
     * 
     * @return HelperContextInterface
     */
    function getHelperContext();
    /**
     * method
     * 
     * @return PackageInterface
     */
    function getPackage();
}