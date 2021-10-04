<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper;

/**
 * Description of WordPressWidget
 *
 * @author Justus
 */
use \WP_Widget;
use \ion\WordPress\WordPressHelper;

abstract class WordPressWidget extends WP_Widget implements WordPressWidgetInterface {

    public function __construct(/* string */ $title) {
        parent::__construct(WordPressHelper::slugify(__CLASS__), $title);
    }

    public function widget($args, $instance) {

        echo $args["before_widget"];
        if (!empty($instance["title"])) {
            echo $args["before_title"] . apply_filters("widget_title", $instance["title"]) . $args["after_title"];
        }
        
        echo $this->RenderFrontEnd($instance);
        
        echo $args["after_widget"];
    }

    public function update($new_instance, $old_instance) {
        return $this->ProcessBackEndForm($old_instance, $new_instance);
    }

    public function form($instance) {
        $form = $this->RenderBackEndForm($instance);
        
        if($form !== null) {
            echo $form;
        }
    }

    public function getId() {
        return $this->id;
    }
    
    public function getBaseId() {
        return $this->id_base;
    }        
    
    protected abstract function renderFrontEnd(array $values = null);

    protected function renderBackEndForm(array $values = null) {
        return null;
    }

    protected function processBackEndForm(array $oldValues = null, array $newValues = null) {
        return [];
    }
}
