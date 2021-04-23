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
use ion\WordPress\WordPressHelper;
class AdminMenuPageHelper implements IAdminMenuPageHelper
{
    /**
     * method
     * 
     * 
     * @return array
     */
    private static function createSubMenuPageDescriptor($title, callable &$content, $id = null, $menuTitle = null, $capability = null)
    {
        //WordPressHelper::registerView($content);
        return ["pageTitle" => $title, "menuTitle" => $menuTitle !== null ? $menuTitle : $title, "menuSlug" => $id !== null ? WordPressHelper::slugify($id) : ($menuTitle !== null ? WordPressHelper::slugify($menuTitle) : WordPressHelper::slugify($title)), "capability" => $capability, "content" => $content, "html" => null, "render" => true, "tabs" => []];
    }
    private $parent;
    private $parentIndex;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function __construct(array &$parent, $parentIndex = null)
    {
        $this->parent =& $parent;
        if ($parentIndex === null) {
            $parentIndex = count($this->parent) - 1;
        }
        $this->parentIndex = $parentIndex;
    }
    /**
     * method
     * 
     * 
     * @return array
     */
    private function createSubMenuPage(array &$array, $title, callable $content, $id = null, $menuTitle = null, $capability = null)
    {
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
    /**
     * method
     * 
     * 
     * @return IAdminMenuPageHelper
     */
    public function addSubMenuPage($title, callable $content, $id = null, $menuTitle = null, $capability = null)
    {
        $subMenus =& $this->parent[$this->parentIndex]["subMenus"];
        $this->createSubMenuPage($subMenus, $title, $content, $id, $menuTitle, $capability);
        return new static($this->parent, null);
    }
    /**
     * method
     * 
     * 
     * @return IAdminMenuPageHelper
     */
    public function addSubMenuPageTab($title, callable $content, $id = null, $menuTitle = null, $capability = null)
    {
        $menuPage =& $this->parent[$this->parentIndex];
        $subMenuPage =& $menuPage["subMenus"][count($menuPage["subMenus"]) - 1]["tabs"];
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