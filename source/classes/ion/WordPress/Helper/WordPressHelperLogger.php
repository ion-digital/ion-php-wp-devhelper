<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper;


use Psr\Log\AbstractLogger;
use \ion\WordPress\WordPressHelper;

abstract class WordPressHelperLogger extends AbstractLogger implements IWordPressHelperLogger
{
    private $slug = null;
    private $entries = [];
    private $purgeAge = null;
    private $flushImmediately = true;
    private $initialized = false;

    public function __construct(/* string */ $slug, /* int */ $purgeAge = null, /* bool */ $flushImmediately = true)
    {
        $this->slug = WordPressHelper::slugify($slug);

        $this->entries = [];
        $this->purgeAge = $purgeAge;
        $this->flushImmediately = $flushImmediately;

        $this->initialize($slug);

        if($purgeAge !== null & $purgeAge !== 0) {
            $this->purge();
        }
    }

    public function __destruct()
    {
        if($this->isFlushed() === false) {
            $this->flush();
        }
    }

    protected function isInitialized() {
        
        return (bool) $this->initialized;
    }

    protected abstract function initialize($slug);

    protected abstract function loadEntries($ageInDays = null);

    public abstract function activate(bool $force = false): void;
    
    public abstract function deactivate(): void;
    
    public function getSlug(): ?string {
        return $this->slug;
    }

    public function getPurgeAge(): ?int {
        return $this->purgeAge;
    }

    public function getEntries($ageInDays = null)
    {
        if($ageInDays === null) {
            return $this->entries;
        }

        return array_merge(($this->loadEntries($ageInDays) === null ? [] : $this->loadEntries($ageInDays)), $this->entries);
        //return $this->entries;
    }

    public function getFlushImmediately() {
        return $this->flushImmediately;
    }

    public function log($level, $message, array $context = [])
    {
        $this->entries[] = [
            'level' => $level,
            'message' => $message,
            'time' => current_time('timestamp'),
            'context' => $context
        ];

        if($this->getFlushImmediately() === true && !$this->isFlushed()) {
            $this->flush();
        }
    }

    public function isFlushed() {
        return (bool) (count($this->entries) === 0);
    }

    public function clear() {
        $this->entries = [];
    }
    
    public function purge(bool $full = false) {
        $this->clear();
    }
}