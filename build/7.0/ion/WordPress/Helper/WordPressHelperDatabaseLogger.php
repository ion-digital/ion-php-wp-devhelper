<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

use ion\WordPress\WordPressHelper as WP;
use ion\PhpHelper as PHP;
use ion\WordPress\Helper\Constants;
use Monolog\Logger;
//use \ion\Types\StringObject;

class WordPressHelperDatabaseLogger extends WordPressHelperLogger
{
    const TABLE_NAME = 'log';
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
     * @return mixed
     */
    
    public function __destruct()
    {
        parent::__destruct();
    }
    
    /**
     * method
     * 
     * 
     * @return void
     */
    
    public function activate(bool $force = false)
    {
        $table = WP::getDbTablePrefix() . static::TABLE_NAME;
        $db = DB_NAME;
        $tableExists = WP::dbQuery("SELECT table_name FROM information_schema.tables WHERE table_schema = '{$db}' AND table_name = '{$table}'");
        if (PHP::count($tableExists) === 0 || $force) {
            WP::dbDeltaTable(static::TABLE_NAME, ['id' => ['type' => 'int(11)', 'null' => false, 'primary' => true, 'auto' => true], 'slug' => ['type' => 'varchar(250)', 'null' => false], 'time' => ['type' => 'datetime', 'null' => false], 'level' => ['type' => 'varchar(250)', 'null' => false], 'message' => ['type' => 'text', 'null' => false], 'context' => ['type' => 'text', 'null' => true]], true);
        }
    }
    
    /**
     * method
     * 
     * @return void
     */
    
    public function deactivate()
    {
        //TODO
    }
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    protected function initialize($slug)
    {
        if (!WP::isWordPress()) {
            throw new Exception('WordPress not detected.');
        }
        //TODO: This should probably be moved to plugin activate...
        $this->activate(false);
    }
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    protected function loadEntries($ageInDays = null)
    {
        $table = WP::getDbTablePrefix() . static::TABLE_NAME;
        $currentTimeStamp = (int) current_time('timestamp');
        $slug = $this->getSlug();
        $records = null;
        $limit = WP::getOption(Constants::MAX_DISPLAYED_LOG_ENTRIES, null);
        if ($limit === null) {
            $limit = 100;
        }
        if ($ageInDays === null) {
            $records = WP::dbQuery("SELECT * FROM `{$table}` WHERE `slug` = '{$slug}' ORDER BY `time` DESC, `id` DESC LIMIT {$limit}");
        } else {
            $age = $ageInDays === null ? 1 : $ageInDays;
            $ageTimeStamp = strtotime("-{$age} days", $currentTimeStamp);
            $ageTime = strftime('%F %T', $ageTimeStamp);
            $records = WP::dbQuery("SELECT * FROM `{$table}` WHERE `slug` = '{$slug}' AND `time` > '{$ageTime}' ORDER BY `time` DESC, `id` DESC LIMIT {$limit}");
        }
        $result = [];
        foreach ($records as $entry) {
            $result[] = ['id' => (int) $entry['id'], 'slug' => $entry['slug'], 'time' => strtotime($entry['time']), 'level' => $entry['level'], 'message' => $entry['message'], 'context' => $entry['context'] !== null ? unserialize($entry['context']) : []];
        }
        return $result;
    }
    
    /**
     * method
     * 
     * 
     * @return mixed
     */
    
    public function purge(bool $full = false)
    {
        parent::purge($full);
        $table = WP::getDbTablePrefix() . static::TABLE_NAME;
        $purgeAge = $this->getPurgeAge();
        $currentTimeStamp = (int) current_time('timestamp');
        $purgeTimeStamp = strtotime("-{$purgeAge} days", $currentTimeStamp);
        $purgeTime = strftime('%F %T', $purgeTimeStamp);
        $slug = $this->getSlug();
        $baseSql = "DELETE FROM `{$table}` WHERE `slug` = '{$slug}'";
        if ($full === true) {
            WP::dbQuery($baseSql);
            return;
        }
        WP::dbQuery($baseSql . " AND `time` < '{$purgeTime}'");
    }
    
    /**
     * method
     * 
     * @return mixed
     */
    
    public function flush()
    {
        $table = WP::getDbTablePrefix() . static::TABLE_NAME;
        $lines = [];
        $values = [];
        foreach ($this->getEntries(null) as $entry) {
            $values = [
                'slug' => "'" . $this->getSlug() . "'",
                'time' => "'" . strftime('%F %T', $entry['time']) . "'",
                'level' => "'" . $entry['level'] . "'",
                'message' => "'" . str_replace('\'', '\\\'', $entry['message']) . "'",
                //(new StringObject($entry['message']))->replace('\'', '\\\'')->toString() . "'",
                'context' => "'" . serialize($entry['context']) . "'",
            ];
            $lines[] = "(" . implode(", ", array_values($values)) . ")";
        }
        if (count($lines) > 0) {
            $sql = "INSERT INTO `{$table}` (`" . implode("`, `", array_keys($values)) . "`) VALUES " . implode(',', $lines) . ';';
            $this->clear();
            WP::dbQuery($sql);
        }
    }

}