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
    protected static function getContextInstance(int $index = 0)
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
    protected static final function doUninstall()
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
    public function __construct(PackageInterface $package, array $helperSettings = null, callable $onConstruct = null, callable $onConstructed = null, callable $onInitialize = null, callable $onInitialized = null, callable $onFinalize = null, callable $onFinalized = null)
    {
        if (!array_key_exists(static::class, self::$contextInstances)) {
            self::$contextInstances[static::class] = [];
        }
        $this->contextInstanceIndex = PHP::count(self::$contextInstances[static::class]);
        self::$contextInstances[static::class][] = $this;
        $this->package = $package;
        $helper = WP::createContext($package->getVendor(), $package->getProject(), $package->getProjectEntry(), null, $helperSettings);
        $this->helperContext = $helper->getContext();
        $helper->construct(function (HelperContextInterface $context) use($onConstruct, $onConstructed) {
            if ($onConstruct !== null) {
                $onConstruct($this);
            }
            $this->construct();
            if ($onConstructed !== null) {
                $onConstructed($this);
            }
            return;
        })->initialize(function (HelperContextInterface $context) use($onInitialize, $onInitialized) {
            if ($onInitialize !== null) {
                $onInitialize($this);
            }
            $this->initialize();
            if ($onInitialized !== null) {
                $onInitialized($this);
            }
            return;
        })->finalize(function (HelperContextInterface $context) use($onFinalize, $onFinalized) {
            if ($onFinalize !== null) {
                $onFinalize($this);
            }
            $this->finalize();
            if ($onFinalized !== null) {
                $onFinalized($this);
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
    protected function construct()
    {
        // Empty, for now...
    }
    /**
     * method
     * 
     * @return void
     */
    protected function initialize()
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
    protected function deactivate()
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
}