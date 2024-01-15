<?php

namespace Ion\WordPress\Helper;


/**
 * Description of CronTrait*
 * @author Justus
 */
interface CronInterface {

    static function addCronInterval(string $name, int $interval, string $label = null): string;

    static function addCronJob(

        string $name,
        int $startTimeStamp,
        string $intervalName,
        callable $job

    ): void;

    static function removeCronJob(string $name): void;

    static function getCronIntervals(bool $asList = false): array;

    static function cronJobExists(string $name): bool;

    static function getCronArray(): array;

}
