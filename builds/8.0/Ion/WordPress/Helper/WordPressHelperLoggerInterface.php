<?php
namespace Ion\WordPress\Helper;

interface WordPressHelperLoggerInterface
{
    function __destruct();
    function activate(bool $force = false) : void;
    function deactivate() : void;
    function getSlug() : ?string;
    function getPurgeAge() : ?int;
    function getEntries($ageInDays = null);
    function getFlushImmediately();
    function log($level, $message, array $context = []);
    function isFlushed();
    function clear();
    function purge(bool $full = false);
}