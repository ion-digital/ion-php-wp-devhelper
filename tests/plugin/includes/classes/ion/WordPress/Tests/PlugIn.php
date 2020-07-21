<?php

namespace ion\WordPress\Tests;

/**
 * Description of PlugIn
 *
 * @author Justus
 */

use \ion\WordPress\IWordPressHelper;
use \ion\WordPress\WordPressHelper as WP;
use \ion\WordPress\WordPressPlugIn;
use \ion\WordPress\Tests\Widget;

class PlugIn extends WordPressPlugIn {

    use TTemplateTags;

   
    protected function initialize(IWordPressHelper $context) {

        WP::registerLog('wp-helper-plugin-plugin', 'WP Devhelper Test Plugin');

        WP::addScript("inline", "( function() { console.log('WP Devhelper Test Plug-in says HI!'); } )();", true, true, true, false);
        
        WP::addScript("jquery", $context->getWorkingUri() . "scripts/jquery-3.2.1.js", true, true);

        WP::addStyle("site", $context->getWorkingUri() . "styles/site.css", false, true);                
        WP::addScript("site", $context->getWorkingUri() . "scripts/site.js", false, true);
        
        WP::addStyle("admin", $context->getWorkingUri() . "styles/admin.css", true, false);
        WP::addScript("admin", $context->getWorkingUri() . "scripts/admin.js", true, false);
        
        WP::addPlugInBackEndMenuPage("WP Devhelper", $context->getView("method-tests"), "Helper Tests", "method-tests")

                ->addSubMenuPage("Method Tests", $context->getView("method-tests"), "method-tests")
                        ->addSubMenuPageTab("Method Tests", $context->getView("method-tests"))

                ->addSubMenuPage("Log Test", $context->getView("log-test"), 'log-test')

                ->addSubMenuPage("List Test", $context->getView("list-test"), "list-test")
                        ->addSubMenuPageTab("Edit Test", $context->getView("edit-test"))
                        ->addSubMenuPageTab("One-column Edit Layout Test", $context->getView("1-column-edit-test"))
                        ->addSubMenuPageTab("Two-column Edit Layout Test", $context->getView("2-column-edit-test"))
                        ->addSubMenuPageTab("Three-column Edit Layout Test", $context->getView("3-column-edit-test"));

        //WP::AddRewriteRule("/?red-i/property/([0-9]+)(/([^/]+))?/?\$", "?red-i=true&load=single&label=\$1&function=\$3");

        
        WP::addWidget(new Widget());

        //WP::log('wp-helper-plugin-plugin', 'info', 'WP Devhelper test plugin initialized.');

        WP::addAjaxAction('generate-logs', function() {

            WP::log('wp-helper-plugin-plugin')
                ->info('Another log entry!', ['Context entry 1', 'Context entry 2', 'Context entry 3'])
                ->alert('Another log entry!', ['Context entry 1', 'Context entry 2', 'Context entry 3'])
                ->emergency('Another log entry!', ['Context entry 1', 'Context entry 2', 'Context entry 3'])
                ->critical('Another log entry!', ['Context entry 1', 'Context entry 2', 'Context entry 3'])
                ->warning('Another log entry!', ['Context entry 1', 'Context entry 2', 'Context entry 3'])
                ->debug('Another log entry!', ['Context entry 1', 'Context entry 2', 'Context entry 3'])
                ->notice('Another log entry!', ['Context entry 1', 'Context entry 2', 'Context entry 3'])
                ->error('Another log entry!', ['Context entry 1', 'Context entry 2', 'Context entry 3']);

            echo "1";
            exit;
        }, true, false);
    }

    protected function install(IWordPressHelper $context) {

        //ob_start();
        
        WP::dbDeltaTable("wphelper", [

            'id' => [ 'type' => 'int(11)', 'null' => false, 'primary' => true, 'auto' => true ],
            'column1' => [ 'type' => 'varchar(250)', 'null' => false, 'default' => 'Default value' ],
            'column2' => [ 'type' => 'varchar(250)', 'null' => true ],
            'column3' => [ 'type' => 'int(11)', 'null' => true ]

        ]);
            
        //die(ob_get_clean());
    }
    
    protected function main(IWordPressHelper $context) {



        return true;
    }


}
