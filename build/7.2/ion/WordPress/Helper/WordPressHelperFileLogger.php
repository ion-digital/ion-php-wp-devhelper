<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

use Psr\Log\LoggerInterface;
use Psr\Log\AbstractLogger;
use ion\WordPress\WordPressHelper as WP;

class WordPressHelperFileLogger extends WordPressHelperLogger
{
    public function __construct($slug, $purgeAge = null, $flushImmediately = true)
    {
        parent::__construct($slug, $purgeAge, $flushImmediately);
    }
    
    protected function initialize($slug)
    {
    }
    
    protected function loadEntries($ageInDays = null)
    {
    }
    
    public function purge()
    {
    }
    
    public function flush()
    {
    }

}