<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace Ion\WordPress\Helper;

use Psr\Log\LoggerInterface;
use Psr\Log\AbstractLogger;
use Ion\WordPress\WordPressHelper as WP;
class WordPressHelperFileLogger extends WordPressHelperLogger
{
    public function __construct(
        /* string */
        $slug,
        /* int */
        $purgeAge = null,
        /* bool */
        $flushImmediately = true
    )
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