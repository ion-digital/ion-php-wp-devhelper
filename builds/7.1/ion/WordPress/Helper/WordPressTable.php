<?php
/*
 * See license information at the package root in LICENSE.md
 */
namespace ion\WordPress\Helper;

/**
 * Description of AdminTableHelper
 *
 * @author Justus
 */
// https://codex.wordpress.org/Class_Reference/WP_List_Table
use WP_List_Table;
use ion\WordPress\Helper\Constants;
use ion\WordPress\WordPressHelper as WP;
use ion\PhpHelper as PHP;
class WordPressTable extends WP_List_Table
{
    private $descriptor;
    private $data;
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function __construct(array &$descriptor, array $rows)
    {
        parent::__construct(["singular" => $descriptor["singular"], "plural" => $descriptor["plural"], "ajax" => $descriptor["ajax"], 'screen' => null]);
        $this->descriptor = $descriptor;
        $this->data = $rows;
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    public function column_cb($item)
    {
        if (array_key_exists($this->descriptor['key'], $item)) {
            return sprintf(
                '<input type="checkbox" name="%1$s[]" value="%2$s" />',
                /* $1%s */
                "items",
                /* $2%s */
                $item[$this->descriptor["key"]]
            );
        }
        return null;
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    protected function column_default($item, $column_name)
    {
        $selectedColumn = null;
        $actionColumn = false;
        $index = 0;
        if (PHP::isArray($this->descriptor["columnGroups"])) {
            foreach ($this->descriptor["columnGroups"] as $columnGroup) {
                if (!PHP::isArray($columnGroup)) {
                    continue;
                }
                if (array_key_exists("columns", $columnGroup) && PHP::isArray($columnGroup["columns"])) {
                    foreach ($columnGroup["columns"] as $column) {
                        if ($column["name"] === $column_name) {
                            $selectedColumn = $column;
                            if ($index < 1) {
                                $actionColumn = true;
                            }
                        }
                        if ($selectedColumn !== null) {
                            break;
                        }
                        $index++;
                    }
                }
                if ($selectedColumn !== null) {
                    break;
                }
            }
        }
        if ($selectedColumn !== null) {
            $label = '';
            if (!array_key_exists($column_name, $item)) {
                throw new WordPressHelperException("Column '{$column_name}' has not been defined in the row data.");
            }
            $output = $selectedColumn["html"]($item[$column_name]);
            if ($actionColumn === true) {
                $actions = [];
                //$url = $_SERVER['REQUEST_URI']; // We use this instead of filter_input for compatability with some PHP 5.6 servers
                $url = WP::getAdminUrl('admin') . '?page=' . PHP::filterInput('page', [INPUT_GET]) . "&list={$this->descriptor['id']}";
                if ($url === null) {
                    throw new WordPressHelperException("'REQUEST_URI' is NULL.");
                }
                $paged = PHP::toInt(PHP::filterInput('paged', [INPUT_GET]));
                if ($this->descriptor['allowEdit'] === true) {
                    $editUrl = $url . '&list-action=update&record=' . $item[$this->descriptor['key']] . '&key=' . $this->descriptor['key'] . (!PHP::isEmpty($paged) ? "&paged={$paged}" : "");
                    $output = '<a href="' . $editUrl . '">' . $output . '</a>';
                    $actions['edit'] = "<a href=\"{$editUrl}\">Edit</a>";
                }
                if ($this->descriptor['allowDelete'] === true) {
                    $deleteUrl = $url . '&list-action=delete&record=' . $item[$this->descriptor['key']] . '&key=' . $this->descriptor['key'];
                    $actions['delete'] = "<a href=\"{$deleteUrl}\">Delete</a>";
                }
                if (PHP::isArray($this->descriptor['additionalActions']) && count($this->descriptor['additionalActions']) > 0) {
                    foreach ($this->descriptor['additionalActions'] as $label => $callBack) {
                        $tmp = $callBack($item[$this->descriptor['key']]);
                        if ($tmp !== false) {
                            $actions[$tmp] = WP::applyTemplate($label, ['record' => $item[$this->descriptor['key']]]);
                        }
                    }
                }
                if (PHP::isArray($actions) && count($actions) > 0) {
                    $output .= $this->row_actions($actions);
                }
            }
            return $output;
        }
        return $item[$column_name];
    }
    /**
     * method
     * 
     * @return mixed
     */
    public function get_columns()
    {
        if (PHP::isArray($this->descriptor["columnGroups"])) {
            foreach ($this->descriptor["columnGroups"] as $columnGroup) {
                if (PHP::isArray($columnGroup)) {
                    foreach ($columnGroup["columns"] as $column) {
                        $columns[$column["name"]] = $column["label"];
                    }
                }
            }
        }
        return $columns;
    }
    /**
     * method
     * 
     * @return mixed
     */
    public function get_sortable_columns()
    {
        $columns = [];
        if (PHP::isArray($this->descriptor["columnGroups"])) {
            foreach ($this->descriptor["columnGroups"] as $columnGroup) {
                if (PHP::isArray($columnGroup)) {
                    foreach ($columnGroup["columns"] as $column) {
                        if ($column["sortable"] === true) {
                            $columns[] = $column["name"];
                        }
                    }
                }
            }
        }
        return $columns;
    }
    /**
     * method
     * 
     * @return mixed
     */
    public function get_bulk_actions()
    {
        $actions = array();
        return $actions;
    }
    /**
     * method
     * 
     * @return mixed
     */
    public function process_bulk_action()
    {
        if ($this->current_action() !== '') {
            //die($this->current_action());
            if ($this->current_action() === 'delete') {
                //die('DELETE X');
            }
        }
    }
    /**
     * method
     * 
     * @return mixed
     */
    public function &get_data()
    {
        return $this->data;
    }
    /**
     * method
     * 
     * @return mixed
     */
    public function prepare_items()
    {
        $perPage = 10;
        $data = $this->get_data();
        $this->process_bulk_action();
        $hidden = [];
        $columns = $this->get_columns();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = [$columns, $hidden, $sortable, "cb"];
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);
        $this->items = array_slice($data, ($currentPage - 1) * $perPage, $perPage);
        $this->set_pagination_args(['total_items' => $totalItems, 'total_pages' => ceil($totalItems / $perPage), 'per_page' => $perPage]);
    }
    /**
     * method
     * 
     * @return mixed
     */
    public function display()
    {
        $this->prepare_items();
        $listAction = filter_input(INPUT_GET, Constants::LIST_ACTION_QUERYSTRING_PARAMETER, FILTER_DEFAULT);
        if ($this->descriptor['allowNew'] === true) {
            $page = PHP::filterInput('page', [INPUT_GET]);
            $url = WP::getAdminUrl('admin') . '?page=' . $page . "&list={$this->descriptor['id']}";
            if ($url === null) {
                throw new WordPressHelperException("'REQUEST_URI' is NULL.");
            }
            if ($listAction === null || $listAction !== null && $listAction !== 'create') {
                $url .= '&' . Constants::LIST_ACTION_QUERYSTRING_PARAMETER . '=create';
                if (array_key_exists('key', $this->descriptor)) {
                    $url .= '&key=' . $this->descriptor['key'];
                }
                $paged = PHP::toInt(PHP::filterInput('paged', [INPUT_GET]));
                if ($paged) {
                    $url .= "&paged={$paged}";
                }
            }
            if (!PHP::isEmpty(WP::getCurrentAdminPage())) {
                WP::addAdminPageAction(WP::getCurrentAdminPage(), "Add New " . ucfirst($this->_args['singular']), $url);
            }
        }
        parent::display();
    }
    /**
     * method
     * 
     * 
     * @return mixed
     */
    protected function set_pagination_args($args)
    {
        $args = wp_parse_args($args, ['total_items' => 0, 'total_pages' => 0, 'per_page' => 0]);
        if (!$args['total_pages'] && $args['per_page'] > 0) {
            $args['total_pages'] = ceil($args['total_items'] / $args['per_page']);
        }
        $this->_pagination_args = $args;
    }
}