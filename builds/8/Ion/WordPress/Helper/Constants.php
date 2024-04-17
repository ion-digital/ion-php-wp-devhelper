<?php

/*
 * See license information at the package root in LICENSE.md
 */

//TODO: This file needs to be refactored and removed

namespace Ion\WordPress\Helper;

/**
 * Description of WordPressConstants
 *
 * @author Justus
 */
final class Constants {

    const WP_HELPER = 'WP_HELPER';

    const WP_HELPER_DEBUG_SLUG = 'wp-helper-debug';

    const DEFAULT_CAPABILITY = "manage_options";
    const DEFAULT_THEME_CAPABILITY = "edit_theme_options";
    const DEFAULT_PLUGIN_CAPABILITY = self::DEFAULT_CAPABILITY;    
    
    const CRON_DAILY = 'daily';
    const CRON_WEEKLY = 'weekly';
    
    const TOOLS_HIDDEN_OPTION = 'wp-helper-tools-hidden';  
    const TOOLS_FULLY_HIDDEN_OPTION = 'wp-helper-tools-fully-hidden';
    const TOOLS_AUTO_PARAGRAPHS_OPTION = 'wp-helper-html-auto-paragraphs';
    const ENABLE_LOGGING = 'wp-helper-enable-logging';
    const LOG_TO_DATABASE = 'wp-helper-log-to-database';
    const LOGS_ARCHIVE_AGE = 'wp-helper-logs-archive-age-days';
    const LOGS_PURGE_AGE = 'wp-helper-logs-purge-age-days';
    const MAX_DISPLAYED_LOG_ENTRIES = 'wp-helper-logs-max-displayed-entries';
    
    const WP_CONFIG_DEBUG = 'WP_DEBUG';
    const WP_CONFIG_DEBUG_DISPLAY = 'WP_DEBUG_DISPLAY';
    const WP_CONFIG_DEBUG_LOG = 'WP_DEBUG_LOG';
    const WP_CONFIG_SAVEQUERIES = 'SAVEQUERIES';
    const WP_CONFIG_SCRIPT_DEBUG = 'SCRIPT_DEBUG';
    const WP_CONFIG_CONCATENATE_SCRIPTS = 'CONCATENATE_SCRIPTS';
    const WP_CONFIG_DISABLE_CRON= 'DISABLE_WP_CRON';
    const WP_CONFIG_CRON_LOCK_TIMEOUT = 'WP_CRON_LOCK_TIMEOUT';
    const WP_CONFIG_ALTERNATE_CRON = 'ALTERNATE_WP_CRON';
    
    const SITE_URI = 'site-uri';
    const SITE_PATH = 'site-path';
    const WORDPRESS_URI = 'wordpress-uri';
    const WORDPRESS_PATH = 'wordpress-path';
    const WORDPRESS_CONTENT_URI = 'wordpress-content-uri';
    const WORDPRESS_CONTENT_PATH = 'wordpress-content-path';
    
    const WP_CONFIG_DOCUMENTATION_URL = 'https://codex.wordpress.org/Editing_wp-config.php';
    
    const PHP_LOG_ERRORS = 'log_errors';
    const PHP_DISPLAY_ERRORS = 'display_errors';
    const PHP_ERROR_LOG = 'error_log';    
    
    const FORM_ACTION_PREFIX = 'wp-helper';

//    const CONTEXT_UNKNOWN = 0;
    const CONTEXT_PLUGIN = 1;
    const CONTEXT_THEME = 2;    
//    const CONTEXT_LIBRARY = 3;
    
    const LIST_QUERYSTRING_PARAMETER = 'list';
    const LIST_ACTION_QUERYSTRING_PARAMETER = 'list-action';
    const LIST_UPDATE_QUERYSTRING_PARAMETER = 'id';
  
    const AUTHOR_COMPANY = 'ION DIGITAL CC';
    const AUTHOR_NAME = 'Justus Meyer';
    const MAINTAINER_NAME = 'Justus Meyer';
    const MAINTAINER_SITE = 'https://justusmeyer.com/wordpress-development';
    const AUTHOR_SITE = 'https://justusmeyer.com/wordpress-development';
    
    const HELPER_SITE = "https://justusmeyer.com/wordpress-helper";
    const WORDPRESS_SITE = "https://www.wordpress.org";   
    
    const QUICK_404_OPTION = 'wp-helper-quick-404';
    
    const ABOUT_CONTENT = <<<TEXT
<h2>WP Dev/helper</h2>
<p>            
<strong>WP Dev/helper</strong> is a library of functions that theme and plug-in developers can use
to provide a consistent experience to their users, by abstracting as much of the standard WordPress
functionality, hooks and settings as possible - resulting in a much simpler and less time-consuming 
way to develop with WordPress.
</p>
<p>
<strong>WP Dev/helper</strong> helps developers to stop worrying about WordPress-specific implementation 
details and gotchas - and to get on with the business of building something awesome!
</p>
<h2>Why is it here?</h2>
<p>
<strong>WP Dev/helper</strong> can function as:            
</p>
<ul>
<li>an included PHP library (as <em>part</em> of a theme or plug-in that is installed),</li>
<li>or as an installed plug-in itself (which can conveniently be updated via WordPress' update mechanism).</li>
</ul>
<p>
To find out where it is installed and what contexts (instances of plug-ins and themes) are currently registered, have a look at the current <a href="{state-link}">State</a>.
</p>
<h2>Need More WordPress?</h2>
<p>            
Are you busy expanding {site-name} - or are you looking at building a new WordPress site?
</p>
<p>
If you're interested in additional plugins or a custom theme, we can build it for you!
</p>
<p>    
To find your WordPress solution, <a href="{maintainer-link}" target="_blank">click here</a>!
</p>

TEXT;
}
