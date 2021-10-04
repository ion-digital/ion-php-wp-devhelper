<?php
namespace ion\WordPress\Helper\Wrappers;

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
    static function addAction($name, callable $function, $priority = null);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function removeAction($name, callable $function, $priority = null);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function addAjaxAction($name, callable $action, $backEnd = true, $frontEnd = false);
    /**
     * method
     * 
     * 
     * @return mixed
     */
    static function addFormAction($name, callable $action, $backEnd = true, $frontEnd = false);
    /**
     * method
     * 
     * 
     * @return bool
     */
    static function hasAction($name);
    /**
     * method
     * 
     * 
     * @return ?int
     */
    static function getActionPriority($name, callable $action);
}