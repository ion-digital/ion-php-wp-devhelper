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
    protected static function getContextInstance(int $index = 0) : ?ContextInterface
    {
        if (!array_key_exists(static::class, self::$contextInstances)) {
            return null;
        }
        return self::$contextInstances[static::class][$index];
    }
    protected static final function doUninstall() : void
    {
        static::getContextInstance()->uninstall();
        //        static::getContextInstance()->onUninstalled();
        return;
    }
    private $helperContext = null;
    private $package = null;
    private $contextInstanceIndex = null;
    public function __construct(PackageInterface $package, array $helperSettings = null, callable $onConstruct = null, callable $onConstructed = null, callable $onInitialize = null, callable $onInitialized = null, callable $onFinalize = null)
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
        })->finalize(function (HelperContextInterface $context) use($onFinalize) {
            if ($onFinalize !== null) {
                $onFinalize($this);
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
    public final function getHelperContext() : HelperContextInterface
    {
        if ($this->helperContext === null) {
            throw new WordPressHelperException("Context is not initialized yet.");
        }
        return $this->helperContext;
    }
    public final function getPackage() : PackageInterface
    {
        if ($this->package === null) {
            throw new WordPressHelperException("Context is not initialized yet.");
        }
        return $this->package;
    }
    protected function construct() : void
    {
        // Empty, for now...
    }
    protected function initialize() : void
    {
        // Empty, for now...
    }
    protected function activate() : void
    {
        // Empty, for now...
    }
    protected function deactivate() : void
    {
        // Empty, for now...
    }
    protected function uninstall() : void
    {
        // Empty, for now...
    }
}