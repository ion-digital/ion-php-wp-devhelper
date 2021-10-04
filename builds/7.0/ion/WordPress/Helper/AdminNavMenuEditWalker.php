<?php
namespace ion\WordPress\Helper;

/**
 * Navigation Menu API: Walker_Nav_Menu_Edit class
 *
 * @package WordPress
 * @subpackage Administration
 * @since 4.4.0
 */
/**
 * Create HTML list of nav menu input items.
 *
 * @since 3.0.0
 *
 * @see Walker_Nav_Menu
 */
use Walker_Nav_Menu;
use Walker_Nav_Menu_Edit;
use ion\WordPress\WordPressHelper as WP;
use ion\PhpHelper as PHP;
class AdminNavMenuEditWalker extends Walker_Nav_Menu_Edit
{
    const OPENING_ELEMENT = '<p class="field-description description description-wide">';
    const CLOSING_ELEMENT = '</p>';
    const REPLACEMENT_ELEMENT = '<p class="field-description description description-wide __wp-devhelper-processed">';
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        parent::start_el($output, $item, $depth, $args, $id);
        $item_id = esc_attr($item->ID);
        $customCode = PHP::obGet(function () use($item, $item_id) {
            foreach (WP::getMenuFields() as $menuId => $fields) {
                if (!property_exists($item, 'meta')) {
                    break;
                }
                foreach ($fields as $field) {
                    if (!array_key_exists($field['name'], $item->meta)) {
                        continue;
                    }
                    ?>
                        <p class="field-<?php 
                    echo $field['name'];
                    ?> description description-wide">
                            <label for="edit-menu-item-<?php 
                    echo $field['name'];
                    ?>-<?php 
                    echo $item_id;
                    ?>">
                                <?php 
                    _e($field['label']);
                    ?><br />
                                <?php 
                    // var_dump($item->meta);
                    ?>
                                <?php 
                    echo $field['html'](esc_attr($item->meta[$field['name']]), null, null, "menu-item-{$field['name']}[{$item_id}]", "edit-menu-item-{$field['id']}-{$item_id}");
                    ?>
                            </label>
                        </p>
                    <?php 
                }
            }
            return;
        });
        if (!PHP::isEmpty($customCode)) {
            $start = strpos($output, static::OPENING_ELEMENT, 0);
            $end = strpos($output, static::CLOSING_ELEMENT, $start) + strlen(static::CLOSING_ELEMENT);
            $output = substr_replace($output, "\n" . $customCode, $end, 0);
        }
        $output = str_replace(static::OPENING_ELEMENT, static::REPLACEMENT_ELEMENT, $output);
    }
}