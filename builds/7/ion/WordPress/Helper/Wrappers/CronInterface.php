<?php

namespace ion\WordPress\Helper\Wrappers;


/**
 * Description of CronTrait*
 * @author Justus
 */
interface CronInterface {

    static function addCronInterval(string $name, int $interval, string $description = null): string;

    static function addCronJob(

        string $name,
        int $startTimeStamp,
        string $intervalName,
        callable $job

    ): void;

    static function removeCronJob(string $name): void;

    static function getCronIntervals(): array;

    static function getCronArray(): array;

}
