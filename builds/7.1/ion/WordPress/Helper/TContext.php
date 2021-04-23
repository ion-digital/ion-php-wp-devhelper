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
trait TContext
{
    private static $contextInstances = [];
    /**
     * method
     * 
     * @return ?IContext
     */
    protected static function getContextInstance() : ?IContext
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
    protected static final function doUninstall() : void
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
            //$this->onFinalized();
            return;
        });
    }
    /**
     * method
     * 
     * @return IHelperContext
     */
    public final function getHelperContext() : IHelperContext
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
    public final function getPackage() : IPackage
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
    protected abstract function initialize() : void;
    /**
     * method
     * 
     * @return void
     */
    protected function onInitialized() : void
    {
        // Empty, for now...
    }
    /**
     * method
     * 
     * @return void
     */
    protected function activate() : void
    {
        // Empty, for now...
    }
    /**
     * method
     * 
     * @return void
     */
    protected function onActivated() : void
    {
        // Empty, for now...
    }
    /**
     * method
     * 
     * @return void
     */
    protected function deactivate() : void
    {
        // Empty, for now...
    }
    /**
     * method
     * 
     * @return void
     */
    protected function onDeactivated() : void
    {
        // Empty, for now...
    }
    /**
     * method
     * 
     * @return void
     */
    protected function uninstall() : void
    {
        // Empty, for now...
    }
    /**
     * method
     * 
     * @return void
     */
    protected function onUninstalled() : void
    {
        // Empty, for now...
    }
    /**
     * method
     * 
     * @return void
     */
    protected function finalize() : void
    {
        // Empty, for now...
    }
}