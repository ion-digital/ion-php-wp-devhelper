<?php
namespace ion\WordPress\Helper\Wrappers;

use ion\WordPress\Helper\WordPressWidgetInterface;
use ion\WordPress\Helper\Wrappers\WP_Query;
/**
 * Description of RewriteApiTrait*
 * @author Justus
 */
interface TemplateInterface
{
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function isFrontPage($postId = null);
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function isPostsPage($postId = null);
    /**
     * method
     * 
     * @return bool
     */
    static function isBlogPage();
    /**
     * method
     * 
     * @return ?object
     */
    static function getUriObject();
    /**
     * method
     * 
     * @return ?int
     */
    static function getUriPostId();
    /**
     * method
     * 
     * @return bool
     */
    static function isPage();
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function isPost($name = null);
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function isCategory($name = null);
    /**
     * method
     * 
     * @return bool
     */
    static function isArchive();
    /**
     * method
     * 
     * 
     * @return string
     */
    static function theLoop(callable $generator = null, $limit = null, $emptyText = null, $echo = false);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function title($echo = true);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function content($echo = true);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addMenu($id, $description = null);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function menu($id, $template = null, $menuId = null, $depth = 0, $echo = false);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function siteLink(array $controllers = null, array $parameters = null, $absolute = true, $echo = true);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function widget(WordPressWidgetInterface $widget, array $values = null, $beforeWidget = null, $afterWidget = null, $beforeTitle = null, $afterTitle = null, $echo = true);
    /**
     * method
     * 
     * 
     * @return string
     */
    static function sideBar($id, $echo = true);
    /**
     * method
     * 
     * @return bool
     */
    static function isPaginated();
    /**
     * method
     * 
     * @return int
     */
    static function getCurrentPage();
    /**
     * method
     * 
     * 
     * @return array
     */
    static function getPageLinks($prevNext = false, $prevText = null, $nextText = null);
    /**
     * method
     * 
     * @return array
     */
    static function getSearchTerms();
    /**
     * method
     * 
     * @return int
     */
    static function getPostsPerPage();
    /**
     * method
     * 
     * 
     * @return int
     */
    static function getTotalPostCount(WP_Query $wpQuery = null);
    /**
     * method
     * 
     * 
     * @return ?object
     */
    static function getCurrentTemplateObject($subject = false);
    /**
     * method
     * 
     * 
     * @return ?string
     */
    static function getCurrentTemplateObjectType($subject = false);
    /**
     * method
     * 
     * 
     * @return ?int
     */
    static function getCurrentTemplateObjectId($subject = false);
}