<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper;

/**
 * Description of WordPressBackEndPage
 *
 * @author Justus
 */

use \ion\WordPress\WordPressHelper;

class AdminMenuPageHelper implements AdminMenuPageHelperInterface {

    private static function createSubMenuPageDescriptor(/* string */ $title, callable &$content, /* string */ $id = null, /* string */ $menuTitle = null, /* string */ $capability = null): array {

        //WordPressHelper::registerView($content);
        
        return [
            "pageTitle" => $title,
            "menuTitle" => $menuTitle !== null ? $menuTitle : $title,
            "menuSlug" => $id !== null ? WordPressHelper::slugify($id) : ( $menuTitle !== null ? WordPressHelper::slugify($menuTitle) : WordPressHelper::slugify($title) ),
            "capability" => $capability,
            "content" => $content,
            "html" => null,
            "render" => true,
            "tabs" => []
        ];
    }
    
    private $parent;
    private $parentIndex;
    

    public function __construct(array &$parent, int $parentIndex = null) {
        $this->parent = &$parent;
        
        if($parentIndex === null) {
            $parentIndex = count($this->parent) - 1;
        }
        
        $this->parentIndex = $parentIndex;
    }

    
    private function createSubMenuPage(array &$array, /* string */ $title, callable $content, /* string */ $id = null, /* string */ $menuTitle = null, /* string */ $capability = null): array {
        if ($capability === null) {
            if (array_key_exists("capability", $this->parent)) {
                $capability = $this->parent["capability"];
            } else {
                $capability = Constants::DEFAULT_CAPABILITY;
            }
        }

        if ($content === null) {
            $content = $id . ".php";
        }
        
        $instance = static::createSubMenuPageDescriptor($title, $content, $id, $menuTitle, $capability);
        
        $array[] = $instance;
        
        return $instance;
    }
    
    public function addSubMenuPage(string $title, callable $content, string $id = null, string $menuTitle = null, string $capability = null): AdminMenuPageHelperInterface {
        $subMenus = &$this->parent[$this->parentIndex]["subMenus"];

        $this->createSubMenuPage($subMenus, $title, $content, $id, $menuTitle, $capability);        
        
        return new static($this->parent, null);
    }
    
    public function addSubMenuPageTab(string $title, callable $content, string $id = null, string $menuTitle = null, string $capability = null): AdminMenuPageHelperInterface {              
        $menuPage = &$this->parent[$this->parentIndex];
        $subMenuPage = &$menuPage["subMenus"][count($menuPage["subMenus"]) - 1]["tabs"];

        $instance = $this->createSubMenuPage($subMenuPage, $title, $content, $id, $menuTitle, $capability);

//        if($id == 'ion-about') {
//            
//            echo "<pre>";
//            var_dump($subMenuPage);
//            echo "</pre>";
//        }        
        
        return new static($this->parent, null);
    }    
    
}
