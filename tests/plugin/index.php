<?php

/*
Plugin Name: WordPress Helper Testing Plugin
Version: 0.1
Plugin URI: https://www.wpsolved.io/helper/
Author: Justus Meyer
Author URI: https://www.wpsolved.io
Description: A plugin to test as much functionality in WordPressHelper as possible - it also serves as a template and example for future development.
Text Domain: WordPressHelper
Domain Path: /languages
*/


//require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'wp-helper' . DIRECTORY_SEPARATOR . 'include.php');

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'wp-helper' . DIRECTORY_SEPARATOR . 'autoload.php');

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes/classes/ion/WordPress/Tests/TTemplateTags.php');
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes/classes/ion/WordPress/Tests/Widget.php');
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes/classes/ion/WordPress/Tests/PlugIn.php');


use \ion\WordPress\Tests\PlugIn;

PlugIn::create();



