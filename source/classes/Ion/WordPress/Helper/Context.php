<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace Ion\WordPress\Helper;

/**
 * Description of Module
 *
 * @author Justus
 */

use \Ion\WordPress\WordPressHelper as WP;
use \Ion\Package;
use \Ion\PackageInterface;


abstract class Context implements ContextInterface {
        
    use \Ion\WordPress\Helper\ContextTrait {
        
        \ion\WordPress\Helper\ContextTrait::__construct as private __construct_ContextTrait;
    }
    
    public function __construct(PackageInterface $package, array $helperSettings = null) {

        $this->__construct_ContextTrait($package, $helperSettings);
    }
}
