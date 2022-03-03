<?php
namespace ion\WordPress\Helper;

/**
 *
 * @author Justus
 */
interface ActionsInterface
{
    /**
     * method
     * 
     * 
     * @return void
     */
    static function addAction(string $name, callable $function, int $priority = null);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function removeAction(string $name, callable $function, int $priority = null);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function addAjaxAction(string $name, callable $action, bool $backEnd = true, bool $frontEnd = false);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function addFormAction(string $name, callable $action, bool $backEnd = true, bool $frontEnd = false);
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function hasAction(string $name) : bool;
    /**
     * method
     * 
     * 
     * @return ?int
     */
    static function getActionPriority(string $name, callable $action);
}