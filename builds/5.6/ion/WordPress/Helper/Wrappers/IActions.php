<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */
interface IActions
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