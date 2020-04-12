<?php

//require_once("includes/WordPressHelper/include.php");

use \ion\WordPress\WordPressHelper as WP;
use \ion\Viewport\RedI\RedIFeedPlugIn AS RedI;

?><!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Waterfall</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" /> 
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <meta name="robots" content="all,index,follow" />
        <link rel="stylesheet" type="text/css" href="<?php echo WP::GetThemeUri(); ?>style.css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700" rel="stylesheet" />
        <script src="https://use.fontawesome.com/2ae4bdb080.js"></script>
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo WP::GetThemeUri(); ?>favicons/apple-touch-icon.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo WP::GetThemeUri(); ?>favicons/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo WP::GetThemeUri(); ?>favicons/favicon-16x16.png" />
        <link rel="manifest" href="<?php echo WP::GetThemeUri(); ?>favicons/manifest.json" />
        <link rel="mask-icon" href="<?php echo WP::GetThemeUri(); ?>favicons/safari-pinned-tab.svg" />
        <link rel="shortcut icon" href="<?php echo WP::GetThemeUri(); ?>favicons/favicon.ico" />
        <meta name="msapplication-config" content="<?php echo WP::GetThemeUri(); ?>favicons/browserconfig.xml" />
        <meta name="theme-color" content="#5d5d5d" />        

        <?php wp_head(); ?>
    </head>

    <body>
       
        <header>

            <div class="logo"><a href="index.html"><img src="<?php echo WP::GetThemeUri(); ?>img/logo.gif" alt="Waterfall Housing Company" /></a></div>
            <div class="strapline">Waterfall Housing Company</div>

             <?php WP::Menu("header", "\n<div class=\"desktopMenu\">\n{menu}\n</div>\n", "menu"); ?>
             <?php WP::Menu("header", "\n<div class=\"mobile-menu\">\n<button id=\"burger-toggle\"><span></span></button>\n{menu}\n</div>\n", "mobileMenu"); ?>

        </header>