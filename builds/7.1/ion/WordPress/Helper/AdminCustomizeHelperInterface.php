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
    function addTextSetting(string $label, string $key, string $default = null, bool $multiLine = false, int $priority = null, string $transport = "refresh") : AdminCustomizeHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminCustomizeHelperInterface
     */
    function addDropDownSetting(string $label, string $key, $default = null, array $options = [], int $priority = null, string $transport = "refresh") : AdminCustomizeHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminCustomizeHelperInterface
     */
    function addMediaSetting(string $label, string $key, $default = null, int $priority = null, string $transport = "refresh") : AdminCustomizeHelperInterface;
    /**
     * method
     * 
     * 
     * @return AdminCustomizeHelperInterface
     */
    function addCheckBoxSetting(string $label, string $key, bool $default = null, int $priority = null, string $transport = "refresh") : AdminCustomizeHelperInterface;
}