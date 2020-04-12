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
use ion\Base;
use ion\Singleton;
use ion\WordPress\WordPressHelper as WP;
use ion\Types\IString;
use ion\Package;
use ion\IPackage;
use ion\WordPress\Admin\IAdminMenuVectorBase;
use ion\WordPress\Admin\IAdminMetaBoxVectorBase;
use ion\WordPress\Admin\AdminMenuVector;
use ion\WordPress\Admin\AdminMetaBoxVector;
use ion\WordPress\Admin\Settings\SettingsMenu;
use ion\Types\StringObject;
use ion\WordPress\Admin\AdminMetaBoxContext;
use ion\WordPress\Admin\AdminMetaBoxPriority;
use ion\WordPress\Admin\IAdminPostMetaBox;
use ion\WordPress\Admin\IAdminTermMetaBox;
use ion\WordPress\Admin\IAdminUserMetaBox;
use ion\System\IPath;
use ion\System\Path;
use ion\System\Remote\IUri;
use ion\System\Remote\Uri;
use ion\System\Remote\IUriPath;
use ion\System\Remote\UriPath;
//use \ion\WordPress\Helper\IHelperContext;
trait TContext
{
    private static $contextInstances = [];
    protected static function getContextInstance() : ?IContext
    {
        if (!array_key_exists(static::class, self::$contextInstances)) {
            return null;
        }
        return self::$contextInstances[static::class];
    }
    
    protected static final function doUninstall() : void
    {
        static::getContextInstance()->uninstall();
        static::getContextInstance()->onUninstalled();
        return;
    }
    
    private $helperContext = null;
    private $package = null;
    protected final function __construct_TContext(IPackage $package, array $helperSettings = null) : void
    {
        //        if(static::getContextInstance() === null) {
        //
        //            throw new WordPressHelperException("Context is not initialized yet.")
        //        }
        self::$contextInstances[static::class] = $this;
        $this->package = $package;
        $helper = WP::createContext($package->getVendor(), $package->getProject(), $package->getProjectEntry(), null, $helperSettings);
        $this->helperContext = $helper->getContext();
        $helper->initialize(function (IHelperContext $context) {
            $this->initialize();
            $this->onInitialized();
            return;
        })->activate(function (IHelperContext $context) {
            $this->activate();
            $this->onActivated();
            return;
        })->deactivate(function (IHelperContext $context) {
            $this->deactivate();
            $this->onDeactivated();
            return;
        })->uninstall([static::class, 'doUninstall'])->finalize(function (IHelperContext $context) {
            $this->finalize();
            $this->onFinalized();
            return;
        });
    }
    
    public final function getHelperContext() : IHelperContext
    {
        if ($this->helperContext === null) {
            throw new WordPressHelperException("Context is not initialized yet.");
        }
        return $this->helperContext;
    }
    
    public final function getPackage() : IPackage
    {
        if ($this->package === null) {
            throw new WordPressHelperException("Context is not initialized yet.");
        }
        return $this->package;
    }
    
    protected abstract function initialize() : void;
    
    protected function onInitialized() : void
    {
        // Empty, for now...
    }
    
    protected function activate() : void
    {
        // Empty, for now...
    }
    
    protected function onActivated() : void
    {
        // Empty, for now...
    }
    
    protected function deactivate() : void
    {
        // Empty, for now...
    }
    
    protected function onDeactivated() : void
    {
        // Empty, for now...
    }
    
    protected function uninstall() : void
    {
        // Empty, for now...
    }
    
    protected function onUninstalled() : void
    {
        // Empty, for now...
    }
    
    protected function finalize() : void
    {
        // Empty, for now...
    }
    
    protected function onFinalized() : void
    {
        // Empty, for now...
    }

}