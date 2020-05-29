<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 * Description of Context
 *
 * @author Justus
 */
use ion\WordPress\WordPressHelper as WP;
use ion\WordPress\IWordPressHelper;
use ion\PhpHelper as PHP;
use ion\ISemVer;
use ion\Types\Arrays\IVector;
use ion\Types\Arrays\Vector;
use ion\Package;
use ion\IObserver;
use ion\IObservable;
use ion\Base;
use ion\Types\Arrays\IMap;
use ion\SemVer;

final class HelperContext extends Base implements IHelperContext, IObserver
{
    use \ion\TObserver;
    const OPTION_ACTIVATION_TIMESTAMP = 'activation-timestamp';
    const OPTION_ACTIVATION_VERSION = 'activation-version';
    /**
     * method
     * 
     * @return void
     */
    
    public static function uninstall()
    {
        // empty for now!
    }
    
    private $finalized = false;
    private $initialized = false;
    private $workingDir = null;
    private $workingUri = null;
    private $loadPath = null;
    private $contextId = null;
    private $contextType = null;
    private $primary = false;
    private $log = null;
    private $version = null;
    private $activationTimeStamp = null;
    private $activationVersion = null;
    private $children = null;
    private $parent = null;
    private $initialize = null;
    private $activate = null;
    private $deactivate = null;
    private $uninstall = null;
    private $finalize = null;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    public final function __construct($vendorName, $projectName, $loadPath, $helperDir = null, array $wpHelperSettings = null, ISemVer $version = null, IHelperContext $parent = null)
    {
        //        $this->setParent($parent);
        $this->setInitializeOperation(function () {
            /* empty for now! */
        });
        $this->setActivateOperation(function () {
            /* empty for now! */
        });
        $this->setDeactivateOperation(function () {
            /* empty for now! */
        });
        $this->setUninstallOperation(null);
        $this->setFinalizeOperation(function () {
            /* empty for now! */
        });
        $workingUri = null;
        $this->children = Vector::create();
        $this->observe($this->children);
        $loadPath = realpath($loadPath);
        if (!is_file($loadPath)) {
            throw new WordPressHelperException("Please specify the entry-point load path filename for this context - __FILE__ should work. It must be either a full path or at least an existing filename (I was looking for '{$loadPath}').");
        }
        $workingDir = $loadPath;
        if (PHP::strEndsWith($loadPath, '.php')) {
            $workingDir = dirname($loadPath);
        }
        $workingDir = DIRECTORY_SEPARATOR . trim($workingDir, '/\\') . DIRECTORY_SEPARATOR;
        if (strpos($workingDir, DIRECTORY_SEPARATOR . WP::getContentDirectory())) {
            $workingUri = get_site_url() . substr($workingDir, strpos($workingDir, DIRECTORY_SEPARATOR . WP::getContentDirectory()));
        } else {
            throw new WordPressHelperException('Could not determine working URI.');
        }
        $this->loadPath = $loadPath;
        $this->workingDir = $workingDir;
        $this->workingUri = $workingUri;
        $this->contextId = PHP::count(array_values(WP::getContexts())) + 1;
        $this->primary = (bool) (!defined(Constants::WP_HELPER));
        if (!defined(Constants::WP_HELPER)) {
            define(Constants::WP_HELPER, Package::getInstance('ion', 'wp-helper')->getVersion()->toString());
        }
        $tmp = array_values(array_filter(explode(DIRECTORY_SEPARATOR, $this->getWorkingDirectory())));
        $this->contextType = strpos($workingDir, DIRECTORY_SEPARATOR . 'themes') ? Constants::CONTEXT_THEME : Constants::CONTEXT_PLUGIN;
        //        $this->contextSlug = static::slugify($projectName);
        $this->contextVendorName = PHP::strToDashedCase($vendorName);
        $this->contextProjectName = PHP::strToDashedCase($projectName);
        if (array_key_exists($this->getPackageName(), WP::getContexts())) {
            $tmp = WP::getContexts()[$this->getPackageName()]->getLoadPath();
            throw new WordPressHelperException("Context '{$this->getPackageName()}' has already been defined in '{$tmp}' - context package names need to be unique.");
        }
        WP::getContexts()[$this->getPackageName()] = $this;
        $aliases = ['wp-helper' => 'WP Helper'];
        if ($this->contextProjectName !== null) {
            $aliases[$this->getPackageName()] = $this->contextProjectName;
        }
        $this->log = WP::registerLog($this->getPackageName(), count($aliases) === 0 ? $this->getPackageName() : (array_key_exists($this->getPackageName(), $aliases) === true ? $aliases[$this->getPackageName()] : $this->getPackageName()));
        if ($version === null) {
            // Try to load the version
            if (Package::hasInstance($this->getVendorName(), $this->getProjectName())) {
                $version = Package::getInstance($this->getVendorName(), $this->getProjectName())->getVersion();
            } else {
                if (file_exists($loadPath) && $this->contextType === Constants::CONTEXT_PLUGIN) {
                    $entryFile = file_get_contents($loadPath);
                    $matches = [];
                    if (preg_match('/Version\\s*:\\s*([0-9]+\\.[0-9]+\\.[0-9]+)\\S*/i', $entryFile, $matches) === 1) {
                        $version = SemVer::parse($matches[1]);
                    }
                }
            }
        }
        $this->version = $version;
    }
    
