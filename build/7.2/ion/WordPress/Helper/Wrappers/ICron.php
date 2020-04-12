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
    static function getCronIntervals() : array;
    
    static function getCronArray() : array;
    
    static function addCronInterval(string $name, int $interval, string $description = null) : string;
    
    static function addCronJob(string $name, int $startTimeStamp, string $intervalName, callable $job) : void;
    
    static function removeCronJob(string $name) : void;

}