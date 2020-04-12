<?php


namespace ion\WordPress\Tests;

/**
 * Description of RedIFeedFilterWidget
 *
 * @author Justus
 */

use \ion\WordPress\WordPressHelper as WP;
use \ion\WordPress\WordPressWidget;

class Widget extends WordPressWidget {

    public function __construct() {
        parent::__construct("WordPressHelper Testing Widget");
    }

    protected function RenderFrontEnd(array $values = null) {
        
        //$view = WP::GetView("widget");
        //$view();
    }   
    
}