    /**
     * method
     * 
     * 
     * @return IObserver
     */
    
    public function onAddObserved(IObservable $observable, IMap $data = null)
    {
        if ($observable === $this->children) {
            $obj = $data->get('value');
            if ($obj !== null) {
                $obj->setParent($this);
            }
        }
        return $this;
    }
    
    /**
     * method
     * 
     * @return IWordPressHelperLog
     */
    
    public function getLog()
    {
        return $this->log;
    }
    
    //    public function initialize(callable $call = null): IWordPressHelper {
    //
    //        $this->initialize = $call;
    //        return $this;
    //    }
    //
    //    public function activate(callable $call = null): IWordPressHelper {
    //
    //        $this->activate = $call;
    //        return $this;
    //    }
    //
    //    public function deactivate(callable $call = null): IWordPressHelper {
    //
    //        $this->deactivate = $call;
    //        return $this;
    //    }
    //
    //    public function uninstall(callable $call = null): IWordPressHelper {
    //
    //        $this->uninstall = $call;
    //        return $this;
    //    }
    /**
     * method
     * 
     * @return bool
     */
    
    public function isFinalized()
    {
        return $this->finalized;
    }
    
    /**
     * method
     * 
     * @return bool
     */
    
    public function isInitialized()
    {
        return $this->initialized;
    }
    
    /**
     * method
     * 
     * @return int
     */
    
    public function getId()
    {
        return $this->contextId;
    }
    
    //    public function getSlug(): string {
    //
    //        return $this->contextSlug;
    //    }
    /**
     * method
     * 
     * @return string
     */
    
    public function getPackageName()
    {
        return $this->getVendorName() . '/' . PHP::strToDashedCase($this->getProjectName());
    }
    
    /**
     * method
     * 
     * @return string
     */
    
    public function getVendorName()
    {
        return $this->contextVendorName;
    }
    
    /**
     * method
     * 
     * @return string
     */
    
    public function getProjectName()
    {
        return $this->contextProjectName;
    }
    
    /**
     * method
     * 
     * @return bool
     */
    
    public function isPrimary()
    {
        return (bool) $this->primary;
    }
    
    /**
     * method
     * 
     * 
     * @return callable
     */
    
    public function getView($viewSlug)
    {
        return function () use($viewSlug) {
            //echo "VIEW COMES HERE [$viewSlug]";
            $path = $this->getViewDirectory() . $viewSlug . ".php";
            //die($path . "<br />");
            if (file_exists($path)) {
                // Load the PHP view and strip the PHP tags before
                $view = file_get_contents($path);
                $view = preg_replace("/^(<\\s*\\?(\\s*php)?\\s+)/", "", $view);
                $view = preg_replace("/(\\s*\\?>\\s*)\$/", "", $view);
                //FIXME: Use includes here instead
                ob_start();
                eval($view);
                echo ob_get_clean();
            }
        };
    }
    
    /**
     * method
     * 
     * @return string
     */
    
    public function getWorkingUri()
    {
        return $this->workingUri;
    }
    
    /**
     * method
     * 
     * @return string
     */
    
    public function getWorkingDirectory()
    {
        return $this->workingDir;
    }
    
    /**
     * method
     * 
     * @return string
     */
    
    public function getLoadPath()
    {
        return $this->loadPath;
    }
    
    /**
     * method
     * 
     * @return string
     */
    
    public function getViewDirectory()
    {
        $dirs = ['views/', 'source/views/', 'includes/views/'];
        foreach ($dirs as $subDir) {
            $dir = $this->getWorkingDirectory() . $subDir;
            if (is_dir($dir)) {
                return $dir;
            }
        }
        return $this->getWorkingDirectory();
    }
    
