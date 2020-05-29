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

use \ion\Base;
use \ion\Singleton;
use \ion\WordPress\WordPressHelper as WP;
use \ion\Types\IString;
use \ion\Package;
use \ion\IPackage;
use \ion\WordPress\Admin\IAdminMenuVectorBase;
use \ion\WordPress\Admin\IAdminMetaBoxVectorBase;
use \ion\WordPress\Admin\AdminMenuVector;
use \ion\WordPress\Admin\AdminMetaBoxVector;
use \ion\WordPress\Admin\Settings\SettingsMenu;
use \ion\Types\StringObject;
use \ion\WordPress\Admin\AdminMetaBoxContext;
use \ion\WordPress\Admin\AdminMetaBoxPriority;
use \ion\WordPress\Admin\IAdminPostMetaBox;
use \ion\WordPress\Admin\IAdminTermMetaBox;
use \ion\WordPress\Admin\IAdminUserMetaBox;
use \ion\System\IPath;
use \ion\System\Path;
use \ion\System\Remote\IUri;
use \ion\System\Remote\Uri;
use \ion\System\Remote\IUriPath;
use \ion\System\Remote\UriPath;
//use \ion\WordPress\Helper\IHelperContext;

abstract class Context implements IContext {
        
    use \ion\WordPress\Helper\TContext;
    
    public function __construct(IPackage $package, array $helperSettings = null) {

        $this->__construct_TContext($package, $helperSettings);
    }
}
