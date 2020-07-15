<?php
/*
  Plugin Name: WP Helper
  Version: 0.75.5
  Plugin URI: https://justusmeyer.com/b/wordpress-helper/
  Author: Justus Meyer
  Author URI: https://justusmeyer.com
  Description: WP Helper provides a list of methods to aid in WordPress theme- and plug-in development, as well as various tools to aid in debugging.
  Text Domain: WordPressHelper
  Domain Path: /languages
 */

require_once(__DIR__ . '/autoload.php');

use \ion\WordPress\WordPressHelper as WP;
use \ion\WordPress\Helper\IHelperContext;

WP::createContext('ion', 'wp-helper', __FILE__, __DIR__, [])
        
    ->initialize(function(IHelperContext $context) {    

        // empty for now!
    })

    ->activate(function(IHelperContext $context) {    

        // empty for now!
    })
    
    ->deactivate(function(IHelperContext $context) {    

        // empty for now!
    })

    ->uninstall(null)

->finalize();
