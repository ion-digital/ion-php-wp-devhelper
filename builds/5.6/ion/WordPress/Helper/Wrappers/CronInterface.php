<?php
namespace ion\WordPress\Helper\Wrappers;

/**
 * Description of CronTrait*
 * @author Justus
 */
interface CronInterface
{
    /**
     * method
     * 
     * 
     * @return string
     */
    static function addCronInterval($name, $interval, $description = null);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addCronJob($name, $startTimeStamp, $intervalName, callable $job);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function removeCronJob($name);
    /**
     * method
     * 
     * @return array
     */
    static function getCronIntervals();
    /**
     * method
     * 
     * @return array
     */
    static function getCronArray();
}