<?php
namespace ion\WordPress\Helper;

/**
 * Description of AdminCustomizeSectionHelper
 *
 * @author Justus
 */
interface AdminCustomizeHelperInterface
{
    /**
     * method
     * 
     * 
     * @return AdminCustomizeHelperInterface
     */
    function addTextSetting($label, $key, $default = null, $multiLine = false, $priority = null, $transport = "refresh");
    /**
     * method
     * 
     * 
     * @return AdminCustomizeHelperInterface
     */
    function addDropDownSetting($label, $key, $default = null, array $options = [], $priority = null, $transport = "refresh");
    /**
     * method
     * 
     * 
     * @return AdminCustomizeHelperInterface
     */
    function addMediaSetting($label, $key, $default = null, $priority = null, $transport = "refresh");
    /**
     * method
     * 
     * 
     * @return AdminCustomizeHelperInterface
     */
    function addCheckBoxSetting($label, $key, $default = null, $priority = null, $transport = "refresh");
}