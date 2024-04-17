<?php
namespace Ion\WordPress\Helper;

/**
 * Description of AdminCustomizeSectionHelper
 *
 * @author Justus
 */
interface AdminCustomizeHelperInterface
{
    function addTextSetting(string $label, string $key, string $default = null, bool $multiLine = false, int $priority = null, string $transport = "refresh") : AdminCustomizeHelperInterface;
    function addDropDownSetting(string $label, string $key, $default = null, array $options = [], int $priority = null, string $transport = "refresh") : AdminCustomizeHelperInterface;
    function addMediaSetting(string $label, string $key, $default = null, int $priority = null, string $transport = "refresh") : AdminCustomizeHelperInterface;
    function addCheckBoxSetting(string $label, string $key, bool $default = null, int $priority = null, string $transport = "refresh") : AdminCustomizeHelperInterface;
}