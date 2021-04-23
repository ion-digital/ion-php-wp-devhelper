<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 * Description of Module
 *
 * @author Justus
 */
use ion\WordPress\WordPressHelper as WP;
use ion\Package;
use ion\IPackage;
abstract class Context implements IContext
{
    use \ion\WordPress\Helper\TContext;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function __construct(IPackage $package, array $helperSettings = null)
    {
        $this->__construct_TContext($package, $helperSettings);
    }
}