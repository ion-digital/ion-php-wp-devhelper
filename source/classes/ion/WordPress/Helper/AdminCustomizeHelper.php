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
class AdminCustomizeHelper implements IAdminCustomizeHelper {
    
    private $descriptor;
    
    public function __construct(array &$descriptor) {
        
        $this->descriptor = &$descriptor;
        
    }
    
//$wpCustomize->add_section( 'ion-settings' , array(
//
//    'title'      => __( 'ION', 'ion-settings' ),
//    'priority'   => 30
//));                       
//
//$wpCustomize->add_setting('ion-colour-theme', [
//
//    'default' => null,
//    'transport' => 'refresh'
//]);
//
//$wpCustomize->add_control(
//
//    'ion-colour-theme',
//    [
//        'label' => __('Colour Theme', 'ion-colour-theme'),
//        'section' => 'ion-settings', //colors
//        'settings' => 'ion-colour-theme',
//        'type' => 'select',
//        'choices' => $themes
//    ]
//);      
    
    public function addTextSetting(
            
            string $label,
            string $key,            
            string $default = null,            
            bool $multiLine = false,
            int $priority = null,
            string $transport = 'refresh'
            
        ): IAdminCustomizeHelper {
        
        $this->descriptor[$key] = [
            
            'label' => $label,
            'key' => $key,
            'default'=> $default,
            'transport' => $transport,
            'type' => 'text',
            'multiLine' => $multiLine,
            'options' => null,
            'priority' => $priority
            
        ];
        
        return $this;
    }
    
    public function addDropDownSetting(
            
            string $label,
            string $key,            
            $default = null,            
            array $options = [],
            int $priority = null,
            string $transport = 'refresh'
            
        ): IAdminCustomizeHelper {
        
        $this->descriptor[$key] = [
            
            'label' => $label,
            'key' => $key,
            'default'=> $default,
            'transport' => $transport,
            'type' => 'select',
            'multiLine' => null,
            'options' => $options,
            'priority' => $priority
            
        ];        
        
        return $this;
    }
    
    public function addMediaSetting(
            
            string $label,
            string $key,            
            $default = null,
            int $priority = null,
            string $transport = 'refresh'
            
        ): IAdminCustomizeHelper {
        
        $this->descriptor[$key] = [
            
            'label' => $label,
            'key' => $key,
            'default'=> $default,
            'transport' => $transport,
            'type' => 'media',
            'multiLine' => null,
            'options' => null,
            'priority' => $priority
            
        ];        
        
        return $this;
    }    
    
    public function addCheckBoxSetting(
            
            string $label,
            string $key,            
            bool $default = null,
            int $priority = null,
            string $transport = 'refresh'
            
        ): IAdminCustomizeHelper {
        
        $this->descriptor[$key] = [
            
            'label' => $label,
            'key' => $key,
            'default'=> $default,
            'transport' => $transport,
            'type' => 'checkbox',
            'multiLine' => null,
            'options' => null,
            'priority' => $priority
            
        ];        
        
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
//        ): IAdminCustomizeHelper {
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