    //    protected function getMainOperation() /* : ?callable */ {
    //        return $this->_getMainOperation();
    //    }
    /**
     * method
     * 
     * @return ?callable
     */
    
    public function getInitializeOperation()
    {
        return $this->initialize;
    }
    
    /**
     * method
     * 
     * @return ?callable
     */
    
    public function getActivateOperation()
    {
        return $this->activate;
    }
    
    /**
     * method
     * 
     * @return ?callable
     */
    
    public function getDeactivateOperation()
    {
        return $this->deactivate;
    }
    
    /**
     * method
     * 
     * @return ?array
     */
    
    public function getUninstallOperation()
    {
        return $this->uninstall;
    }
    
    /**
     * method
     * 
     * @return ?callable
     */
    
    public function getFinalizeOperation()
    {
        return $this->finalize;
    }
    
    /**
     * method
     * 
     * 
     * @return IHelperContext
     */
    
    public function setInitializeOperation(callable $operation = null)
    {
        $this->initialize = $operation;
        return $this;
    }
    
    /**
     * method
     * 
     * 
     * @return IHelperContext
     */
    
    public function setActivateOperation(callable $operation = null)
    {
        $this->activate = $operation;
        return $this;
    }
    
    /**
     * method
     * 
     * 
     * @return IHelperContext
     */
    
    public function setDeactivateOperation(callable $operation = null)
    {
        $this->deactivate = $operation;
        return $this;
    }
    
    /**
     * method
     * 
     * 
     * @return IHelperContext
     */
    
    public function setUninstallOperation(array $operation = null)
    {
        $this->uninstall = $operation;
        return $this;
    }
    
    /**
     * method
     * 
     * 
     * @return ?IHelperContext
     */
    
    public function setFinalizeOperation(callable $operation = null)
    {
        $this->finalize = $operation;
        return $this;
    }
    
    /**
     * method
     * 
     * @return bool
     */
    
    public function hasInitializeOperation()
    {
        return $this->getInitializeOperation() !== null;
    }
    
    /**
     * method
     * 
     * @return bool
     */
    
    public function hasActivateOperation()
    {
        return $this->getActivateOperation() !== null;
    }
    
    /**
     * method
     * 
     * @return bool
     */
    
    public function hasDeactivateOperation()
    {
        return $this->getDeactivateOperation() !== null;
    }
    
    /**
     * method
     * 
     * @return bool
     */
    
    public function hasUninstallOperation()
    {
        return $this->getUninstallOperation() !== null;
    }
    
    /**
     * method
     * 
     * @return bool
     */
    
