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

use \Ion\PhpHelper as PHP;
use \Ion\WordPress\WordPressHelper as WP;
use \Ion\Package;
use \Ion\PackageInterface;

trait ContextTrait {
            
    private static $contextInstances = [];
    
    protected static function getContextInstance(int $index = 0): ?ContextInterface {
        
        if(!array_key_exists(static::class, self::$contextInstances)) {
            
            return null;
        }
        
        return self::$contextInstances[static::class][$index];
    }
    
    protected final static function doUninstall(): void {
        
        static::getContextInstance()->uninstall();
//        static::getContextInstance()->onUninstalled();
        return;        
    }    
    
    private $helperContext = null;
    private $package = null;
    private $contextInstanceIndex = null;
    
    public function __construct(
            
        PackageInterface $package,
        array $helperSettings = null,
        callable $onInitialize = null,
        callable $onInitialized = null,
        callable $onFinalize = null
            
    ) {

        if(!array_key_exists(static::class, self::$contextInstances)) {
            
            self::$contextInstances[static::class] = [];
        }
        
        $this->contextInstanceIndex = PHP::count(self::$contextInstances[static::class]);
        self::$contextInstances[static::class][] = $this;        
        
        $this->package = $package;

        $helper = WP::createContext(
                
            $package->getVendor(),
            $package->getProject(),
            $package->getProjectEntry(),
            null,
            $helperSettings
        );
        
        $this->helperContext = $helper->getContext();
                        
        $helper
                
        ->initialize(function(HelperContextInterface $context) use ($onInitialize, $onInitialized) {         
            
            if($onInitialize !== null) {
                
                $onInitialize($this);
            }            
            
            $this->initialize();
            
            if($onInitialized !== null) {
                
                $onInitialized($this);
            }
            
            return;
        })  
        ->finalize(function(HelperContextInterface $context) use ($onFinalize) {         
            
            if($onFinalize !== null) {
                
                $onFinalize($this);
            }            
            
            return;
        })            
        ->activate(function(HelperContextInterface $context) {         
            
            $this->activate();
            return;
        })
        ->deactivate(function(HelperContextInterface $context) {         
            
            $this->deactivate();
            return;
        })
        ->uninstall([ static::class, 'doUninstall' ]);     
    }
    
    final public function getHelperContext(): HelperContextInterface {
        
        if($this->helperContext === null) {
            
            throw new WordPressHelperException("Context is not initialized yet.");
        }
        
        return $this->helperContext;
    }
    
    final public function getPackage(): PackageInterface {
                
        if($this->package === null) {
            
            throw new WordPressHelperException("Context is not initialized yet.");
        }        
        
        return $this->package;
    }
    
    protected function initialize(): void {
        
        // Empty, for now...
    }

    protected function activate(): void {
        
        // Empty, for now...
    }

    protected function deactivate(): void {
        
        // Empty, for now...
    }
    
    protected function uninstall(): void {
        
        // Empty, for now...
    }

}
