<?php
namespace ion\WordPress\Helper;

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
    static function addCronInterval($name, $interval, $label = null);
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
     * 
     * @return bool
     */
    static function cronJobExists($name);
    /**
     * method
     * 
     * @return array
     */
    static function getCronArray();
}