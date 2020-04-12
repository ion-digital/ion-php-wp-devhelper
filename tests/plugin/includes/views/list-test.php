<?php

use \ion\WordPress\WordPressHelper as WP;


WP::backEndTable("List Form", "list-form", "Item", "Items", "id", null, false, false, false, null, false)        
        
        ->addColumnGroup("Group A", "group-a")
            ->addColumn(WP::TextTableColumn("Column 1", "column-1", "column-1"))
            ->addColumn(WP::TextTableColumn("Column 2", "column-2", "column-2"))
            ->addColumn(WP::TextTableColumn("Column 3", "column-3", "column-3"))
        
        ->addColumnGroup("Group B", "group-b")
            ->addColumn(WP::TextTableColumn("Column 4", "column-4", "column-4"))
            ->addColumn(WP::TextTableColumn("Column 5", "column-5", "column-5"))
            ->addColumn(WP::TextTableColumn("Column 6", "column-6", "column-6"))
        
        ->render();

