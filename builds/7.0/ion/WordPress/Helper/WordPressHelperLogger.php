<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

use Psr\Log\AbstractLogger;
use ion\WordPress\WordPressHelper;
abstract class WordPressHelperLogger extends AbstractLogger implements IWordPressHelperLogger
{
    private $slug = null;
    private $entries = [];
    private $purgeAge = null;
    private $flushImmediately = true;
    private $initialized = false;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function __construct($slug, $purgeAge = null, $flushImmediately = true)
    {
        $this->slug = WordPressHelper::slugify($slug);
        $this->entries = [];
        $this->purgeAge = $purgeAge;
        $this->flushImmediately = $flushImmediately;
        $this->initialize($slug);
        if ($purgeAge !== null & $purgeAge !== 0) {
            $this->purge();
        }
    }
    /**
     * method
     * 
     * @return mixed
     */
    public function __destruct()
    {
        if ($this->isFlushed() === false) {
            $this->flush();
        }
    }
    /**
     * method
     * 
     * @return mixed
     */
    protected function isInitialized()
    {
        return (bool) $this->initialized;
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    protected abstract function initialize($slug);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    protected abstract function loadEntries($ageInDays = null);
    /**
     * method
     * 
     * 
     * @return void
     */
    public abstract function activate(bool $force = false);
    /**
     * method
     * 
     * @return void
     */
    public abstract function deactivate();
    /**
     * method
     * 
     * @return ?string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * method
     * 
     * @return ?int
     */
    public function getPurgeAge()
    {
        return $this->purgeAge;
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function getEntries($ageInDays = null)
    {
        if ($ageInDays === null) {
            return $this->entries;
        }
        return array_merge($this->loadEntries($ageInDays) === null ? [] : $this->loadEntries($ageInDays), $this->entries);
        //return $this->entries;
    }
    /**
     * method
     * 
     * @return mixed
     */
    public function getFlushImmediately()
    {
        return $this->flushImmediately;
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function log($level, $message, array $context = [])
    {
        $this->entries[] = ['level' => $level, 'message' => $message, 'time' => current_time('timestamp'), 'context' => $context];
        if ($this->getFlushImmediately() === true && !$this->isFlushed()) {
            $this->flush();
        }
    }
    /**
     * method
     * 
     * @return mixed
     */
    public function isFlushed()
    {
        return (bool) (count($this->entries) === 0);
    }
    /**
     * method
     * 
     * @return mixed
     */
    public function clear()
    {
        $this->entries = [];
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function purge(bool $full = false)
    {
        $this->clear();
    }
}