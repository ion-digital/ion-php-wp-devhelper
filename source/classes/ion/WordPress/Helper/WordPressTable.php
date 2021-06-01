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

use \WP_List_Table;
use \ion\WordPress\Helper\Constants;
use \ion\WordPress\WordPressHelper as WP;
use \ion\PhpHelper as PHP;

class WordPressTable extends WP_List_Table
{

    private $descriptor;
    private $data;

    public function __construct(array &$descriptor, array $rows)
    {

        parent::__construct(
            array(
                "singular" => $descriptor["singular"],
                "plural" => $descriptor["plural"],
                "ajax" => $descriptor["ajax"],
                'screen' => null
            )
        );

        $this->descriptor = $descriptor;
        $this->data = $rows;
    }

    //protected function column_default($item, $column_name) {


    /*
      $actions = array();

      $convertedItem = array_change_key_case($item, CASE_LOWER);

      $output = S::From($convertedItem[S::From($column_name . "")->ToLowerCase()->ToNativeValue()]);

      //echo $column_name . " vs. " , $this->GetForm()->GetDescriptor()->GetColumns()->Get(0)->GetId()->ToString() . "<br />";

      if ( S::From($column_name)->Matches($this->GetForm()->GetDescriptor()->GetColumns()->Get(I::From(0))->GetDataFieldName())->IsTrue() ) {


      $identity = $this->GetForm()->GetTableDescriptor()->GetIdentityDataField()->ToLowerCase()->ToNativeValue();


      if ( $this->GetForm()->GetActions()->Count()->ToNativeValue() > 0 ) {

      //var_dump($this->GetForm()->GetActions()->ToArray());

      foreach ( $this->GetForm()->GetActions()->ToArray() as $action ) {

      if ( ($action->ToNativeValue() === DataAction::Update) || ($action->ToNativeValue() === DataAction::Delete) ) {

      $actionCaption = S::Blank();
      $actionString = S::Blank();

      switch ( $action->ToNativeValue() ) {

      case DataAction::Update: {

      $actionCaption = S::From("Edit");
      $actionString = S::From("edit");

      break;
      }
      case DataAction::Delete: {

      $actionCaption = S::From("Delete");
      $actionString = S::From("delete");

      break;
      }
      }



      $url = static::GetListAction($actionString);




      //var_dump($item);

      // the id
      if ( array_key_exists($identity, $convertedItem) ) {
      $url->SetParameter(S::From("id"), Type::CreateFrom($convertedItem[$identity])->ToString());
      }



      //$url->SetParameter(String::From("test"), String::From("XXX"));

      $link = $url->ToString();
      $link = $link->Wrap(S::From("<a href=\""), S::From("\">"));
      $link = $link->Append($actionCaption);
      $link = $link->Append(S::From("</a>"));

      $actions[$actionCaption->ToNativeValue()] = $link->ToNativeValue();
      }
      }

      //var_dump($actions);
      }

      $output = $output->Append(S::From($this->row_actions($actions)));
      }

      //$output = $output->

      return $output->ToNativeValue();
     */
    //}

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

