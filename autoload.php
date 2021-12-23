<?php

/*
 * See license information at the package root in LICENSE.md
 */

if (!class_exists('\\ion\\WordPress\\WordPressHelper')) {

    if ((PHP_MAJOR_VERSION === 5 && PHP_MINOR_VERSION < 6) || (PHP_MAJOR_VERSION < 5)) {
        die('This installation is currently running on PHP version <em>' . PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION . '</em> - PHP version 5.6 or higher is required.');
    }
    
    if (defined('ABSPATH')) {

        require_once( ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'upgrade.php' );
    }

    if (!class_exists('\\ion\\Package')) {

        $autoLoadDir = null;

        $dirs = [
            'vendor' . DIRECTORY_SEPARATOR,
            '..' . DIRECTORY_SEPARATOR . '..'            
        ];

        foreach ($dirs as $dir) {
            
            $tmp = __DIR__ . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . 'autoload.php';
            
            if (file_exists($tmp)) {
                
                $autoLoadDir = realpath($tmp);
                break;
            }
        }

        if (($autoLoadDir !== null) && (file_exists($autoLoadDir))) {
            
            require_once($autoLoadDir);
        } 
    }    

    if (class_exists('\\ion\\Package')) {

        \ion\Package::create(
            'ion', 'wp-devhelper', [ 'source/classes/', 'source/interfaces/', 'source/traits/' ],    
            [                    
                'builds/' . PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION,
                'builds/' . PHP_MAJOR_VERSION

            ], __FILE__);
    }
}
