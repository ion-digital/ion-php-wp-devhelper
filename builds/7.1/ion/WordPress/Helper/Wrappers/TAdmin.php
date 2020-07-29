<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

use Throwable;
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
use ion\WordPress\Helper\IAdminFormHelper;
use ion\WordPress\Helper\IAdminTableHelper;
use ion\WordPress\Helper\IAdminMenuPageHelper;
use ion\WordPress\Helper\AdminFormHelper;
use ion\WordPress\Helper\AdminTableHelper;
use ion\WordPress\Helper\AdminMenuPageHelper;
use ion\WordPress\Helper\AdminNavMenuEditWalker;
//use \ion\WordPress\WordPressHelper AS WP;
use ion\WordPress\Helper\WordPressHelperException;
/**
 * Description of BackEndTables
 *
 * @author Justus
 */
trait TAdmin
{
    private static $notices = [];
    private static $tables = [];
    private static $forms = [];
    private static $settingsMetaBoxes = [];
    private static $settingsTermFieldBoxes = [];
    private static $settingsUserFieldBoxes = [];
    private static $settingsMenuFields = [];
    private static $settingsMenus = [];
    private static $pageActions = [];
    private static $currentAdminPage = null;
    /**
     * method
     * 
     * @return mixed
     */
    
    protected static function initialize_TAdmin()
    {
        if (!static::isAdmin()) {
            return;
        }
        static::registerWrapperAction('admin_body_class', function (string $classes = '') {
            $page = filter_input(INPUT_GET, 'page', FILTER_DEFAULT);
            $form = filter_input(INPUT_GET, 'form', FILTER_DEFAULT);
            if ($form !== null) {
                $form = ' ' . $form;
            }
            return "wp-devhelper {$page}{$form}{$classes}";
        }, 0, true);
        static::registerWrapperAction('wp_update_nav_menu_item', function (int $menuId) {
            //edit-menu-item-{$field['name']}
            foreach (static::$settingsMenuFields as $menuName => $fields) {
                foreach ($fields as $field) {
                    $key = "menu-item-{$field['name']}";
                    if (!array_key_exists("menu-item-db-id", $_REQUEST)) {
                        break;
                    }
                    foreach ($_REQUEST["menu-item-db-id"] as $i => $v) {
                        static::removeOption($field['name'], (int) $i);
                    }
                    if (!array_key_exists($key, $_REQUEST)) {
                        continue;
                    }
                    if (is_array($_REQUEST[$key])) {
                        foreach ($_REQUEST[$key] as $wpItemId => $value) {
                            if (!PHP::isEmpty($value)) {
                                static::setOption($field['name'], $value, $wpItemId, null, true);
                            }
                        }
                    }
                }
            }
        }, 10);
        static::registerWrapperAction('add_meta_boxes', function () {
            $cb = null;
            foreach (static::$settingsMetaBoxes as $metaBox) {
                $cb = function () {
                    /* empty! */
                };
                if (array_key_exists('html', $metaBox) && $metaBox['html'] !== null) {
                    $cb = function () use($metaBox) {
                        echo $metaBox['html'];
                    };
                } else {
                    if (array_key_exists('content', $metaBox) && $metaBox['content'] !== null) {
                        $cb = $metaBox['content'];
                    }
                }
                add_meta_box($metaBox["id"], $metaBox["title"], $cb, $metaBox['screen'], $metaBox["context"], $metaBox["priority"], null);
            }
        });
        //        static::registerWrapperAction('admin_init', function() {
        //
        //            foreach (static::getTables() as $table) {
        //
        //                $table->process();
        //            }
        //
        //            foreach (static::getForms() as $form) {
        //
        //                add_action('admin_post_' . Constants::FORM_ACTION_PREFIX . '_' . $form->getId(), function () use ($form) {
        //
        //                    $form->process(null, null);
        //                });
        //            }
        //
        //            add_filter('wp_edit_nav_menu_walker', function() {
        //
        //                return AdminNavMenuEditWalker::class;
        //
        //            }, 10, 3);
        //
        //        });
        //        if(static::isAdmin()) {
        static::registerWrapperAction('admin_init', function () {
            // Run through each settings menu and metabox to trigger any registrations of forms, etc.
            foreach (static::$settingsMenus as $settingsMenu) {
                static::$currentAdminPage = $settingsMenu['menuSlug'];
                if ($settingsMenu['render'] === true) {
                    if ($settingsMenu['content'] !== null && is_callable($settingsMenu['content'])) {
                        ob_start();
                        $settingsMenu['content'](false);
                        ob_end_clean();
                    }
                    //exit;
                    if (key_exists("subMenus", $settingsMenu) && count($settingsMenu["subMenus"]) > 0) {
                        $settingsSubMenus = $settingsMenu["subMenus"];
                        foreach ($settingsSubMenus as $position => $settingsSubMenu) {
                            static::$currentAdminPage = $settingsSubMenu['menuSlug'];
                            //echo($settingsSubMenu['menuSlug']);
                            if ($settingsSubMenu['render'] === true) {
                                //if ($settingsMenu["menuSlug"] !== $settingsSubMenu["menuSlug"]) {
                                if ($settingsSubMenu['content'] !== null && is_callable($settingsSubMenu['content'])) {
                                    ob_start();
                                    //                                            $settingsSubMenu['content']();
                                    //                                            $settingsSubMenu['html'] = ob_get_clean();
                                    $settingsSubMenu['content'](false);
                                    ob_end_clean();
                                }
                                foreach ($settingsSubMenu['tabs'] as $settingsTab) {
                                    if ($settingsTab['content'] !== null && is_callable($settingsTab['content'])) {
                                        ob_start();
                                        $settingsTab['content'](false);
                                        ob_end_clean();
                                    }
                                }
                                //}
                            }
                        }
                        static::$currentAdminPage = null;
                        //TODO: $_GET['page']?
                    }
                }
            }
            //die("B");
            // Metaboxes
            foreach (static::$settingsMetaBoxes as $metaBox) {
                if ($metaBox['render'] === true) {
                    if ($metaBox['content'] !== null && is_callable($metaBox['content'])) {
                        ob_start();
                        $metaBox['content'](false);
                        ob_end_clean();
                    }
                }
            }
            // Term fields
            foreach (static::$settingsTermFieldBoxes as $termFieldBox) {
                if ($termFieldBox['render'] === true) {
                    if ($termFieldBox['content'] !== null && is_callable($termFieldBox['content'])) {
                        ob_start();
                        $termFieldBox['content'](false);
                        ob_end_clean();
                    }
                }
            }
            // User fields
            foreach (static::$settingsUserFieldBoxes as $userFieldBox) {
                if ($userFieldBox['render'] === true) {
                    if ($userFieldBox['content'] !== null && is_callable($userFieldBox['content'])) {
                        ob_start();
                        $userFieldBox['content'](false);
                        ob_end_clean();
                    }
                }
            }
            //echo "<pre>";
            //                foreach (static::getTables() as $table) {
            //
            //                    $table->process();
            //
            //                    if($table->getDescriptor()['detailView'] !== null && is_callable($table->getDescriptor()['detailView'])) {
            //
            //                        ob_start();
            //                        $table->getDescriptor()['detailView'](false);
            //                        ob_end_clean();
            //                    }
            //
            //                }
            //                add_action('admin_post', function() {
            //
            //                    die('admin_post');
            //                });
            $postHooks = [];
            $postAdmin = PHP::toBool(PHP::filterInput('__postAdmin', [INPUT_POST], FILTER_VALIDATE_BOOLEAN)) === true;
            foreach (static::getForms() as $form) {
                $hookName = 'admin_post_' . Constants::FORM_ACTION_PREFIX . '_' . $form->getId();
                add_action($hookName, function () use($form) {
                    $form->process(null, null);
                });
                //var_Dump();
                if (static::isDebugMode() && $postAdmin) {
                    $postHooks[] = $hookName;
                }
                //                    var_Dump($form->getId());
            }
            if (static::isDebugMode()) {
                $uri = parse_url(PHP::getServerRequestUri(), PHP_URL_PATH);
                if (!PHP::isEmpty($uri)) {
                    $pathInfo = pathinfo($uri, PATHINFO_BASENAME);
                    $action = PHP::filterInput('action', [INPUT_GET, INPUT_POST]);
                    $form = PHP::filterInput('form', [INPUT_GET, INPUT_POST]);
                    if (!PHP::isEmpty($pathInfo) && $pathInfo === 'admin-post.php') {
                        if (!in_array("admin_post_{$action}", $postHooks) && $postAdmin || !static::hasAction("admin_post_nopriv_{$action}") && !$postAdmin) {
                            $error = '';
                            $error .= "<h1>No 'admin_post" . ($postAdmin ? "" : "_nopriv") . "_*' hook specified for action</h1>";
                            $error .= "<h2>Action</h2>";
                            $error .= PHP::isEmpty($action) ? "<em>Missing!</em>" : $action;
                            if ($postAdmin) {
                                $error .= "<h2>Form</h2>";
                                $error .= PHP::isEmpty($form) ? "<em>Missing!</em>" : $form;
                                $error .= "<h2>Registered Forms</h2><ul>";
                                foreach (static::getForms() as $form) {
                                    $error .= "<li>{$form->getId()}</li>\n";
                                }
                                $error .= "</ul>";
                                $error .= "<h2>Processed Admin Form Hooks</h2>";
                                if (PHP::count($postHooks) === 0) {
                                    $error .= "None!";
                                } else {
                                    $error .= "<ul>";
                                    foreach ($postHooks as $postHook) {
                                        $error .= "<li>{$postHook}</li>\n";
                                    }
                                    $error .= "</ul>";
                                }
                            }
                            $error .= "<h2>Registered Hooks</h2>";
                            if (PHP::count(static::$formActions) === 0) {
                                $error .= "None!";
                            } else {
                                $error .= "<ul>";
                                foreach (static::$formActions as $postHook) {
                                    if ($postHook['frontEnd'] && !$postAdmin) {
                                        $error .= "<li>admin_post_nopriv_{$postHook['name']}</li>\n";
                                        continue;
                                    }
                                    if ($postHook['backEnd'] && $postAdmin) {
                                        $error .= "<li>admin_post_{$postHook['name']}</li>\n";
                                    }
                                }
                                $error .= "</ul>";
                            }
                            $error .= "<h2>\$_POST</h2><pre>";
                            $error .= PHP::obGet(function () {
                                var_dump($_POST);
                            });
                            $error .= "</pre><h2>\$_GET</h2><pre>";
                            $error .= PHP::obGet(function () {
                                var_dump($_GET);
                            });
                            $error .= "</pre>";
                            wp_die($error);
                        }
                    }
                }
            }
            //die("</pre>");
            add_filter('wp_edit_nav_menu_walker', function () {
                return AdminNavMenuEditWalker::class;
            }, 10, 3);
        }, 5);
        //        }
        static::registerWrapperAction('admin_menu', function () {
            foreach (static::$settingsMenus as $settingsMenu) {
                if ($settingsMenu['render'] === true) {
                    $content = static::renderSubMenuPage($settingsMenu);
                    //$settingsMenu["menuSlug"]
                    global $admin_page_hooks;
                    if ($settingsMenu['system'] === false && !array_key_exists($settingsMenu["menuSlug"], $admin_page_hooks)) {
                        add_menu_page($settingsMenu["pageTitle"], $settingsMenu["menuTitle"], $settingsMenu["capability"], $settingsMenu["menuSlug"], $content, $settingsMenu["iconUrl"], $settingsMenu["position"]);
                    }
                    if (key_exists("subMenus", $settingsMenu) && count($settingsMenu["subMenus"]) > 0) {
                        $settingsSubMenus = $settingsMenu["subMenus"];
                        foreach ($settingsSubMenus as $position => $settingsSubMenu) {
                            if ($settingsSubMenu['render'] === true) {
                                if ($settingsMenu["menuSlug"] !== $settingsSubMenu["menuSlug"]) {
                                    $content = static::renderSubMenuPage($settingsSubMenu);
                                }
                                add_submenu_page($settingsMenu["menuSlug"], $settingsSubMenu["pageTitle"], $settingsSubMenu["menuTitle"], $settingsSubMenu["capability"], $settingsSubMenu["menuSlug"], $content);
                            }
                        }
                    }
                }
            }
            // Metaboxes
            foreach (static::$settingsMetaBoxes as $metaBox) {
                if ($metaBox['render'] === true) {
                    if ($metaBox['content'] !== null && is_callable($metaBox['content'])) {
                        ob_start();
                        $metaBox['content'](true);
                        $metaBox['html'] = ob_get_clean();
                    }
                }
            }
            // Term fields
            foreach (static::$settingsTermFieldBoxes as $termFieldBox) {
                if ($termFieldBox['render'] === true) {
                    if ($termFieldBox['content'] !== null && is_callable($termFieldBox['content'])) {
                        ob_start();
                        $termFieldBox['content'](true);
                        $termFieldBox['html'] = ob_get_clean();
                    }
                }
                $cb = function () {
                    /* empty! */
                };
                if (array_key_exists('html', $termFieldBox) && $termFieldBox['html'] !== null) {
                    $cb = function () use($termFieldBox) {
                        echo $termFieldBox['html'];
                    };
                } else {
                    if (array_key_exists('content', $termFieldBox) && $termFieldBox['content'] !== null) {
                        $cb = $termFieldBox['content'];
                    }
                }
                foreach ($termFieldBox['terms'] as $term) {
                    add_action($term . '_add_form_fields', function (string $taxonomy) use($termFieldBox, $cb) {
                        $cb($taxonomy);
                    });
                    add_action($term . '_edit_form_fields', function (WP_Term $term, string $taxonomy = null) use($termFieldBox, $cb) {
                        $cb($term, $taxonomy);
                    });
                    add_action('edited_' . $term, function (int $termId) {
                        foreach (static::$forms as $form) {
                            $form->process($termId, new OptionMetaType(OptionMetaType::TERM));
                        }
                    });
                    add_action('create_' . $term, function (int $termId) {
                        foreach (static::$forms as $form) {
                            $form->process($termId, new OptionMetaType(OptionMetaType::TERM));
                        }
                    });
                    //                        add_action('delete_' . $term, function(int $termId) {
                    //
                    //                            static::removeOption($key, $termId, OptionMetaType::TERM());
                    //                        });
                }
            }
            // User fields
            foreach (static::$settingsUserFieldBoxes as $userFieldBox) {
                if ($userFieldBox['render'] === true) {
                    if ($userFieldBox['content'] !== null && is_callable($userFieldBox['content'])) {
                        ob_start();
                        $userFieldBox['content'](true);
                        $userFieldBox['html'] = ob_get_clean();
                    }
                }
                $cb = function () {
                    /* empty! */
                };
                if (array_key_exists('html', $userFieldBox) && $userFieldBox['html'] !== null) {
                    $cb = function () use($userFieldBox) {
                        echo $userFieldBox['html'];
                    };
                } else {
                    if (array_key_exists('content', $userFieldBox) && $userFieldBox['content'] !== null) {
                        $cb = $userFieldBox['content'];
                    }
                }
                if ($userFieldBox['visibleToOthers'] === true) {
                    add_action('edit_user_profile', function (WP_User $user) use($userFieldBox, $cb) {
                        // Show for all users EXCEPT the current user
                        $cb($user);
                    });
                    add_action('edit_user_profile_update', function (int $userId) {
                        foreach (static::$forms as $form) {
                            $form->process($userId, new OptionMetaType(OptionMetaType::USER));
                        }
                    });
                }
                if ($userFieldBox['visibleToSelf'] === true) {
                    add_action('show_user_profile', function (WP_User $user) use($userFieldBox, $cb) {
                        // Show only for the current user
                        $cb($user);
                    });
                    add_action('personal_options_update', function (int $userId) {
                        foreach (static::$forms as $form) {
                            $form->process($userId, new OptionMetaType(OptionMetaType::USER));
                        }
                    });
                }
                //                        add_action('delete_' . $term, function(int $termId) {
                //
                //                            static::removeOption($key, $termId, OptionMetaType::TERM());
                //                        });
            }
        });
        static::registerWrapperAction('pre_post_update', function (int $postId, array $data = []) {
            //                die('initialize_TAdmin');
            foreach (static::$forms as $form) {
                //                var_Dump($form);
                $form->process($postId, new OptionMetaType(OptionMetaType::POST));
            }
            //            die("die(): " . __FILE__ . " " . __LINE__);
        });
    }
    
