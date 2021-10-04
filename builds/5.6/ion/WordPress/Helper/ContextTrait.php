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
trait ContextTrait
{
    private static $contextInstances = [];
    /**
     * method
     * 
     * @return ?ContextInterface
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
    protected final function __construct_ContextTrait(PackageInterface $package, array $helperSettings = null)
    {
        //        if(static::getContextInstance() === null) {
        //
        //            throw new WordPressHelperException("Context is not initialized yet.")
        //        }
        self::$contextInstances[static::class] = $this;
        $this->package = $package;
        $helper = WP::createContext($package->getVendor(), $package->getProject(), $package->getProjectEntry(), null, $helperSettings);
        $this->helperContext = $helper->getContext();
        $helper->initialize(function (HelperContextInterface $context) {
            $this->initialize();
            $this->onInitialized();
            return;
        })->activate(function (HelperContextInterface $context) {
            $this->activate();
            $this->onActivated();
            return;
        })->deactivate(function (HelperContextInterface $context) {
            $this->deactivate();
            $this->onDeactivated();
            return;
        })->uninstall([static::class, 'doUninstall'])->finalize(function (HelperContextInterface $context) {
            $this->finalize();
            //$this->onFinalized();
            return;
        });
    }
    /**
     * method
     * 
     * @return HelperContextInterface
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
     * @return PackageInterface
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