    protected function column_default($item, $column_name)
    {
        $selectedColumn = null;
        $actionColumn = false;

        $index = 0;

        if(PHP::isArray($this->descriptor["columnGroups"])) {
        
            foreach ($this->descriptor["columnGroups"] as $columnGroup) {
                
                if(!PHP::isArray($columnGroup)) {
                    
                    continue;
                }
                
                if(array_key_exists("columns", $columnGroup) && PHP::isArray($columnGroup["columns"])) {

                    foreach ($columnGroup["columns"] as $column) {
                        if ($column["name"] === $column_name) {
                            $selectedColumn = $column;

                            //if(strtolower($column_name) !== strtolower($this->descriptor['key']) && $actionColumn === false && $index < 1) {
                            if ($index < 1) {
                                $actionColumn = true;
                            }
                            //}
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

            if(!array_key_exists($column_name, $item)) {
                throw new WordPressHelperException("Column '$column_name' has not been defined in the row data.");
            }
            
            $output = $selectedColumn["html"]($item[$column_name]);

            if ($actionColumn === true) {

                $actions = [];

                //$url = $_SERVER['REQUEST_URI']; // We use this instead of filter_input for compatability with some PHP 5.6 servers

                $url = WP::getAdminUrl('admin') . '?page=' . PHP::filterInput('page', [ INPUT_GET ]) . "&list={$this->descriptor['id']}";
                
                if($url === null) {
                    
                    throw new WordPressHelperException("'REQUEST_URI' is NULL.");
                }
                
                $paged = PHP::toInt(PHP::filterInput('paged', [ INPUT_GET ]));
                
                if ($this->descriptor['allowEdit'] === true) {

                    $editUrl = $url . '&list-action=update&record=' . $item[$this->descriptor['key']] . '&key=' . $this->descriptor['key'] . (!PHP::isEmpty($paged) ? "&paged={$paged}" : "");

                    $output = '<a href="' . $editUrl . '">' . $output . '</a>';

                    $actions['edit'] = "<a href=\"$editUrl\">Edit</a>";
                }

                if ($this->descriptor['allowDelete'] === true) {

                    $deleteUrl = $url . '&list-action=delete&record=' . $item[$this->descriptor['key']] . '&key=' . $this->descriptor['key'];

                    $actions['delete'] = "<a href=\"$deleteUrl\">Delete</a>";
                }

                if (PHP::isArray($this->descriptor['additionalActions']) && (count($this->descriptor['additionalActions']) > 0)) {
                    foreach ($this->descriptor['additionalActions'] as $label => $callBack) {
                        $tmp = $callBack($item[$this->descriptor['key']]);

                        if ($tmp !== false) {
                            $actions[$tmp] = WP::applyTemplate($label, [
                                'record' => $item[$this->descriptor['key']]
                            ]);
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

    public function get_columns()
    {
        //$columns = ['cb' => '<input type="checkbox">'];
        if(PHP::isArray($this->descriptor["columnGroups"])) {
            foreach ($this->descriptor["columnGroups"] as $columnGroup) {
                if(PHP::isArray($columnGroup)) {
                    foreach ($columnGroup["columns"] as $column) {
                        $columns[$column["name"]] = $column["label"];
                    }
                }
            }
        }
        return $columns;
    }

    public function get_sortable_columns()
    {

        $columns = [];

        if(PHP::isArray($this->descriptor["columnGroups"])) {
            foreach ($this->descriptor["columnGroups"] as $columnGroup) {
                if(PHP::isArray($columnGroup)) {
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

    public function get_bulk_actions()
    {
        $actions = array(
            //'delete' => 'Delete'
        );

        return $actions;
    }

    public function process_bulk_action()
    {

        if ($this->current_action() !== '') {

            //die($this->current_action());

            if ($this->current_action() === 'delete') {

                //die('DELETE X');
            }
        }
    }


    public function &get_data()
    {
        return $this->data;
    }

    public function prepare_items()
    {

        $perPage = 10;

        $data = $this->get_data();

        $this->process_bulk_action();

        $hidden = [];
        $columns = $this->get_columns();
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [$columns, $hidden, $sortable, "cb"];


        /*
          usort($data, function($a, $b) {
          $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'title'; //If no sort, default to title
          $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
          $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
          return ($order === 'asc') ? $result : -$result; //Send final sort direction to usort
          });
         */

        $currentPage = $this->get_pagenum();
        $totalItems = count($data);
        $this->items = array_slice($data, (($currentPage - 1) * $perPage), $perPage);

        $this->set_pagination_args([
            'total_items' => $totalItems,
            'total_pages' => ceil($totalItems / $perPage),
            'per_page' => $perPage
        ]);
    }

    public function display()
    {
        $this->prepare_items();

        $listAction = filter_input(INPUT_GET, Constants::LIST_ACTION_QUERYSTRING_PARAMETER, FILTER_DEFAULT);

        if ($this->descriptor['allowNew'] === true) {

            //$url = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT);
            //$url = $_SERVER['REQUEST_URI']; // We use this instead of filter_input for compatability with some PHP 5.6 servers
            //$url = PHP::getServerRequestUri() . '&list=' . $this->descriptor['id'];
            
            $page = PHP::filterInput('page', [ INPUT_GET ]);
            
            $url = WP::getAdminUrl('admin') . '?page=' . $page . "&list={$this->descriptor['id']}";
            
            if($url === null) {
                throw new WordPressHelperException("'REQUEST_URI' is NULL.");
            }            
            
            if ($listAction === null || (($listAction !== null) && ($listAction !== 'create'))) {
                $url .= '&' . Constants::LIST_ACTION_QUERYSTRING_PARAMETER . '=create';
                
                if(array_key_exists('key', $this->descriptor)) {
                    $url .= '&key=' . $this->descriptor['key'];
                }
                
                $paged = PHP::toInt(PHP::filterInput('paged', [ INPUT_GET ]));
                
                if($paged) {
                    
                    $url .= "&paged={$paged}";
                }
            }

            if(!PHP::isEmpty(WP::getCurrentAdminPage())) {
            
                WP::addAdminPageAction(WP::getCurrentAdminPage(), "Add New " . ucfirst($this->_args['singular']), $url);
            }
            
//            echo '<a href="' . $url . '" class="page-title-action">Add New</a>';
        }
        
        parent::display();     
    }

    protected function set_pagination_args($args)
    {
        $args = wp_parse_args($args, [
            'total_items' => 0,
            'total_pages' => 0,
            'per_page' => 0
        ]);

        if (!$args['total_pages'] && $args['per_page'] > 0)
            $args['total_pages'] = ceil($args['total_items'] / $args['per_page']);

        // Redirect if page number is invalid and headers are not already sent.
//        if ( ! headers_sent() && ! wp_doing_ajax() && $args['total_pages'] > 0 && $this->get_pagenum() > $args['total_pages'] ) {
//			wp_redirect( add_query_arg( 'paged', $args['total_pages'] ) );
//			exit;
//			//echo "X";
//			//var_dump(! headers_sent() && ! wp_doing_ajax() && $args['total_pages'] > 0 && $this->get_pagenum() > $args['total_pages']);

//        }

        $this->_pagination_args = $args;
    }

}
