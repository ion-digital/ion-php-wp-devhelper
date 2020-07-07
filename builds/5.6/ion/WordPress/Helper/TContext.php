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
    /**
     * method
     * 
     * @return ?IContext
     */
    
    protected static function getContextInstance()
    {
        if (!array_key_exists(static::class, self::$contextInstances)) {
            return null;
        }
        return self::$contextInstances[static::class];
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    protected static final function doUninstall()
    {
        static::getContextInstance()->uninstall();
        static::getContextInstance()->onUninstalled();
        return;
    }
    
    private $helperContext = null;
    private $package = null;
    /**
     * method
     * 
     * 
     * @return void
     */
    
    protected final function __construct_TContext(IPackage $package, array $helperSettings = null)
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
            //$this->onFinalized();
            return;
        });
    }
    
    /**
     * method
     * 
     * @return IHelperContext
     */
    
    public final function getHelperContext()
    {
        if ($this->helperContext === null) {
            throw new WordPressHelperException("Context is not initialized yet.");
        }
        return $this->helperContext;
    }
    
    /**
     * method
     * 
     * @return IPackage
     */
    
    public final function getPackage()
    {
        if ($this->package === null) {
            throw new WordPressHelperException("Context is not initialized yet.");
        }
        return $this->package;
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    protected abstract function initialize();
    
    /**
     * method
     * 
     * @return void
     */
    
    protected function onInitialized()
    {
        // Empty, for now...
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    protected function activate()
    {
        // Empty, for now...
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    protected function onActivated()
    {
        // Empty, for now...
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    protected function deactivate()
    {
        // Empty, for now...
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    protected function onDeactivated()
    {
        // Empty, for now...
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    protected function uninstall()
    {
        // Empty, for now...
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    protected function onUninstalled()
    {
        // Empty, for now...
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    protected function finalize()
    {
        // Empty, for now...
    }

}