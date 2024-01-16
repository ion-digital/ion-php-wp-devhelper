<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace Ion\WordPress\Helper;

use \Ion\WordPress\WordPressHelper as WP;
use \Ion\PhpHelper as PHP;
use \Ion\WordPress\Helper\Constants;
use \Monolog\Logger;
use \IntlDateFormatter;

class WordPressHelperDatabaseLogger extends WordPressHelperLogger
{
    const TABLE_NAME = 'log';

    public function __construct(/* string */ $slug, /* int */ $purgeAge = null, /* bool */ $flushImmediately = true)
    {
        
        parent::__construct($slug, $purgeAge, $flushImmediately);
    }
    
    public function __destruct() {
        
        parent::__destruct();
    }

    public function activate(bool $force = false): void {
        
        $table = WP::getDbTablePrefix() . static::TABLE_NAME;
        $db = DB_NAME;

        $tableExists = WP::dbQuery("SELECT table_name FROM information_schema.tables WHERE table_schema = '$db' AND table_name = '$table'");
        
        if(PHP::count($tableExists) === 0 || $force) {

            WP::dbDeltaTable(static::TABLE_NAME, [

                'id' => [ 'type' => 'int(11)', 'null' => false, 'primary' => true, 'auto' => true ],
                'slug' => [ 'type' => 'varchar(250)', 'null' => false ],
                'time' => [ 'type' => 'datetime', 'null' => false ],
                'level' => [ 'type' => 'varchar(250)', 'null' => false ],
                'message' => [ 'type' => 'text', 'null' => false ],
                'context' => [ 'type' => 'text', 'null' => true ]

            ], true);
        }        
    }
    
    public function deactivate(): void {
        
        //TODO
    }
    
    protected function initialize($slug) {

        if(!WP::isWordPress()) {
            
            throw new Exception('WordPress not detected.');
        }
        
        //TODO: This should probably be moved to plugin activate...
        $this->activate(false);

    }

    protected function loadEntries($ageInDays = null)
    {
        $table = WP::getDbTablePrefix() . static::TABLE_NAME;
        $currentTimeStamp = (int)current_time('timestamp');
        $slug = $this->getSlug();

        $records = null;

        $limit = PHP::toInt(WP::getSiteOption(Constants::MAX_DISPLAYED_LOG_ENTRIES, null));

        if(PHP::isEmpty($limit))
            $limit = 100;

        if (PHP::isEmpty($ageInDays)) {
            
            $records = WP::dbQuery("SELECT * FROM `$table` WHERE `slug` = '$slug' ORDER BY `time` DESC, `id` DESC LIMIT $limit");
            
        } else {

            $age = ($ageInDays === null ? 1 : $ageInDays);
            $ageTimeStamp = strtotime("-$age days", $currentTimeStamp);
            // //$ageTime = strftime('%F %T', $ageTimeStamp);
            // $formatter = new IntlDateFormatter(get_locale(), IntlDateFormatter::LONG, IntlDateFormatter::LONG);
            // $ageTime = $formatter->format($ageTimeStamp); 
            
            $ageTime = date("Y-m-d H:m:s", $ageTimeStamp);

            $records = WP::dbQuery("SELECT * FROM `$table` WHERE `slug` = '$slug' AND `time` > '$ageTime' ORDER BY `time` DESC, `id` DESC LIMIT $limit");
        }

        $result = [];

        foreach($records as $entry) {

            $result[] = [

                'id' => (int) $entry['id'],
                'slug' => $entry['slug'],
                'time' => strtotime($entry['time']),
                'level' => $entry['level'],
                'message' => $entry['message'],
                'context' => ($entry['context'] !== null ? unserialize($entry['context']) : [])
            ];
        }

        return $result;
    }

    public function purge(bool $full = false) {

        parent::purge($full);
        
        $table = WP::getDbTablePrefix() . static::TABLE_NAME;
        $purgeAge = $this->getPurgeAge();

        $currentTimeStamp = (int) current_time('timestamp');
        $purgeTimeStamp = strtotime("-$purgeAge days", $currentTimeStamp);

        // //$purgeTime = strftime('%F %T', $purgeTimeStamp);
        // $formatter = new IntlDateFormatter(get_locale(), IntlDateFormatter::LONG, IntlDateFormatter::LONG);
        // $purgeTime = $formatter->format($purgeTimeStamp);

        $purgeTime = date("Y-m-d H:m:s", $purgeTimeStamp);

        $slug = $this->getSlug();

        $baseSql = "DELETE FROM `$table` WHERE `slug` = '$slug'";
        
        if($full === true) {        
            WP::dbQuery($baseSql);
            return;
        }
        
        WP::dbQuery($baseSql . " AND `time` < '$purgeTime'");

    }

    public function flush() {

        $table = WP::getDbTablePrefix() . static::TABLE_NAME;

        
        $lines = [];
        $values = [];
        
        //$formatter = new IntlDateFormatter(get_locale(), IntlDateFormatter::LONG, IntlDateFormatter::LONG);

        foreach($this->getEntries(null) as $entry) {

            $values = [
                
                'slug' => "'" . $this->getSlug() . "'",
                // 'time' => "'" . strftime('%F %T', $entry['time']) . "'",
                'time' => "'" . date("Y-m-d H:m:s", $entry['time']) . "'",
                'level' => "'" . $entry['level'] . "'",
                'message' => "'" . str_replace('\'', '\\\'', $entry['message']) . "'",
                'context' => "'" . serialize($entry['context']) . "'"
            ];

            $lines[] = "(" . implode(", ", array_values($values)) . ")";
            
        }

        if(count($lines) > 0) {
            
            $sql = "INSERT INTO `$table` (`" . implode("`, `", array_keys($values)) . "`) VALUES " . implode(',', $lines) . ';';
            
            $this->clear();

            WP::dbQuery($sql);            
        }
    }
}