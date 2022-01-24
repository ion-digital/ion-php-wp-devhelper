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
use ion\PhpHelper as PHP;
use ion\WordPress\WordPressHelper as WP;
use ion\Package;
use ion\PackageInterface;
trait ContextTrait
{
    private static $contextInstances = [];
    /**
     * method
     * 
     * 
     * @return ?ContextInterface
     */
    protected static function getContextInstance(int $index = 0) : ?ContextInterface
    {
        if (!array_key_exists(static::class, self::$contextInstances)) {
            return null;
        }
        return self::$contextInstances[static::class][$index];
    }
    /**
     * method
     * 
     * @return void
     */
    protected static final function doUninstall() : void
    {
        static::getContextInstance()->uninstall();
        //        static::getContextInstance()->onUninstalled();
        return;
    }
    private $helperContext = null;
    private $package = null;
    private $contextInstanceIndex = null;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function __construct(PackageInterface $package, array $helperSettings = null, callable $onConstructed = null, callable $onInitialized = null)
    {
        if (!array_key_exists(static::class, self::$contextInstances)) {
            self::$contextInstances[static::class] = [];
        }
        $this->contextInstanceIndex = PHP::count(self::$contextInstances[static::class]);
        self::$contextInstances[static::class][] = $this;
        $this->package = $package;
        $helper = WP::createContext($package->getVendor(), $package->getProject(), $package->getProjectEntry(), null, $helperSettings);
        $this->helperContext = $helper->getContext();
        $helper->construct(function (HelperContextInterface $context) use($onConstructed) {
            $this->construct();
            if ($onConstructed !== null) {
                $onConstructed($this);
            }
            return;
        })->initialize(function (HelperContextInterface $context) use($onInitialized) {
            $this->initialize();
            if ($onInitialized !== null) {
                $onInitialized($this);
            }
            return;
        })->activate(function (HelperContextInterface $context) {
            $this->activate();
            return;
        })->deactivate(function (HelperContextInterface $context) {
            $this->deactivate();
            return;
        })->uninstall([static::class, 'doUninstall']);
    }
    /**
     * method
     * 
     * @return HelperContextInterface
     */
    public final function getHelperContext() : HelperContextInterface
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
    public final function getPackage() : PackageInterface
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
    protected function construct() : void
    {
        // Empty, for now...
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
    protected function activate() : void
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
    protected function uninstall() : void
    {
        // Empty, for now...
    }
}