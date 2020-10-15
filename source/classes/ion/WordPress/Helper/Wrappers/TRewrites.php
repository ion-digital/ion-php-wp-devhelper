<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

use \Throwable;
use \WP_Post;
use \WP_Rewrite;
use \ion\WordPress\WordPressHelper as WP;
use \ion\WordPress\Helper\Tools;
use \ion\WordPress\Helper\Constants;
use \ion\PhpHelper as PHP;
use \ion\Package;
use \ion\ISemVer;
use \ion\SemVer;

/**
 * Description of TRewriteApi
 *
 * @author Justus
 */
trait TRewrites {
    
    private static $rewrites = [];    

    protected static function initialize_TRewrites() {    
        
        static::registerWrapperAction('init', function() {

            foreach (static::$rewrites as $rewrite) {

                add_rewrite_rule($rewrite["pattern"], $rewrite["target"], ($rewrite["top"] === true) ? "top" : "bottom");
            }            
        });        
        
        if(!WP::isAdmin()) {
        
            return;
        }
        
//        static::registerWrapperAction('wp_loaded', function() {     
//
//            static::flushRewriteRules(true);
//        }); 
        
    }        
    
    public static function addRewriteRule(string $pattern, string $target, bool $top = false): void {

        static::$rewrites[] = [
            
            "pattern" => $pattern,
            "target" => $target,
            "top" => $top
        ];
    }    
    
    public static function flushRewriteRules(bool $hard = true): void {
        
        //#TODO : https://premium.wpmudev.org/forums/topic/301-redirects-on-multisite/
        
        flush_rewrite_rules($hard);
        
        if(!is_multisite() || !$hard) {
            
            return;
        }        
        
        $path = static::getSitePath(is_multisite()) . DIRECTORY_SEPARATOR . '.htaccess';

        $data = @file_get_contents($path);

        if($data === false) {

            return;
        }            

        global $wp_rewrite;
        
        if(PHP::isArray($wp_rewrite->non_wp_rules) && (PHP::count($wp_rewrite->non_wp_rules) > 0)) {

            $startTag = "# BEGIN Helper";
            $endTag = "# END Helper";

            $startPos = PHP::toInt(strpos($data, $startTag));
            $endPos = PHP::toInt(strpos($data, $endTag));            
            
            $rewrites = "$startTag\n\n";

            foreach($wp_rewrite->non_wp_rules as $pattern => $target) {

                $rewrites .= "RewriteRule $pattern $target [L]\n";
            }

            $rewrites .= "\n$endTag";
        
            if($startPos !== null) {

                if($endPos !== null) {

                    $data = substr($data, 0, $startPos) . $rewrites . substr($data, $endPos + strlen($endTag));

                } else {

                    $data = substr($data, 0, $startPos) . $rewrites . substr($data, $startPos + strlen($startTag));
                }

            } else {

                $startPos = PHP::toInt(strpos($data, "RewriteBase"));

                if($startPos !== null) {

                    $startPos = PHP::toInt(strpos($data, "\n", $startPos));

                    if($startPos === null) {

                        throw new WordPressHelperException("Could not determine insert point in .htaccess file (located at '{$path}').");
                    }

                    $data = substr($data, 0, $startPos + 1) . "\n$rewrites\n\n" . substr($data, $startPos + 1);

                } else {

                    $data .= "\n{$rewrites}";
                }                                
            }

            //die("<pre>{$data}</pre>");

            if(@file_put_contents($path, $data) === false) {

                throw new WordPressHelperException("Could not update .htaccess file (located at '{$path}').");
            } 
        }
    }
    
}
