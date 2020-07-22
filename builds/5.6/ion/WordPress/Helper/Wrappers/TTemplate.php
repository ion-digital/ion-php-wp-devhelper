<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

use \Exception as Throwable;
use WP_Post;
use WP_User;
use WP_Term;
use WP_Comment;
use ion\WordPress\IWordPressHelper;
use ion\WordPress\Helper\Tools;
use ion\WordPress\Helper\Constants;
use ion\PhpHelper as PHP;
use ion\Package;
use ion\ISemVer;
use ion\SemVer;
use ion\WordPress\Helper\IWordPressWidget;
/**
 * Description of TRewriteApi
 *
 * @author Justus
 */
trait TTemplate
{
    private static $menus = [];
    private static $excerptSizes = [];
    private static $excerptSuffix = null;
    /**
     * method
     * 
     * @return mixed
     */
    
    protected static function initialize_TTemplate()
    {
        static::registerWrapperAction('init', function () {
            foreach (static::$menus as $id => $menu) {
                register_nav_menu($id, PHP::isEmpty($menu['description']) ? null : $menu["description"]);
            }
        });
    }
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    public static function isFrontPage($postId = null)
    {
        if ($postId === null) {
            return (bool) is_front_page();
        }
        return PHP::toInt(static::getOption('page_on_front', false, null, null, true)) === $postId;
    }
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    public static function isPostsPage($postId = null)
    {
        if ($postId === null) {
            return (bool) is_home();
        }
        return PHP::toInt(static::getOption('page_for_posts', false, null, null, true)) === $postId;
    }
    
    //Deprecated
    /**
     * method
     * 
     * @return bool
     */
    
    public static function isBlogPage()
    {
        return static::isPostsPage();
    }
    
    /**
     * method
     * 
     * @return ?object
     */
    
    public static function getUriObject()
    {
        $obj = get_queried_object();
        if (PHP::isObject($obj)) {
            return $obj;
        }
        return null;
    }
    
    /**
     * method
     * 
     * @return ?int
     */
    
    public static function getUriPostId()
    {
        $obj = static::getUriObject();
        if ($obj !== null && $obj instanceof WP_Post) {
            return $obj->ID;
        }
        return null;
    }
    
    /**
     * method
     * 
     * @return bool
     */
    
