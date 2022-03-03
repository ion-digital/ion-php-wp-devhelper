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
    static function addCronInterval(string $name, int $interval, string $label = null) : string;
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addCronJob(string $name, int $startTimeStamp, string $intervalName, callable $job);
    /**
     * method
     * 
     * 
     * @return void
     */
    static function removeCronJob(string $name);
    /**
     * method
     * 
     * 
     * @return array
     */
    static function getCronIntervals(bool $asList = false) : array;
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function cronJobExists(string $name) : bool;
    /**
     * method
     * 
     * @return array
     */
    static function getCronArray() : array;
}