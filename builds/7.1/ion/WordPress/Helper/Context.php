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
use ion\PackageInterface;
abstract class Context implements ContextInterface
{
    use \ion\WordPress\Helper\ContextTrait;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function __construct(PackageInterface $package, array $helperSettings = null)
    {
        $this->__construct_ContextTrait($package, $helperSettings);
    }
}