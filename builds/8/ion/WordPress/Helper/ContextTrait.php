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

use \ion\WordPress\WordPressHelper as WP;
use \ion\Package;
use \ion\PackageInterface;



trait ContextTrait {
            
    private static $contextInstances = [];
    
    protected static function getContextInstance(): ?ContextInterface {
        
        if(!array_key_exists(static::class, self::$contextInstances)) {
            
            return null;
        }
        
        return self::$contextInstances[static::class];
    }
    
    protected final static function doUninstall(): void {
        
        static::getContextInstance()->uninstall();
        static::getContextInstance()->onUninstalled();
        return;        
    }    
    
    private $helperContext = null;
    private $package = null;
    
    public function __construct(PackageInterface $package, array $helperSettings = null) {
        
//        if(static::getContextInstance() === null) {
//            
//            throw new WordPressHelperException("Context is not initialized yet.")
//        }
        
        self::$contextInstances[static::class] = $this;
        
        $this->package = $package;
        
        $helper = WP::createContext($package->getVendor(), $package->getProject(), $package->getProjectEntry(), null, $helperSettings);
        
        $this->helperContext = $helper->getContext();
                        
        $helper
                
        ->initialize(function(HelperContextInterface$context) {
            
            $this->initialize();      
            $this->onInitialized();
            return;
        })
        ->activate(function(HelperContextInterface$context) {         
            
            $this->activate();
            $this->onActivated();
            return;
        })
        ->deactivate(function(HelperContextInterface$context) {         
            
            $this->deactivate();
            $this->onDeactivated();
            return;
        })
        ->uninstall([ static::class, 'doUninstall' ])      
        ->finalize(function(HelperContextInterface$context) {         
            
            $this->finalize();
            //$this->onFinalized();
            return;
        });
               
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
    
    
    abstract protected function initialize(): void;
    
    protected function onInitialized(): void {
        
        // Empty, for now...
    }
    
    protected function activate(): void {
        
        // Empty, for now...
    }
    
    protected function onActivated(): void {
        
        // Empty, for now...
    }    
    
    protected function deactivate(): void {
        
        // Empty, for now...
    }
    
    protected function onDeactivated(): void {
        
        // Empty, for now...
    }    
    
    protected function uninstall(): void {
        
        // Empty, for now...
    }
    
    protected function onUninstalled(): void {
        
        // Empty, for now...
    }      
    
    protected function finalize(): void {
        
        // Empty, for now...
    }
    
//    protected function onFinalized(): void {
//        
//        // Empty, for now...
//    }      

}
