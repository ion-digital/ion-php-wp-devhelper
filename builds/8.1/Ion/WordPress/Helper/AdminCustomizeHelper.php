<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace Ion\WordPress\Helper;

/**
 * Description of AdminCustomizeSectionHelper
 *
 * @author Justus
 */
class AdminCustomizeHelper implements AdminCustomizeHelperInterface
{
    private $descriptor;
    public function __construct(array &$descriptor)
    {
        $this->descriptor =& $descriptor;
    }
    public function addTextSetting(string $label, string $key, string $default = null, bool $multiLine = false, int $priority = null, string $transport = 'refresh') : AdminCustomizeHelperInterface
    {
        $this->descriptor[$key] = ['label' => $label, 'key' => $key, 'default' => $default, 'transport' => $transport, 'type' => 'text', 'multiLine' => $multiLine, 'options' => null, 'priority' => $priority];
        return $this;
    }
    public function addDropDownSetting(string $label, string $key, $default = null, array $options = [], int $priority = null, string $transport = 'refresh') : AdminCustomizeHelperInterface
    {
        $this->descriptor[$key] = ['label' => $label, 'key' => $key, 'default' => $default, 'transport' => $transport, 'type' => 'select', 'multiLine' => null, 'options' => $options, 'priority' => $priority];
        return $this;
    }
    public function addMediaSetting(string $label, string $key, $default = null, int $priority = null, string $transport = 'refresh') : AdminCustomizeHelperInterface
    {
        $this->descriptor[$key] = ['label' => $label, 'key' => $key, 'default' => $default, 'transport' => $transport, 'type' => 'media', 'multiLine' => null, 'options' => null, 'priority' => $priority];
        return $this;
    }
    public function addCheckBoxSetting(string $label, string $key, bool $default = null, int $priority = null, string $transport = 'refresh') : AdminCustomizeHelperInterface
    {
        $this->descriptor[$key] = ['label' => $label, 'key' => $key, 'default' => $default, 'transport' => $transport, 'type' => 'checkbox', 'multiLine' => null, 'options' => null, 'priority' => $priority];
        return $this;
    }
    //    public function addIntegerSetting(
    //
    //            string $label,
    //            string $key,
    //            bool $default = null,
    //            int $priority = null,
    //            string $transport = 'refresh'
    //
    //        ): AdminCustomizeHelperInterface {
    //
    //        $this->descriptor[$key] = [
    //
    //            'label' => $label,
    //            'key' => $key,
    //            'default'=> $default,
    //            'transport' => $transport,
    //            'type' => 'text',
    //            'multiLine' => null,
    //            'options' => null,
    //            'priority' => $priority
    //
    //        ];
    //
    //        return $this;
    //    }
}