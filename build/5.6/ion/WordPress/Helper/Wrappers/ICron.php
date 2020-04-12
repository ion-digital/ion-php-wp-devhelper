<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */

interface ICron
{
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

}