<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 * Description of AdminCustomizeSectionHelper
 *
 * @author Justus
 */
class AdminCustomizeHelper implements AdminCustomizeHelperInterface
{
    private $descriptor;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function __construct(array &$descriptor)
    {
        $this->descriptor =& $descriptor;
    }
    /**
     * method
     * 
     * 
     * @return AdminCustomizeHelperInterface
     */
    public function addTextSetting($label, $key, $default = null, $multiLine = false, $priority = null, $transport = 'refresh')
    {
        $this->descriptor[$key] = ['label' => $label, 'key' => $key, 'default' => $default, 'transport' => $transport, 'type' => 'text', 'multiLine' => $multiLine, 'options' => null, 'priority' => $priority];
        return $this;
    }
    /**
     * method
     * 
     * 
     * @return AdminCustomizeHelperInterface
     */
    public function addDropDownSetting($label, $key, $default = null, array $options = [], $priority = null, $transport = 'refresh')
    {
        $this->descriptor[$key] = ['label' => $label, 'key' => $key, 'default' => $default, 'transport' => $transport, 'type' => 'select', 'multiLine' => null, 'options' => $options, 'priority' => $priority];
        return $this;
    }
    /**
     * method
     * 
     * 
     * @return AdminCustomizeHelperInterface
     */
    public function addMediaSetting($label, $key, $default = null, $priority = null, $transport = 'refresh')
    {
        $this->descriptor[$key] = ['label' => $label, 'key' => $key, 'default' => $default, 'transport' => $transport, 'type' => 'media', 'multiLine' => null, 'options' => null, 'priority' => $priority];
        return $this;
    }
    /**
     * method
     * 
     * 
     * @return AdminCustomizeHelperInterface
     */
    public function addCheckBoxSetting($label, $key, $default = null, $priority = null, $transport = 'refresh')
    {
        $this->descriptor[$key] = ['label' => $label, 'key' => $key, 'default' => $default, 'transport' => $transport, 'type' => 'checkbox', 'multiLine' => null, 'options' => null, 'priority' => $priority];
        return $this;
    }
}