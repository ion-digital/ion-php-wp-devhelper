<?php

//define('WP_HELPER_URI', '');
//define('WP_HELPER_DIR', '');
//require_once(stream_resolve_include_path(__DIR__ . DIRECTORY_SEPARATOR . WP_HELPER_DIR) . DIRECTORY_SEPARATOR . 'include.php');

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'wp-helper' . DIRECTORY_SEPARATOR . 'include.php');

use \ion\WordPress\WordPressHelper as WP;

//WP::AddMenu("desktopMenu", "Desktop Menu");
//WP::AddMenu("mobileMenu", "Mobile Menu");
WP::addMenu("header", "Header Menu");
WP::addSideBar("Primary Sidebar", null, "primary");