    public function hasFinalizeOperation()
    {
        return $this->getFinalizeOperation() !== null;
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    public function invokeInitializeOperation()
    {
        foreach ($this->getChildren()->getValues() as $childContext) {
            $childContext->invokeInitializeOperation();
        }
        if ($this->hasInitializeOperation() === false) {
            //            throw new WordPressHelperException('No initialize operation to invoke.');
            return;
        }
        $call = $this->getInitializeOperation();
        if ($call !== null) {
            $call($this);
        }
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    public function invokeActivateOperation()
    {
        foreach ($this->getChildren()->getValues() as $childContext) {
            $childContext->invokeActivateOperation();
        }
        if ($this->getActivationVersion() === null) {
            $this->activationVersion = $this->getVersion();
            WP::setOption("{$this->getPackageName()}:" . self::OPTION_ACTIVATION_VERSION, $this->getActivationVersion() !== null ? $this->getActivationVersion()->toString() : null);
        }
        if ($this->getActivationTimeStamp() === null) {
            $this->activationTimeStamp = PHP::toInt(current_time('timestamp', 1));
            WP::setOption("{$this->getPackageName()}:" . self::OPTION_ACTIVATION_TIMESTAMP, $this->activationTimeStamp);
        }
        if ($this->hasActivateOperation() === false) {
            //            throw new WordPressHelperException('No activate operation to invoke.');
            return;
        }
        $call = $this->getActivateOperation();
        if ($call !== null) {
            $call($this);
        }
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    public function invokeDeactivateOperation()
    {
        //        echo "{$this->contextName}:". static::OPTION_ACTIVATION_VERSION . '<br />';
        //        var_dump(static::hasOption("{$this->contextName}:". static::OPTION_ACTIVATION_VERSION));
        foreach ($this->getChildren()->getValues() as $childContext) {
            $childContext->invokeDeactivateOperation();
        }
        if (WP::hasOption("{$this->getPackageName()}:" . self::OPTION_ACTIVATION_VERSION)) {
            if (!WP::removeOption("{$this->getPackageName()}:" . self::OPTION_ACTIVATION_VERSION)) {
                throw new WordPressHelperException("{$this->getPackageName()}:" . self::OPTION_ACTIVATION_VERSION . " could not be removed.");
            }
        }
        if (WP::hasOption("{$this->getPackageName()}:" . self::OPTION_ACTIVATION_TIMESTAMP)) {
            if (!WP::removeOption("{$this->getPackageName()}:" . self::OPTION_ACTIVATION_TIMESTAMP)) {
                throw new WordPressHelperException("{$this->getPackageName()}:" . self::OPTION_ACTIVATION_TIMESTAMP . " could not be removed.");
            }
        }
        if ($this->hasDeactivateOperation() === false) {
            //            throw new WordPressHelperException('No deactivate operation to invoke.');
            return;
        }
        $call = $this->getDeactivateOperation();
        if ($call !== null) {
            $call($this);
        }
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    public function invokeUninstallOperation()
    {
        foreach ($this->getChildren()->getValues() as $childContext) {
            $childContext->invokeUninstallOperation();
        }
        if ($this->hasUninstallOperation() === false) {
            //            throw new WordPressHelperException('No uninstall operation to invoke.');
            return;
        }
        $call = $this->getUninstallOperation();
        if ($call !== null) {
            call_user_func($call);
        }
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    public function invokeFinalizeOperation()
    {
        //        die('finalize');
        if ($this->isFinalized()) {
            //throw new WordPressHelperException("Context '{$this->getProjectName()}' has already been finalized.");
            return;
        }
        $this->finalized = true;
        $this->invokeInitializeOperation();
        $call = $this->getFinalizeOperation();
        if ($call !== null) {
            $this->finalize = $call;
        }
        if ($this->hasFinalizeOperation() === false) {
            //            throw new WordPressHelperException('No finalize operation to invoke.');
            return;
        }
        add_action('after_setup_theme', function () use($call) {
            if ($call !== null) {
                $call($this);
            }
            foreach ($this->getChildren()->getValues() as $childContext) {
                $childContext->invokeFinalizeOperation();
            }
        }, 0);
        if (WP::isAdmin()) {
            if ($this->getUninstallOperation() instanceof \Closure) {
                throw new WordPressHelperException("The uninstall hook for context '{$this->getProjectName()}' cannot be a Closure - it must be unspecified (NULL), a function or a static method.");
            }
            //            echo '<pre>';
            //            var_dump(Constants::CONTEXT_PLUGIN);
            //            var_dump(Constants::CONTEXT_THEME);
            //            var_dump($this->getType());
            //            echo('</pre>');
            if ($this->getType() === Constants::CONTEXT_PLUGIN) {
                register_activation_hook($this->loadPath, function () {
                    $this->invokeActivateOperation();
                });
                register_deactivation_hook($this->loadPath, function () {
                    $this->invokeDeactivateOperation();
                });
                if ($this->hasUninstallOperation()) {
                    register_uninstall_hook($this->loadPath, $this->getUninstallOperation());
                }
            } else {
                if ($this->getType() === Constants::CONTEXT_THEME) {
                    add_action("after_switch_theme", function () {
                        $this->invokeActivateOperation();
                    });
                    add_action("switch_theme", function () {
                        $this->invokeDeactivateOperation();
                        //                    if($this->hasUninstallOperation()) {
                        //
                        //                        $this->invokeUninstallOperation();
                        //                    }
                    });
                }
            }
        }
        //        if(!is_admin()) {
        //
        //            // NOTE: The following action is "wp" and not "wp_loaded," since "wp" is the first
        //            // hook where WordPress template tags return their proper values.
        //
        //            add_action("wp", function () use ($context) {
        //
        ////                echo "<pre>{$context->getName()}</pre>";
        //
        //                if($context->hasTemplateOperation()) {
        //
        //                    if(!$context->invokeTemplateOperation()) {
        //
        //                        exit;
        //                    }
        //                }
        //            });
        //        }
    }
    
    /**
     * method
     * 
     * @return int
     */
    
    public function getType()
    {
        return (int) $this->contextType;
    }
    
    /**
     * method
     * 
     * @return ?int
     */
    
    public function getActivationTimeStamp()
    {
        if ($this->activationTimeStamp !== null) {
            return $this->activationTimeStamp;
        }
        $this->activationTimeStamp = PHP::toInt(WP::getOption("{$this->getPackageName()}:" . self::OPTION_ACTIVATION_TIMESTAMP, PHP::toInt(current_time('timestamp', 1))));
        return $this->activationTimeStamp;
    }
    
    /**
     * method
     * 
     * @return ?ISemVer
     */
    
    public function getVersion()
    {
        return $this->version;
    }
    
    /**
     * method
     * 
     * @return ?ISemVer
     */
    
    public function getActivationVersion()
    {
        if ($this->activationVersion !== null) {
            return $this->activationVersion;
        }
        $tmp = WP::getOption("{$this->getPackageName()}:" . self::OPTION_ACTIVATION_VERSION, null);
        if ($tmp === null) {
            return null;
        }
        //        if(!($tmp instanceof ISemVer)) {
        //
        //            throw new WordPressHelperException("Retrieved activation version does not implement '\\ion\\ISemVer.'");
        //        }
        $this->activationVersion = SemVer::parse($tmp);
        return $this->activationVersion;
    }
    
    /**
     * method
     * 
     * 
     * @return IHelperContext
     */
    
    public function setParent(IHelperContext $context = null)
    {
        $this->parent = $context;
        return $this;
    }
    
    /**
     * method
     * 
     * @return ?IHelperContext
     */
    
    public function getParent()
    {
        return $this->parent;
    }
    
    /**
     * method
     * 
     * @return IVector
     */
    
    public function getChildren()
    {
        return $this->children;
    }
    
    //    /* abstract */ protected function initialize(): void {
    //
    //        // empty for now!
    //    }
    //
    //    protected function activate(): void {
    //
    //        // empty for now!
    //    }
    //
    //    protected function deactivate(): void {
    //
    //        // empty for now!
    //    }
    //
    //    protected function finalize(): void {
    //
    //        // empty for now!
    //    }
    /**
     * method
     * 
     * 
     * @return array
     */
    
    public function getTemplates($flat = true, $themeOnly = false, $labels = false, $nullItem = null, $relativePath = null)
    {
        $wpTemplates = get_page_templates();
        $templates = null;
        if ($nullItem !== null) {
            $templates[$nullItem] = null;
        }
        if ($flat == true) {
            $templates = $wpTemplates;
        } else {
            if (count($wpTemplates) > 0) {
                if ($labels === true) {
                    $templates[wp_get_theme()->Name] = $wpTemplates;
                } else {
                    $templates['theme'] = $wpTemplates;
                }
            } else {
                $templates = [];
            }
        }
        if ($themeOnly) {
            return $templates;
        }
        $customTemplates = [];
        $relativePath = $relativePath === null ? 'templates' : trim($relativePath, '/\\');
        $workingPath = $this->getWorkingDirectory() . $relativePath;
        //die($workingPath);
        if (is_dir($workingPath) === true) {
            $files = array_values(array_diff(scandir($workingPath), array('.', '..')));
            foreach ($files as $file) {
                $matches = [];
                $name = $file;
                if (preg_match('|Template Name:(.*)$|mi', file_get_contents($this->getWorkingDirectory() . "/{$relativePath}/" . $file), $matches)) {
                    $name = trim($matches[1]);
                }
                if (array_key_exists($name, $wpTemplates) === false) {
                    $customTemplates[$name] = $file;
                }
            }
        }
        if (PHP::isArray($customTemplates) && count($customTemplates) > 0) {
            if ($flat == true) {
                $templates = array_merge($templates, $customTemplates);
            } else {
                if ($labels === true) {
                    $templates['Other'] = $customTemplates;
                } else {
                    $templates['other'] = $customTemplates;
                }
            }
        }
        return $templates;
    }
    
    /**
     * method
     * 
     * 
     * @return bool
     */
    
    public function templateExists($name)
    {
        $result = locate_template($name);
        if ($result === '') {
            return false;
        }
        return true;
    }
    
    //TODO: Kill this method - there is a better way to do this and its caused enough trouble!!!
    /**
     * method
     * 
     * 
     * @return string
     */
    
    public function template($name, $echo = false)
    {
        if (substr_compare($name, '.php', -strlen('.php')) !== 0) {
            $name = $name . '.php';
        }
        ob_start();
        if ($overriddenTemplate = locate_template($name)) {
            load_template($overriddenTemplate);
        } else {
            load_template($this->getWorkingDirectory() . "templates/{$name}");
        }
        $output = ob_get_clean();
        if ($echo === true) {
            http_response_code(200);
            echo $output;
        }
        return $output;
    }

}