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
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    public function __construct($slug, $purgeAge = null, $flushImmediately = true)
    {
        parent::__construct($slug, $purgeAge, $flushImmediately);
    }
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    protected function initialize($slug)
    {
    }
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    protected function loadEntries($ageInDays = null)
    {
    }
    
    /**
     * method
     * 
     * @return mixed
     */
    
    public function purge()
    {
    }
    
    /**
     * method
     * 
     * @return mixed
     */
    
    public function flush()
    {
    }

}