    /**
     * method
     * 
     * @return array
     */
    
    public static function getForms() : array
    {
        return static::$forms;
    }
    
    /**
     * method
     * 
     * @return array
     */
    
    public static function getTables() : array
    {
        return static::$tables;
    }
    
    /**
     * method
     * 
     * @return array
     */
    
    public static function getMenuFields() : array
    {
        return static::$settingsMenuFields;
    }
    
    /**
     * method
     * 
     * @return array
     */
    
    public static function getPageActions() : array
    {
        return static::$pageActions;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    protected static function tableColumn(string $type, string $label, string $htmlCellTemplate, callable $inputField, string $name = null, string $id = null, bool $sortable = true, callable $load = null) : array
    {
        $name = $name !== null ? $name : static::slugify($label);
        $id = ($id !== null ? $id : $name) . '-column';
        $column = ['type' => $type, "id" => $id, "name" => $name, "label" => $label, "sortable" => $sortable, "html" => null, "inputField" => null, "load" => $load !== null ? $load : function ($value = null) {
            return $value;
        }];
        $column["html"] = function ($value = null) use($htmlCellTemplate, $column) {
            $column["value"] = $column['load']($value);
            return static::applyTemplate($htmlCellTemplate, $column);
        };
        $column["inputField"] = function ($value = null) use($inputField, $column) {
            $inputField($column, $value);
        };
        return $column;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function textTableColumn(string $label, string $name = null, string $id = null, bool $sortable = true) : array
    {
        $htmlCellTemplate = "<span>{value}</span>";
        return static::tableColumn('Text', $label, $htmlCellTemplate, function ($column, $value = null) {
        }, $name, $id, $sortable, function ($value = null) {
            if ($value === null) {
                return '-';
            }
            return $value;
        });
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function checkBoxTableColumn(string $label, string $name = null, string $id = null, bool $sortable = true) : array
    {
        $htmlCellTemplate = '<input type="checkbox" disabled value="{value}" {checked}/>';
        $column = static::tableColumn('CheckBox', $label, $htmlCellTemplate, function ($column, $value = null) {
            //TODO
        }, $name, $id, $sortable);
        $column["html"] = function ($value = null) use($htmlCellTemplate, $column) {
            $column["value"] = $column['load']($value);
            $tmp = filter_var($value, FILTER_VALIDATE_BOOLEAN);
            if ($value !== null) {
                if ($tmp === true) {
                    return static::applyTemplate($htmlCellTemplate, ['checked' => 'checked' . ' ']);
                }
            }
            return static::applyTemplate($htmlCellTemplate, ['checked' => '']);
        };
        return $column;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function referenceTableColumn(string $label, array $values, string $name = null, string $id = null, bool $sortable = true) : array
    {
        $htmlCellTemplate = "<span>{value}</span>";
        return static::tableColumn('Reference', $label, $htmlCellTemplate, function ($column, $value = null) use($values) {
        }, $name, $id, $sortable, function ($value = null) use($values) {
            $tmp = [];
            foreach ($values as $k => $v) {
                $tmp[(string) $v] = $k;
            }
            //                    echo "<pre>";
            //                    var_dump($value);
            //                    echo "</pre>";
            //                    exit;
            if ($value === null || $value !== null && !array_key_exists($value, $tmp)) {
                return '-';
            }
            return $tmp[(string) $value];
        });
    }
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    public static function getAdminMenuPage($id)
    {
        $index = 0;
        foreach (static::$settingsMenus as $settingsMenu) {
            if ($settingsMenu['menuSlug'] == $id) {
                break;
            }
            $index++;
        }
        if ($index >= count(static::$settingsMenus)) {
            return null;
        }
        return new AdminMenuPageHelper(static::$settingsMenus, $index);
    }
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    private static function renderSubMenuPage(array &$settingsMenuDescriptor)
    {
        return function () use($settingsMenuDescriptor) {
            //                $output = $output->Append(S::From("<a href=\"?page=" . $settingsItem->GetId() . "&form=" . $form->GetId() . "\" class=\"nav-tab" . $current . "\">" . $this->Translate($form->GetShortCaption()) . "</a>"));
            //
            //if ($settingsForm->GetActions() !== null) {
            //    if ($settingsForm->GetActions()->HasValue(I::From(DataAction::Create))->IsTrue()) {
            //        $output = $output->Append(S::From("<a class=\"add-new-h2\" href=\"" . WordPressListTable::GetListAction(S::From("edit")) . "\">" . $this->Translate(S::From("Add New")) . "</a>"));
            //    }
            //}
            //
            //$output = $output->Append(S::From("</h2>"));
            $tmp = $settingsMenuDescriptor;
            if (array_key_exists("subMenus", $tmp) !== false) {
                foreach ($tmp['subMenus'] as $subMenu) {
                    if (array_key_exists("menuSlug", $subMenu) !== false && $subMenu['menuSlug'] == $tmp['menuSlug']) {
                        $tmp = $subMenu;
                    }
                }
            }
            $hasTabs = !(array_key_exists("tabs", $tmp) === false) || array_key_exists("tabs", $tmp) === true && count($tmp["tabs"]) === 0;
            $pageTitle = $tmp["pageTitle"];
            echo '<div class="wrap' . ($hasTabs ? ' tabbed' : '') . '">';
            echo "<h1" . ($hasTabs ? " class=\"wp-heading-inline\">" : "") . $pageTitle . "</h1>";
            //            echo "<pre>";
            //            var_dump(static::getPageActions());
            //            echo "</pre>";
            foreach (static::getPageActions() as $page => $action) {
                if ($page == $tmp['menuSlug']) {
                    $caption = $action['caption'];
                    $uri = $action['uri'];
                    echo '<a href="' . $uri . '" class="page-title-action">' . $caption . '</a>';
                }
            }
            if (!$hasTabs) {
                if (array_key_exists('html', $tmp) === true && $tmp['html'] !== null) {
                    echo $tmp['html'];
                } else {
                    $tmp["content"](true);
                }
                //$settingsMenuDescriptor["content"]();
            } else {
                $tabs = [];
                $currentTabIndex = 0;
                $i = 1;
                $tabs[] =& $tmp;
                foreach ($tmp["tabs"] as &$tab) {
                    $tabs[] = $tab;
                    $formGetParm = filter_input(INPUT_GET, "form", FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
                    if ($formGetParm !== null && trim($tab["menuSlug"]) == trim($formGetParm)) {
                        $currentTabIndex = $i;
                    }
                    //echo "[" . $tab["menuSlug"] . "] = [$formGetParm] = [" . (trim($tab["menuSlug"]) === trim($formGetParm)) .  "]<br /><br />";
                    $i++;
                }
                $currentTab =& $tabs[$currentTabIndex];
                echo <<<TEMPLATE
    <h2 class="nav-tab-wrapper">
TEMPLATE;
                $page = $tmp["menuSlug"];
                for ($t = 0; $t < count($tabs); $t++) {
                    $tab = $tabs[$t];
                    $form = null;
                    if ($t > 0) {
                        $form = $tab["menuSlug"];
                    }
                    $currentClass = "";
                    if ($t === $currentTabIndex) {
                        $currentClass = " nav-tab-active";
                    }
                    $menuTitle = $tab["menuTitle"];
                    if ($form === null) {
                        echo <<<TEMPLATE
            <a href="?page={$page}" class="nav-tab{$currentClass}">{$menuTitle}</a>
TEMPLATE;
                    } else {
                        echo <<<TEMPLATE
            <a href="?page={$page}&form={$form}" class="nav-tab{$currentClass}">{$menuTitle}</a>
TEMPLATE;
                    }
                }
                echo <<<TEMPLATE
    </h2>

TEMPLATE;
                //echo '<pre>'; var_dump($currentTab); '</pre>';
                if (array_key_exists('html', $currentTab) === true && $currentTab['html'] !== null) {
                    echo $currentTab['html'];
                } else {
                    $currentTab["content"](true);
                }
                //$currentTab["content"]();
            }
            foreach (static::$notices as $notice) {
                echo $notice;
            }
            echo <<<TEMPLATE
</div>
TEMPLATE;
        };
    }
    
    /**
     * method
     * 
     * 
     * @return IAdminMenuPageHelper
     */
    
    public static function addAdminMenuPage(string $title, callable $content, string $menuTitle = null, string $id = null, string $capability = null, string $iconUrl = null, int $position = null) : IAdminMenuPageHelper
    {
        //static::registerView($content);
        static::$settingsMenus[] = ["pageTitle" => $title, "menuTitle" => $menuTitle !== null ? $menuTitle : $title, "menuSlug" => $id !== null ? $id : ($menuTitle !== null ? WordPressHelper::slugify($menuTitle) : WordPressHelper::slugify($title)), "capability" => $capability !== null ? $capability : Constants::DEFAULT_CAPABILITY, "content" => $content, "html" => null, "iconUrl" => $iconUrl, "position" => $position, "system" => false, "render" => true, "subMenus" => []];
        return new AdminMenuPageHelper(static::$settingsMenus, null);
    }
    
    //    public static function getDashboardBackEndMenuPage(): IAdminMenuPageHelper {
    //        return $this->getAdminMenuPage('index.php');
    //    }
    //
    //    public static function getPostsBackEndMenuPage(): IAdminMenuPageHelper {
    //        return $this->getAdminMenuPage('edit.php');
    //    }
    //
    //    public static function getMediaBackEndMenuPage(): IAdminMenuPageHelper {
    //        return $this->getAdminMenuPage('upload.php');
    //    }
    //
    //    public static function getCommentsBackEndMenuPage(): IAdminMenuPageHelper {
    //        return $this->getAdminMenuPage('edit-comments.php');
    //    }
    //
    //    public static function getAppearanceBackEndMenuPage(): IAdminMenuPageHelper {
    //        return $this->getAdminMenuPage('themes.php');
    //    }
    //
    //    public static function getPluginsBackEndMenuPage(): IAdminMenuPageHelper {
    //        return $this->getAdminMenuPage('plugins.php');
    //    }
    //
    //    public static function getPagesBackEndMenuPage(): IAdminMenuPageHelper {
    //        return $this->getAdminMenuPage('edit.php?post_type=page');
    //    }
    //
    //    public static function getUsersBackEndMenuPage(): IAdminMenuPageHelper {
    //        return $this->getAdminMenuPage('users.php');
    //    }
    //
    //    public static function getToolsBackEndMenuPage(): IAdminMenuPageHelper {
    //        return $this->getAdminMenuPage('tools.php');
    //    }
    //
    //    public static function getSettingsBackEndMenuPage(): IAdminMenuPageHelper {
    //        return $this->getAdminMenuPage('options-general.php');
    //    }
    //
    //    public static function getNetworkBackEndMenuPage(): IAdminMenuPageHelper {
    //        return $this->getAdminMenuPage('settings.php');
    //    }
    //
    //    public static function getCustomPostBackEndMenuPage(string $postType): IAdminMenuPageHelper {
    //        return $this->getAdminMenuPage('edit.php?post_type=' . $postType);
    //    }
    /**
     * method
     * 
     * 
     * @return IAdminMenuPageHelper
     */
    
    public static function addPlugInAdminMenuPage(string $title, callable $content, string $menuTitle = null, string $id = null, string $iconUrl = null, int $position = null) : IAdminMenuPageHelper
    {
        return static::addAdminMenuPage($title, $content, $menuTitle, $id, Constants::DEFAULT_PLUGIN_CAPABILITY, $iconUrl, $position);
    }
    
    /**
     * method
     * 
     * 
     * @return IAdminMenuPageHelper
     */
    
    public static function addThemeAdminMenuPage(string $title, callable $content, string $menuTitle = null, string $id = null, string $iconUrl = null, int $position = null) : IAdminMenuPageHelper
    {
        return static::addAdminMenuPage($title, $content, $menuTitle, $id, Constants::DEFAULT_THEME_CAPABILITY, $iconUrl, $position);
    }
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    public static function addPostAdminMetaBox(string $title, callable $content, string $id, string $context = "advanced", string $priority = "high") : void
    {
        static::addAdminMetaBox($id, $title, $content, ["post"], $context, $priority);
        return;
    }
    
    /**
     * method
     * 
     * 
     * @return IAdminFormHelper
     */
    
    public static function addAdminForm(string $title, string $id, string $action = null, int $columns = 1, bool $hideKey = true) : IAdminFormHelper
    {
        //        if($id !== null) {
        //
        //            echo "<pre>";
        //            debug_print_backtrace();
        //            die("\n\nID used! " . PHP::getCallingClass() . " :: " . PHP::getCallingPath() . "</pre>");
        //        }
        //$tmp = md5(PHP::count(static::$forms));
        $tmp = $id;
        /*
        if($tmp === null) {
        
        //            $lookBack = 1;
        //            
        //            if(AdminTableHelper::inDetailMode()) {
        //                
        //                $lookBack = 2;
        //            }
            
        //            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        //            
        //            if(AdminTableHelper::inDetailMode()) {
        //                
        //                $tmp =  $trace[PHP::count($trace) - $lookBack]['file'] . '___line_' . $trace[PHP::count($trace) - $lookBack]['line']; // . '___instance_' . PHP::count(static::$forms);        
        //                
        //            } else {
        //
        //                $tmp =  $trace[PHP::count($trace) - $lookBack]['file'] . '___line_' . $trace[PHP::count($trace) - $lookBack]['line'] . '___instance_' . PHP::count(static::$forms);        
        //            }
        
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
            
            $tmp =  'class__' . $trace[1]['class'] .
                    '___function__' . $trace[1]['function'] . 
                    '___line__' . $trace[1]['line'] .
                    '___file__' . $trace[1]['file'];
            
            $tmp = str_replace(' ' , '_', $tmp);
            $tmp = str_replace(DIRECTORY_SEPARATOR , '_', $tmp);
            $tmp = str_replace('.' , '_', $tmp);
            
            if(!static::isDebugMode()) {
                
                $tmp = md5($tmp);
            }
            
        //            if(AdminTableHelper::inDetailMode()) {
        //                
        //                echo "<pre>";
        //                echo "$tmp\n\n";
        //                var_Dump($trace);
        //                die("</pre>");
        //            }
        }
        */
        //TODO: See if the form has already been registered? If we don't, you might register a form... and nothing gets updated when you save it (and you can't figure out why - wahy).
        foreach (static::$forms as $form) {
            //            var_dump($form);
            //            exit;
            if ($form->getId() == $tmp) {
                //TODO: This causes some weird behaviour at the moment... but should really be here to prevent duplicate forms.
                throw new WordPressHelperException("Form '{$tmp}' has already been defined - please specify a different form ID.");
            }
        }
        $descriptor = ["id" => $tmp, "title" => $title, "action" => $action, "notices" => static::$notices, "columns" => $columns, "html" => null, "hideKey" => $hideKey, "groups" => [AdminFormHelper::createGroupDescriptorInstance()]];
        $form = new AdminFormHelper($descriptor);
        static::$forms[] = $form;
        //        echo '<pre>';
        //        echo 'XXX';
        //        var_dump($this->forms);
        //        echo '</pre>';
        //echo $descriptor['id'] . '<br />';
        //exit;
        return $form;
    }
    
    /**
     * method
     * 
     * 
     * @return IAdminTableHelper
     */
    
    public static function addAdminTable(string $title, string $id = null, string $singularItemName = "Item", string $pluralItemName = "Items", string $keyColumnId = null, callable $detailView = null, bool $allowNew = false, bool $allowDelete = false, bool $allowEdit = false, array $additionalActions = null, bool $ajax = false) : IAdminTableHelper
    {
        $id = $id !== null ? $id : static::slugify($title);
        $descriptor = ['id' => $id, 'title' => $title, 'singular' => $singularItemName, 'plural' => $pluralItemName, 'key' => $keyColumnId, 'allowNew' => $allowNew, 'allowDelete' => $allowDelete, 'allowEdit' => $allowEdit, 'detailView' => $detailView, 'additionalActions' => $additionalActions, 'ajax' => $ajax];
        $table = new AdminTableHelper($descriptor);
        static::$tables[] = $table;
        return $table;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    protected static function inputField(string $type, string $label, string $htmlTemplate, string $name = null, string $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, callable $validator = null, bool $echo = false) : array
    {
        $name = $name !== null ? $name : static::slugify($label);
        $id = $id !== null ? $id : static::slugify($name) . '-field';
        if ($validator === null) {
            $validator = function ($value = null) {
                return true;
            };
        }
        $field = [
            'type' => $type,
            "label" => $label,
            "name" => $name,
            "value" => $value,
            "id" => $id,
            "hint" => $hint,
            "html" => null,
            "span" => $span,
            'readOnly' => $readOnly,
            'disabled' => $disabled,
            'hidden' => false,
            //TODO: reorganise parameters
            "post" => function ($postValue = null) {
                return $postValue;
            },
            "load" => function ($dbValue = null) {
                return $dbValue;
            },
            "validate" => $validator,
        ];
        $field["html"] = function (string $value = null, $keyName = null, $keyValue = null, string $nameOverride = null, string $idOverride = null) use($htmlTemplate, $field) {
            // The following values are NOT applied to the field array - they are temporarily modified here
            $field["value"] = htmlentities($value);
            $field['disabled'] = $field['disabled'] === true ? ' disabled' : '';
            $field['readOnly'] = $field['readOnly'] === true ? ' readonly' : '';
            if ($nameOverride !== null) {
                $field['name'] = $nameOverride;
            }
            if ($idOverride !== null) {
                $field['id'] = $idOverride;
            }
            return static::applyTemplate($htmlTemplate, $field);
        };
        if ($echo === true) {
            echo $field["html"]($value);
        }
        return $field;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function hiddenInputField(string $name, string $value = null, string $id = null, bool $echo = false) : array
    {
        $htmlTemplate = "<input type=\"hidden\" id=\"{id}\" name=\"{name}\" value=\"{value}\"/>";
        $field = static::inputField(
            'Hidden',
            $name,
            $htmlTemplate,
            $name,
            $value,
            $id,
            //$id
            null,
            //$hint,
            false,
            //$span,
            false,
            //$readOnly,
            false,
            //$disabled,
            null,
            $echo
        );
        $field['hidden'] = true;
        $field['post'] = function (string $postValue = null) use($value) {
            if ($value !== null) {
                return (string) $value;
            }
            return (string) $postValue;
        };
        $field['load"'] = function (string $dbValue = null) use($value) {
            if ($value !== null) {
                return (string) $value;
            }
            return (string) $dbValue;
        };
        return $field;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function numberInputField(string $label, string $name = null, float $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array
    {
        $htmlTemplate = "<input type=\"number\" id=\"{id}\" name=\"{name}\" value=\"{value}\" class=\"regular-text\"{readOnly}{disabled}/>";
        $field = static::inputField('Number', $label, $htmlTemplate, $name, $value, $id, $hint, $span, $readOnly, $disabled, null, $echo);
        $field['post'] = function (string $postValue = null) use($value) {
            if ($value !== null) {
                return (int) $value;
            }
            return (int) $postValue;
        };
        $field['load"'] = function (int $dbValue = null) use($value) {
            if ($value !== null) {
                return (int) $value;
            }
            return (int) $dbValue;
        };
        return $field;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function textInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $multiLine = false, bool $fancy = false, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array
    {
        if ($multiLine === false) {
            $htmlTemplate = "<input type=\"text\" id=\"{id}\" name=\"{name}\" value=\"{value}\" class=\"regular-text\"{readOnly}{disabled}/>";
            return static::inputField('Text', $label, $htmlTemplate, $name, $value, $id, $hint, $span, $readOnly, $disabled, null, $echo);
        }
        $name = $name !== null ? $name : static::slugify($label);
        $id = $id !== null ? $id : static::slugify($name) . '-field';
        $field = ['type' => 'MultiLineText', "label" => $label, "name" => $name, "id" => $id, "hint" => $hint, "html" => null, "span" => $span, 'readOnly' => $readOnly, 'disabled' => $disabled, "fancy" => $fancy, "post" => function ($postValue = null) {
            return (string) $postValue;
        }, "load" => function ($dbValue = null) {
            return (string) $dbValue;
        }, "validate" => function ($value = null) {
            return true;
        }];
        $field["html"] = function ($value = null, $keyName = null, $keyValue = null, string $nameOverride = null, string $idOverride = null) use($field, $fancy, $id) {
            if ($nameOverride !== null) {
                $field['name'] = $nameOverride;
            }
            if ($idOverride !== null) {
                $field['id'] = $idOverride;
            }
            if ($fancy === false) {
                // The following values are NOT applied to the field array - they are temporarily modified here
                $field["value"] = $value;
                $field['disabled'] = $field['disabled'] === true ? ' disabled' : '';
                $field['readOnly'] = $field['readOnly'] === true ? ' readonly' : '';
                $htmlTemplate = "<textarea type=\"text\" id=\"{id}\" name=\"{name}\" aria-described-by=\"{id}-hint\" class=\"wp-editor-area\"{readOnly}{disabled}>{value}</textarea>";
                return static::applyTemplate($htmlTemplate, $field);
            } else {
                ob_start();
                wp_editor($value === null ? '' : $value, $field['id'], ['textarea_name' => $field['name']]);
                $output = ob_get_clean();
                //$output = "EDITOR";
                return $output;
            }
        };
        if ($echo === true) {
            echo $field["html"]($value);
        }
        return $field;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function dropDownListInputField(string $label, array $values, string $name = null, string $value = null, string $id = null, string $hint = null, string $emptyMessage = null, callable $modifyValues = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array
    {
        $name = $name !== null ? $name : static::slugify($label);
        $id = $id !== null ? $id : static::slugify($name) . '-field';
        $field = ['type' => 'DropDown', "label" => $label, "name" => $name, "id" => $id, "hint" => $hint, "html" => null, "span" => $span, 'readOnly' => $readOnly, 'disabled' => $disabled, "post" => function (string $postValue = null) {
            if ($postValue === null || $postValue === '') {
                return null;
            }
            return (string) $postValue;
        }, "load" => function (string $dbValue = null) {
            if ($dbValue === null) {
                return null;
            }
            return (string) $dbValue;
        }, "validate" => function (string $value = null) {
            return true;
        }];
        $field["html"] = function ($value = null, string $keyName = null, string $keyValue = null, string $nameOverride = null, string $idOverride = null) use($field, $values, $emptyMessage, $modifyValues) {
            // The following values are NOT applied to the field array - they are temporarily modified here
            $field['disabled'] = $field['disabled'] === true ? ' disabled' : '';
            $field['readOnly'] = $field['readOnly'] === true ? ' readonly' : '';
            if ($nameOverride !== null) {
                $field['name'] = $nameOverride;
                $field['id'] = $idOverride;
            }
            $optionsHtmlTemplate = "\n";
            if ($modifyValues !== null) {
                $tmp = $modifyValues($values, $keyName, $keyValue, $value);
                if (is_array($tmp)) {
                    $values = $tmp;
                }
            }
            if (count($values) > 0) {
                foreach ($values as $key => $selectValue) {
                    if (is_array($selectValue) === true) {
                        $optionsHtmlTemplate .= "<optgroup label=\"{$key}\">\n";
                        foreach ($selectValue as $valueKey => $valueValue) {
                            $tmp = '';
                            if ($valueValue !== null) {
                                $tmp = $valueValue;
                            }
                            // NOTE: The string-only comparison below
                            $optionsHtmlTemplate .= "<option value=\"{$tmp}\"" . ((string) $valueValue === (string) $value ? " selected" : "") . ">{$valueKey}</option>\n";
                        }
                        $optionsHtmlTemplate .= "</optgroup>\n";
                    } else {
                        $tmp = '';
                        if ($selectValue !== null) {
                            $tmp = $selectValue;
                        }
                        // NOTE: The string-only comparison below
                        $optionsHtmlTemplate .= "<option value=\"{$tmp}\"" . ((string) $selectValue === (string) $value ? " selected" : "") . ">{$key}</option>\n";
                    }
                }
                $htmlTemplate = "<select type=\"text\" id=\"{id}\" name=\"{name}\" aria-described-by=\"{id}-hint\"{readOnly}{disabled}>{$optionsHtmlTemplate}</select>";
                return static::applyTemplate($htmlTemplate, $field);
            }
            if ($emptyMessage === null) {
                $emptyMessage = 'No items';
            }
            $emptyMessage = trim($emptyMessage);
            if (strlen($emptyMessage) > 0) {
                $emptyMessage = "<strong><em>{$emptyMessage}</em></strong>";
            }
            return $emptyMessage;
        };
        if ($echo === true) {
            echo $field["html"]($value);
        }
        return $field;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function listInputField(string $label, array $values, string $name = null, array $value = null, string $id = null, string $hint = null, string $emptyMessage = null, callable $modifyValues = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array
    {
        $name = $name !== null ? $name : static::slugify($label);
        $id = $id !== null ? $id : static::slugify($name) . '-field';
        $field = ['type' => 'List', "label" => $label, "name" => $name, "id" => $id, "hint" => $hint, "html" => null, "span" => $span, 'readOnly' => $readOnly, "disabled" => $disabled, "post" => function ($postValue = null) {
            $arrayValue = [];
            if (!PHP::isEmpty($postValue)) {
                if (PHP::isString($postValue)) {
                    $arrayValue = @unserialize($postValue);
                } else {
                    if (PHP::isArray($postValue)) {
                        $arrayValue = $postValue;
                    }
                }
            }
            return array_values($arrayValue);
        }, "load" => function ($dbValue = null) {
            $arrayValue = [];
            if (!PHP::isEmpty($dbValue)) {
                if (PHP::isString($dbValue)) {
                    $arrayValue = @unserialize($dbValue);
                } else {
                    if (PHP::isArray($dbValue)) {
                        $arrayValue = $dbValue;
                    }
                }
            }
            return array_values($arrayValue);
        }, "validate" => function ($value = null) {
            return true;
        }];
        $field["html"] = function ($value, $keyName = null, $keyValue = null, string $nameOverride = null, string $idOverride = null) use($field, $values, $emptyMessage, $modifyValues) {
            // The following values are NOT applied to the field array - they are temporarily modified here
            $field['disabled'] = $field['disabled'] === true ? ' disabled' : '';
            $field['readOnly'] = $field['readOnly'] === true ? ' readonly' : '';
            if ($nameOverride !== null) {
                $field['name'] = $nameOverride;
                $field['id'] = $idOverride;
            }
            $arrayValue = $value;
            if (!PHP::isArray($arrayValue)) {
                $arrayValue = [];
                if (PHP::isString($arrayValue)) {
                    $arrayValue = @unserialize($arrayValue);
                }
            }
            //            echo '<pre>';
            //            var_dump($arrayValue);
            //            die('</pre>');
            $optionsHtmlTemplate = "\n";
            if ($modifyValues !== null) {
                $tmp = $modifyValues($values, $keyName, $keyValue, $arrayValue);
                if (PHP::isArray($tmp)) {
                    $values = $tmp;
                }
            }
            if (count($values) > 0 || $emptyMessage === null) {
                $cnt = 0;
                foreach ($values as $key => $selectValue) {
                    if (is_array($selectValue) === true) {
                        $optionsHtmlTemplate .= "<optgroup label=\"{$key}\">\n";
                        foreach ($selectValue as $valueKey => $valueValue) {
                            $optionsHtmlTemplate .= "<option value=\"{$valueValue}\"" . (in_array($valueValue, $arrayValue) ? " selected" : "") . ">{$valueKey}</option>\n";
                            $cnt++;
                        }
                        $optionsHtmlTemplate .= "</optgroup>\n";
                    } else {
                        $optionsHtmlTemplate .= "<option value=\"{$selectValue}\"" . (in_array($selectValue, $arrayValue) ? " selected" : "") . ">{$key}</option>\n";
                    }
                    $cnt++;
                }
                $size = $cnt > 5 ? 5 : $cnt;
                $htmlTemplate = "<select multiple size=\"{$size}\" type=\"text\" id=\"{id}\" name=\"{name}[]\" aria-described-by=\"{id}-hint\"{readOnly}{disabled}>{$optionsHtmlTemplate}</select>";
                return static::applyTemplate($htmlTemplate, $field);
            }
            $emptyMessage = trim($emptyMessage);
            if (strlen($emptyMessage) === 0) {
                $emptyMessage = "<strong><em>{$emptyMessage}</em></strong>";
            }
            return $emptyMessage;
        };
        if ($echo === true) {
            echo $field["html"]($value);
        }
        return $field;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function colourPickerInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array
    {
        // http://www.eyecon.ro/colorpicker/
        $htmlTemplate = <<<TEMPLATE
<div id="{id}-colour-preview" class="wp-devhelper-colorpicker" style="background-color:#{value};"></div>
<input type="hidden" id="{id}" name="{name}" value="{value}" />
<script type="text/javascript">
(function() {
    var inputElement = jQuery('#{id}').get(0);
    var previewElement = jQuery('#{id}-colour-preview').get(0);
    jQuery(previewElement).ColorPicker({ 
        flat: false, 
        livePreview: true ,
        onSubmit: function(hsb, hex, rgb) {
            jQuery(inputElement).val(hex);
            jQuery(previewElement).css({ "background-color": "#" + hex });
        },
        onBeforeShow: function () {
            if(inputElement.value != null)    
                jQuery(this).ColorPickerSetColor("#" + inputElement.value);
                
            jQuery(previewElement).css({ "background-color": "#" + this.value });
        }
    });
})();
</script>
TEMPLATE;
        return static::inputField('ColourPicker', $label, $htmlTemplate, $name, $value, $id, $hint, $span, $readOnly, $disabled, $echo);
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function checkBoxInputField(string $label, string $name = null, bool $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array
    {
        $name = $name !== null ? $name : static::slugify($label);
        $id = $id !== null ? $id : static::slugify($name) . '-field';
        $field = ['type' => 'CheckBox', "label" => $label, "name" => $name, "id" => $id, "hint" => $hint, "html" => null, "span" => $span, 'readOnly' => $readOnly, 'disabled' => $disabled, "post" => function ($postValue = null) {
            //                if (strtolower($postValue) === "on") {
            //
            //                    return true;
            //                }
            return filter_var($postValue, FILTER_VALIDATE_BOOLEAN);
        }, "load" => function ($dbValue = null) {
            return filter_var($dbValue, FILTER_VALIDATE_BOOLEAN);
        }, "validate" => function ($value = null) {
            return true;
        }];
        $field["html"] = function ($value = null, $keyName = null, $keyValue = null, string $nameOverride = null, string $idOverride = null) use($field) {
            // The following values are NOT applied to the field array - they are temporarily modified here
            $field['disabled'] = $field['disabled'] === true ? ' disabled' : '';
            $field['readOnly'] = $field['readOnly'] === true ? ' readonly' : '';
            if ($nameOverride !== null) {
                $field['name'] = $nameOverride;
                $field['id'] = $idOverride;
            }
            $field['checked'] = '';
            if ($value !== null && (bool) $value === true) {
                $field['checked'] = ' checked';
            }
            $htmlTemplate = "<input type=\"checkbox\" id=\"{id}\" name=\"{name}\" {checked}{readOnly}{disabled}/>";
            return static::applyTemplate($htmlTemplate, $field);
        };
        if ($echo === true) {
            echo $field["html"]($value);
        }
        return $field;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function dateTimeInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $datePicker = true, bool $timePicker = true, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array
    {
        // https://xdsoft.net/jqplugins/datetimepicker/
        $datePickerValue = $datePicker === true ? 'true' : 'false';
        $timePickerValue = $timePicker === true ? 'true' : 'false';
        $format = '';
        if ($datePicker === true) {
            $format .= 'Y-m-d';
        }
        if ($timePicker === true) {
            $format .= ' H:i';
        }
        $format = trim($format);
        $htmlTemplate = <<<TEMPLATE
<input type="text" id="{id}" name="{name}" value="{value}" {readOnly}{disabled} />
<script type="text/javascript">
(function() {
    var inputElement = jQuery('#{id}').get(0);
    jQuery(inputElement).datetimepicker({
        format: '{$format}',
        datepicker: {$datePickerValue},
        timepicker: {$timePickerValue},
        mask: true
    });
})();
</script>
TEMPLATE;
        //FIXME: No validator - double check if we need one.
        $field = static::inputField('DateTime', $label, $htmlTemplate, $name, null, $id, $hint, $span, $readOnly, $disabled, null, $echo);
        $field['post'] = function (string $postValue = null) {
            return (int) strtotime($postValue);
        };
        $field["load"] = function ($dbValue = null) use($timePicker, $datePicker) {
            $value = '';
            $date = date_i18n('Y-m-d', (int) $dbValue);
            $time = date_i18n('H:i', (int) $dbValue);
            if ($datePicker) {
                $value = (string) $date;
                if ($timePicker) {
                    $value .= ' ';
                }
            }
            if ($timePicker) {
                $value .= $time;
            }
            //            var_dump($value);
            //            die('X');
            return $value;
        };
        $field['validate'] = function ($value = null) {
            return true;
        };
        return $field;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function dateInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array
    {
        $field = static::dateTimeInputField($label, $name, $value, $id, $hint, true, false, $span, $readOnly, $disabled, $echo);
        return $field;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function timeInputField(string $label, string $name = null, string $value = null, string $id = null, string $hint = null, bool $span = false, bool $readOnly = false, bool $disabled = false, bool $echo = false) : array
    {
        $field = static::dateTimeInputField($label, $name, $value, $id, $hint, false, true, $span, $readOnly, $disabled, $echo);
        return $field;
    }
    
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public static function button(string $label, string $id = null, string $hint = null, IAdminFormHelper $form = null, bool $span = false, bool $disabled = false, string $javaScript = null, bool $echo = true) : array
    {
        $id = $id !== null ? $id : static::slugify($label) . '-field';
        $button = ['type' => 'Button', "label" => $label, "id" => $id, "hint" => $hint, "javascript" => $javaScript, "html" => null, "form" => $form, "span" => $span, "disabled" => $disabled, "formId" => $form === null ? null : $form->getId()];
        $button["html"] = function ($value = null, $keyName = null, $keyValue = null, string $nameOverride = null) use($button, $form, $javaScript, $id) {
            // The following values are NOT applied to the field array - they are temporarily modified here
            $button['disabled'] = $button['disabled'] === true ? ' disabled' : '';
            if ($nameOverride !== null) {
                $button['name'] = $nameOverride;
                $button['id'] = $id;
            }
            $htmlTemplate = '<button type="button" id="{id}" {disabled} class="button"';
            if ($form !== null) {
                $htmlTemplate .= ' form="{formId}"';
            } else {
                if ($javaScript !== null) {
                    $htmlTemplate .= ' onclick="{__onClick}"';
                }
            }
            $htmlTemplate .= '>{label}</button>';
            return PHP::strReplaceAll(["\t", "\n", '  '], ' ', static::applyTemplate($htmlTemplate, array_merge($button, ['__onClick' => <<<JS
if(\$wp_helper_admin) {
                
    \$wp_helper_admin.ajax('{$id}', 
        function(data, textStatus, jqXhr) {
            
            {$javaScript} 
        }, 
        function(jqXhr, textStatus, errorThrown) {
            
            \$wp_helper_admin.showError(errorThrown); 
        }
    ); 
} 
else { 
    console.log('\$wp_helper_admin not defined.'); 
}
JS
])));
        };
        if ($echo === true) {
            echo $button["html"]();
        }
        return $button;
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function notify(string $message, string $notice = "notice-info", bool $dismissable = false, bool $echo = false) : string
    {
        $s = "<div class=\"notice notice-{$notice}" . ($dismissable === true ? " is-dismissable" : "") . "\"><p>{$message}</p></div>";
        static::$notices[] = $s;
        if ($echo === true) {
            echo $s;
        }
        //        add_action("admin_notices", function() use ($s) {
        //            echo $s;
        //        });
        return $s;
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function notifyError(string $message, bool $echo = false) : string
    {
        return static::notify($message, "error", false, $echo);
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function notifyInfo(string $message, bool $echo = false) : string
    {
        return static::notify($message, "info", true, $echo);
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function notifySuccess(string $message, bool $echo = false) : string
    {
        return static::notify($message, "success", true, $echo);
    }
    
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public static function notifyWarning(string $message, bool $echo = false) : string
    {
        return static::notify($message, "warning", true, $echo);
    }
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    public static function addAdminMetaBox(string $id, string $title, callable $content, array $screen = ['post'], string $context = 'advanced', string $priority = 'default') : void
    {
        static::$settingsMetaBoxes[] = ["id" => $id, "title" => $title, "content" => $content, "screen" => $screen, "context" => $context, "priority" => $priority, "render" => true, "forms" => [], "html" => null];
    }
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    public static function addAdminTermFieldBox(string $id, string $title, callable $content, array $terms = []) : void
    {
        static::$settingsTermFieldBoxes[] = ["id" => $id, "title" => $title, "content" => $content, "terms" => $terms, "render" => true, "html" => null];
    }
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    public static function addAdminUserFieldBox(string $id, string $title, callable $content, bool $visibleToSelf = true, bool $visibleToOthers = false) : void
    {
        static::$settingsUserFieldBoxes[] = ["id" => $id, "title" => $title, 'visibleToSelf' => $visibleToSelf, 'visibleToOthers' => $visibleToOthers, "content" => $content, "render" => true, "html" => null];
    }
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    private static function addSystemAdminMenuPage(string $id)
    {
        static::$settingsMenus[] = ["pageTitle" => null, "menuTitle" => null, "menuSlug" => $id, "capability" => null, "content" => null, "html" => null, "iconUrl" => null, "position" => null, "system" => true, "render" => true, "subMenus" => []];
    }
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    public static function addAdminMenuField(array $fieldDescriptor, string $menuId = null) : void
    {
        $key = $menuId === null ? '' : $menuId;
        if (!array_key_exists($key, static::$settingsMenuFields)) {
            static::$settingsMenuFields[$key] = [];
        }
        static::$settingsMenuFields[$key][] = $fieldDescriptor;
        return;
    }
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    public static function addAdminPageAction(string $page, string $caption, string $uri) : void
    {
        if (array_key_exists($page, static::$pageActions)) {
            return;
        }
        //echo "addPageAction[$page][$caption]<br />";
        static::$pageActions[$page] = ['caption' => $caption, 'uri' => $uri];
        return;
    }
    
    /**
     * method
     * 
     * @return ?string
     */
    
    public static function getCurrentAdminPage() : ?string
    {
        return static::$currentAdminPage;
    }
    
    /**
     * method
     * 
     * @return ?string
     */
    
    public static function getCurrentAdminObjectType() : ?string
    {
        if (!WP::isAdmin()) {
            return null;
        }
        global $pagenow;
        if (PHP::isEmpty($pagenow)) {
            return null;
        }
        if ($pagenow == 'post.php') {
            return WP_Post::class;
        }
        if ($pagenow == 'term.php') {
            return WP_Term::class;
        }
        if ($pagenow == 'profile.php' || $pagenow == 'user-edit.php') {
            return WP_User::class;
        }
        if ($pagenow == 'comment.php') {
            return WP_Comment::class;
        }
        return null;
    }
    
    /**
     * method
     * 
     * @return ?int
     */
    
    public static function getCurrentAdminObjectId() : ?int
    {
        if (!WP::isAdmin()) {
            return null;
        }
        if (static::getCurrentAdminObjectType() == WP_Post::class) {
            return PHP::toInt(PHP::filterInput('post', [INPUT_GET], FILTER_VALIDATE_INT));
        }
        if (static::getCurrentAdminObjectType() == WP_Term::class) {
            return PHP::toInt(PHP::filterInput('tag_ID', [INPUT_GET], FILTER_VALIDATE_INT));
        }
        if (static::getCurrentAdminObjectType() == WP_User::class) {
            global $pagenow;
            if ($pagenow == 'profile.php') {
                return PHP::toInt(get_current_user_id());
            }
            return PHP::toInt(PHP::filterInput('user_id', [INPUT_GET], FILTER_VALIDATE_INT));
        }
        if (static::getCurrentAdminObjectType() == WP_Comment::class) {
            return PHP::toInt(PHP::filterInput('c', [INPUT_GET], FILTER_VALIDATE_INT));
        }
        return null;
    }
    
    /**
     * method
     * 
     * @return ?object
     */
    
    public static function getCurrentAdminObject()
    {
        if (!WP::isAdmin()) {
            return null;
        }
        if (static::getCurrentAdminObjectId() === null) {
            return null;
        }
        if (static::getCurrentAdminObjectType() == WP_Post::class) {
            return PHP::toNull(get_post(static::getCurrentAdminObjectId()));
        }
        if (static::getCurrentAdminObjectType() == WP_Term::class) {
            return PHP::toNull(get_term(static::getCurrentAdminObjectId()));
        }
        if (static::getCurrentAdminObjectType() == WP_User::class) {
            return PHP::toNull(get_userdata(static::getCurrentAdminObjectId()));
        }
        if (static::getCurrentAdminObjectType() == WP_Comment::class) {
            return PHP::toNull(get_comment(static::getCurrentAdminObjectId()));
        }
        return null;
    }

}