    public static function isPage()
    {
        return static::isPost("page");
    }
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    public static function isPost($name = null)
    {
        if (is_single() && !is_page()) {
            if ($name === null) {
                return true;
            }
            if (get_post_type(get_the_ID()) === (string) $name) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    public static function isCategory($name = null)
    {
        if ($name === null) {
            return (bool) is_category();
        }
        return false;
    }
    
    /**
     * method
     * 
     * @return bool
     */
    
    public static function isArchive()
    {
        return (bool) is_archive();
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function theLoop(callable $generator = null, $limit = null, $emptyText = null, $echo = false)
    {
        $cnt = 0;
        $output = "";
        if (have_posts()) {
            ob_start();
            while (have_posts()) {
                the_post();
                $tmp = null;
                $post = get_post(get_the_ID());
                if ($generator !== null) {
                    $tmp = $generator($post);
                } else {
                    $tmp = function (WP_Post $post) {
                        echo $post->post_content;
                        return true;
                    };
                    $tmp($post);
                }
                if ($tmp === true) {
                    $cnt++;
                }
                if ($limit !== null && $cnt === $limit) {
                    break;
                }
            }
            $output = ob_get_clean();
        }
        if ($cnt === 0) {
            if ($emptyText === null) {
                $emptyText = "<p>Sorry, no posts matched your criteria.</p>";
            }
            $output = $emptyText;
        }
        if ($echo === true) {
            echo $output;
        }
        return $output;
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function title($echo = true)
    {
        $output = "";
        $objId = null;
        $post = get_post();
        if (!empty($post)) {
            $objId = $post->ID;
        } else {
            $objId = get_queried_object_id();
        }
        if ($objId !== null) {
            $output = get_the_title($objId);
        }
        if ($echo === true) {
            echo $output;
        }
        return $output;
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function content($echo = true)
    {
        $output = "";
        $objId = null;
        $post = get_post();
        if (!empty($post)) {
            $objId = $post->ID;
        } else {
            $objId = get_queried_object_id();
        }
        if ($objId !== null) {
            //ob_start();
            //the_content($objId);
            //$output = ob_get_clean();
            //var_dump($post);
            $output = $post->post_content;
            //var_dump($output);
        }
        if ($echo === true) {
            echo $output;
        }
        return $output;
    }
    
    //    public static function excerpt(bool $echo = true, string $excerptSuffix = ' ... ', int $firstSize = 110, int $size = 55) {
    //
    //    }
    /**
     * method
     * 
     * 
     * @return void
     */
    
    public static function addMenu($id, $description = null)
    {
        static::$menus[$id] = ["id" => $id, "description" => $description];
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function menu($id, $template = null, $menuId = null, $depth = 0, $echo = false)
    {
        $slug = static::slugify($id);
        $menu = wp_nav_menu([
            "menu" => $slug,
            "menu_class" => "menu",
            "menu_id" => $menuId !== null ? $menuId : $id,
            "container" => null,
            "container_class" => null,
            "container_id" => null,
            "fallback_cb" => function () {
                // Do nothing! (for now)
            },
            "before" => "\n",
            "after" => "\n",
            "link_before" => "<span>",
            "link_after" => "</span>",
            "echo" => false,
            "depth" => $depth,
            //"walker" =>
            "theme_location" => $id,
            //"items_wrap" => "",
            "item_spacing" => "preserve",
        ]);
        $output = static::applyTemplate($template === null ? "{menu}" : $template, ["menu" => $menu]);
        if ($echo === true) {
            echo $output;
        }
        return $output;
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function siteLink(array $controllers = null, array $parameters = null, $absolute = true, $echo = true)
    {
        $url = static::getSiteLink($controllers, $parameters, $absolute);
        if ($echo === true) {
            echo $url;
        }
        return $url;
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function widget(IWordPressWidget $widget, array $values = null, $beforeWidget = null, $afterWidget = null, $beforeTitle = null, $afterTitle = null, $echo = true)
    {
        $id = $widget->GetId();
        $class = $widget->GetBaseId();
        ob_start();
        $widget->widget(["before_widget" => $beforeWidget === null ? "<div id=\"{$id}\" class=\"widget {$class}\">" : $beforeWidget, "after_widget" => $afterWidget === null ? "</div>\n" : $afterWidget, "before_title" => $beforeTitle === null ? "<h3>" : $beforeTitle, "after_title" => $afterTitle === null ? "</h3>\n" : $afterTitle], $values);
        $output = ob_get_clean();
        if ($echo === true) {
            echo $output;
        }
        return $output;
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function sideBar($id, $echo = true)
    {
        $output = "";
        if (is_active_sidebar($id) === true) {
            if (is_dynamic_sidebar($id)) {
                ob_start();
                dynamic_sidebar($id);
                $output = ob_get_clean();
            }
        }
        if ($echo === true) {
            echo $output;
        }
        return $output;
    }
    
    /**
     * method
     * 
     * @return bool
     */
    
    public static function isPaginated()
    {
        return PHP::count(paginate_links(['type' => 'array', 'prev_next' => false, 'prev_text' => false, 'next_text' => false])) > 1;
    }
    
    /**
     * method
     * 
     * @return int
     */
    
    public static function getCurrentPage()
    {
        $pageIndex = PHP::toInt(get_query_var('paged'));
        if ($pageIndex === null || $pageIndex === 0) {
            return 1;
        }
        return $pageIndex;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function getPageLinks($prevNext = false, $prevText = null, $nextText = null)
    {
        return paginate_links(['type' => 'array', 'prev_next' => $prevNext, 'prev_text' => $prevText === null ? __('« Previous') : $prevText, 'next_text' => $nextText === null ? __('Next »') : $nextText]);
    }
    
    /**
     * method
     * 
     * @return array
     */
    
    public static function getSearchTerms()
    {
        $terms = PHP::toString(PHP::filterInput('s', [INPUT_GET], FILTER_DEFAULT));
        if ($terms === null) {
            return explode('+', $terms);
        }
        return [];
    }
    
    /**
     * method
     * 
     * @return int
     */
    
    public static function getPostsPerPage()
    {
        $tmp = PHP::toInt(get_option('posts_per_page'));
        if ($tmp === null) {
            throw new WordPressHelperException("'posts_per_page' is null?");
        }
        return $tmp;
    }
    
    /**
     * method
     * 
     * 
     * @return int
     */
    
    public static function getTotalPostCount(WP_Query $wpQuery = null)
    {
        global $wp_query;
        if ($wpQuery !== null) {
            $wp_query = $wpQuery;
        }
        return $wp_query->found_posts;
    }
    
    /**
     * method
     * 
     * 
     * @return ?int
     */
    
    public static function getCurrentTemplateObjectId($ignoreTheLoop = false)
    {
        if (WP::isAdmin()) {
            return null;
        }
        if (in_the_loop() && !$ignoreTheLoop) {
            return PHP::toInt(get_the_ID());
        }
        if (is_singular() || static::isPostsPage(null)) {
            return PHP::toInt(get_queried_object_id());
        }
        return null;
    }
    
    /**
     * method
     * 
     * 
     * @return ?string
     */
    
    public static function getCurrentTemplateObjectType($ignoreTheLoop = false)
    {
        if (WP::isAdmin()) {
            return null;
        }
        if (static::getCurrentTemplateObjectId($ignoreTheLoop) === null) {
            return null;
        }
        if (is_singular() || static::isPostsPage(null)) {
            return WP_Post::class;
        }
        return null;
    }
    
    /**
     * method
     * 
     * 
     * @return ?object
     */
    
    public static function getCurrentTemplateObject($ignoreTheLoop = false)
    {
        if (WP::isAdmin()) {
            return null;
        }
        if (static::getCurrentTemplateObjectId($ignoreTheLoop) === null) {
            return null;
        }
        if (static::getCurrentTemplateObjectType($ignoreTheLoop) == WP_Post::class) {
            return PHP::toNull(get_post(static::getCurrentTemplateObjectId($ignoreTheLoop)));
        }
        return null;
    }

}