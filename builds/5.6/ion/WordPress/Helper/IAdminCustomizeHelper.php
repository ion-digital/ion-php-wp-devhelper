<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 *
 * @author Justus
 */
interface IAdminCustomizeHelper
{
    /**
     * method
     * 
     * 
     * @return self
     */
    function addTextSetting($label, $key, $default = null, $multiLine = false, $priority = null, $transport = 'refresh');
    /**
     * method
     * 
     * 
     * @return self
     */
    function addCheckBoxSetting($label, $key, $default = null, $priority = null, $transport = 'refresh');
    /**
     * method
     * 
     * 
     * @return self
     */
    function addDropDownSetting($label, $key, $default = null, array $options = [], $priority = null, $transport = 'refresh');
    /**
     * method
     * 
     * 
     * @return self
     */
    function addMediaSetting($label, $key, $default = null, $priority = null, $transport = 'refresh');
}