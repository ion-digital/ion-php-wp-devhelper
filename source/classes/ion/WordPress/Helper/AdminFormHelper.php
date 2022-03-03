<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper;

/**
 * Description of AdminFormHelper
 *
 * @author Justus
 */

use \ion\WordPress\Helper\Constants;
use \ion\WordPress\WordPressHelper as WP;
use \ion\PhpHelper as PHP;
use \WP_Post;
use \WP_Term;
use \WP_User;
use \WP_Comment;

class AdminFormHelper implements AdminFormHelperInterface {
    
    private const WP_HELPER_LEGACY = 'WP_HELPER_LEGACY';
    
    public static function createGroupDescriptorInstance(string $title = null, string $description = null, string $id = null, int $columns = null): array {    

        return [
            
            "id" => (string) $id,
            "columns" => /* int or null (do not uncomment!) */ $columns,
            "title" => (string) $title,
            "description" => (string) $description,
            "fields" => (array) []
        ];
    }
    
    private $useSerialization;
    private $descriptor;
    private $group;
    private $processed;
    private $output;

    private $redirectProcessor;
    private $optionPrefix;
    private $foreignKeys;
    
    private $onReadHandlers;
    private $onCreateHandlers;
    private $onUpdateHandlers;
    
    private $rendered;
    
    public function __construct(array &$descriptor) {
        $this->descriptor = &$descriptor;
        $this->group = &$descriptor["groups"][0];
        $this->processed = false;
        $this->output = null;
        $this->foreignKeys = [];        
        
        $this->onReadHandlers = [];
        $this->onCreateHandlers = [];
        $this->onUpdateHandlers = [];        
        
        $this->setOptionPrefix(null);
        $this->setUseSerialization(defined(self::WP_HELPER_LEGACY) && constant(self::WP_HELPER_LEGACY) === true ? true : false );

        $this->rendered = false;
    }
    
    public function onRead(callable $onRead = null): AdminFormHelperInterface {
        
        if($this->rendered) {
            
            return $this;
        }
        
        $this->onReadHandlers[] = $onRead;
        return $this;
    }
    
    public function onCreate(callable $onCreate = null): AdminFormHelperInterface {
        
        if($this->rendered) {
            
            return $this;
        }
        
        $this->onCreateHandlers[] = $onCreate;
        return $this;        
    }
    
    public function onUpdate(callable $onUpdate = null): AdminFormHelperInterface {
                
        
        if($this->rendered) {
            
            return $this;
        }        
        
        $this->onUpdateHandlers[] = $onUpdate;
        return $this;        
    }    
    
    public function getId(): string {
        
        return $this->descriptor['id'];
    }
    
    public function addGroup(string $title = null, string $description = null, string $id = null, int $columns = null): AdminFormHelperInterface {

        if($this->rendered) {
            
            return $this;
        }
        
        $groupDescriptor = static::createGroupDescriptorInstance($title, $description, $id, $columns);

        if ((count($this->descriptor["groups"]) === 1) && (count($this->descriptor["groups"][0]["fields"]) === 0 )) {
            $this->descriptor["groups"][0] = $groupDescriptor;
        } else {
            $this->descriptor["groups"][] = $groupDescriptor;
        }

        $this->group = &$this->descriptor["groups"][count($this->descriptor["groups"]) - 1];

        return $this;
    }
    
    public function addField(array $fieldDescriptor): AdminFormHelperInterface {
        
        if($this->rendered) {
            
            return $this;
        }
        
        $this->group["fields"][] = $fieldDescriptor;
        return $this;
    }
    
    public function addForeignKey(string $name, int $value): AdminFormHelperInterface {
        
        if($this->rendered) {
            
            return $this;
        }
        
        $this->foreignKeys[$name] = $value;
        
        return $this;
    }

    public function processAndRender(bool $echo = true, int $post = null): string {
        
        $this->process($post);
        return $this->render($echo);
    }
    
    private function setOption(string $key, /* mixed */ $value = null, int $metaId = null, string $type = null): void {
    
        if($metaId === null && $type !== null) {
            
            $type = WP_Post::class;
        }                    
        
        if($this->getUseSerialization()) {
            
            $value = ($value === null ? null : @unserialize($value));
        }
        
        if($type === WP_Post::class) {

            WP::setPostOption($key, $metaId, $value);
            return;
        }

        if($type === WP_Term::class) {

            WP::setTermOption($key, $metaId, $value);
            return;
        }

        if($type === WP_User::class) {

            WP::setUserOption($key, $metaId, $value);
            return;
        }

        if($type === WP_Comment::class) {

            WP::setCommentOption($key, $metaId, $value);
            return;
        }

        WP::setSiteOption($key, $value);
        return;
    }
    
    private function getOption(string $key, /* mixed */ $default = null, int $metaId = null, string $type = null) { 
        
        if($metaId === null && $type !== null) {
            
            $type = WP_Post::class;
        }        

        $dbValue = null;
        
        if($metaId !== null) {
        
            if($type === WP_Post::class) {

                $dbValue = WP::getPostOption($key, $metaId);
            }

            else if($type === WP_Term::class) {

                $dbValue = WP::getTermOption($key, $metaId);
            }

            else if($type === WP_User::class) {

                $dbValue = WP::getUserOption($key, $metaId);
            }

            else if($type === WP_Comment::class) {

                $dbValue = WP::getCommentOption($key, $metaId);
            }

            else {

                $dbValue = WP::getSiteOption($key);
            }
            
        } else {
            
            $dbValue = WP::getSiteOption($key);
        }
        
        if($this->getUseSerialization()) {
            
            $dbValue = ($dbValue === null ? null : @unserialize($dbValue));
        }                
        
        return $dbValue;
    }

    private function renderRows(array &$state, /* int */ $columns, array $rows, array $data = null, int $metaId = null) {

        $output = "";

//        var_Dump($data);

        foreach ($rows as $row) {

            $scope = "";
            if ($columns === 1) {
                $scope = " scope=\"row\"";
            }

            $span = (count($row) === 1 ? true : false);

            $spanClass = "";
            $colSpan = "";

            if ($span === true) {

                if ($columns > 1) {
                    $colSpan = " colspan=\"" . (($columns * 2) - 1) . "\"";
                }

                $spanClass = " class=\"spanned\"";
                
            } else {
                
                if ($columns > 1) {

                    if ($columns > 2) {
                        
                        $colSpan = " colspan=\"" . ($columns * 2) / count($row) . "\"";
                        
                    } else {
                        
                        $colSpan = " colspan=\"" . (($columns * 2) - count($row)) / count($row) . "\"";
                    }
                }
            }

            $output .= <<<TEMPLATE
            <tr$spanClass>
TEMPLATE;

            //$hiddenFields = filter_input(INPUT_GET, '', FILTER_DEFAULT);

            foreach ($row as $field) {

                $fieldName = $field['name'];
                $id = $field['id'];                
                $name = $fieldName;                  
                
                if($this->getOptionPrefix() !== null) {
                    
                    $id = "{$this->getOptionPrefix()}:{$id}";                
                    $name = "{$this->getOptionPrefix()}:{$name}";                
                }
                
                $label = $field['label'];                
                $hint = $field['hint'];
                $hidden = (array_key_exists('hidden', $field) && $field['hidden'] === true);

                $value = null;
                
                if (!array_key_exists($fieldName, $_POST)) {

                    $loadProcessor = $field["load"];

                    $dbValue = '';

                    if ($data !== null) {
                        
                        if (array_key_exists($field["name"], $data)) {
                            $dbValue = $data[$field["name"]];
                        }
                    } else {
                        
                        if(array_key_exists('name', $field) && !$state['create']) {
                            
//                            $dbValue = WP::getOption($field['name'], '', $metaId, null, $this->getRawOptionOperations());
                            $dbValue = $this->getOption($field['name'], '', $metaId, null);
                            
                        }
                    }

                    $value = ($loadProcessor === null ?  $dbValue : $loadProcessor($dbValue));
                    
                } else {
                    
                    $value = filter_input(INPUT_POST, $field["name"]);
                }

                if ($fieldName === $state['key'] && $state['update'] === true && $this->descriptor['hideKey'] === true) {

                    $output .= '<input type="hidden" name="' . $name . '" value="' . $value . '" />' . "\n";
                
                    
                } else {

                    $html = null;

                    if ($fieldName === $state['key'] && $state['update'] === true) {
                        
                        $html .= '<input type="text" name="' . $name . '" value="' . $value . '" disabled />';
                                            
                    } else {
                        
                        $html = $field["html"]($value, $state['key'], $state['record'], $name, $id);
                    }
                    
                    $hintHtml = (($hint !== null) && (strlen($hint) > 0)) ? "" . $hint . "" : "";

                    if(!$hidden) {
                        
                        $p = (PHP::isEmpty($hintHtml) ? "" : "<p id=\"{$id}-hint\">{$hintHtml}</p>");
                        
                        if ($columns < 3 /* || $span === true */) {

                            $output .= <<<TEMPLATE
                <th$scope colspan="1">
                    <span>
                        <label for="$name">$label</label>
                    </span>
                </th>
                <td$colSpan$spanClass>
                    <span>
                        $html
                        $p
                    </span>
                </td>
TEMPLATE;
                        } else {

                        $output .= <<<TEMPLATE

                <td$colSpan$spanClass>
                    <table>
                        <th$scope>
                            <span>
                                <label for="$name">$label</label>
                            </span>
                        </th>  
                    </table>
                    <span>
                        $html
                        $p
                    </span>
                </td>
TEMPLATE;
                        }
                        
                    } else {
                        
                        $output .= <<<TEMPLATE

                <td$colSpan$spanClass style="display:none;">
                    $html
                </td>
TEMPLATE;
                    }
                }
            }
            $output .= <<<TEMPLATE
            </tr>
TEMPLATE;
        }

        /* ?><!--<pre><?php print_r($rows); ?></pre>--><?php */


        return $output;
    }
    
    private static function getDescriptorKeys(array $descriptor) {
        
        $keys = [];

        foreach($descriptor["groups"] as $group) {
            
            foreach($group["fields"] as $field) {

                $keys[] = $field["name"];
            }
        }
        
        return $keys;
    }
    
    public function render(bool $echo = true): string {

        if ($this->output !== null) {
            
            return $this->output;
        }

        $this->rendered = true;
        
//        $title = $this->descriptor["title"];

        $formAction = null;
        $action = Constants::FORM_ACTION_PREFIX . '_' . $this->descriptor['id'];

        $data = null;
                
        $postReferrer = null;
        
        $page = PHP::toString(filter_input(INPUT_GET, 'page', FILTER_DEFAULT));        
        $form = PHP::toString(filter_input(INPUT_GET, 'form', FILTER_DEFAULT));

        $state = [
            
            'create' => (filter_input(INPUT_GET, Constants::LIST_ACTION_QUERYSTRING_PARAMETER, FILTER_DEFAULT) === 'create'),
            'update' => (filter_input(INPUT_GET, Constants::LIST_ACTION_QUERYSTRING_PARAMETER, FILTER_DEFAULT) === 'update'),
            'record' => (filter_input(INPUT_GET, 'record', FILTER_DEFAULT)),
            'key' => (filter_input(INPUT_GET, 'key', FILTER_DEFAULT))
        ];        
        
        global $pagenow;        
        
        $isPost = in_array($pagenow, ['post-new.php', 'post.php']);
        $isTerm = in_array($pagenow, ['term.php', 'edit-tags.php']);
        $isUser = in_array($pagenow, ['user-new.php', 'user-edit.php', 'profile.php']);           
        
        $isComment = false; //TODO 
        
        $isSettings = /* in_array($pagenow, ['admin.php', 'admin-post.php', 'tools.php']) && */ !$isPost && !$isTerm && !$isUser && !$isComment;        
        $isTable = $isSettings && PHP::filterInput('list-action', [INPUT_GET]);
        
        $metaId = null;
        $metaType = null;
        
        if($isPost) {
            
            $metaType = WP_Post::class;
            $metaId = PHP::filterInput('post', [INPUT_GET], FILTER_SANITIZE_NUMBER_INT);
        }
        
        if($isTerm) {
            
            $metaType = WP_Term::class;
            $metaId = PHP::filterInput('tag_ID', [INPUT_GET], FILTER_SANITIZE_NUMBER_INT);
        }

        if($isUser) {
            
            $metaType = WP_User::class;
            $metaId = PHP::filterInput('user_id', [INPUT_GET], FILTER_SANITIZE_NUMBER_INT);
            
            if($metaId === null) {
                
                $metaId = 1;
            }
        }    
        
        if($isComment) {
            
            $metaType = WP_Comment::class;
            
            //TODO
        }         
        
        if(!PHP::isEmpty($page)) {
            
            // This is a global settings page or a list edit page
            
            $paged = filter_input(INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT);
            $listAction = filter_input(INPUT_GET, 'list-action', FILTER_DEFAULT); 
  
            $postReferrer = WP::getAdminUrl('admin') . '?page=' . $page . (!PHP::isEmpty($form) ? '&form=' . $form : '') . (!PHP::isEmpty($paged) ? '&paged=' . $paged : '');
            
        } else {
            
            $postReferrer = filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_URL);            
        }

        // If we couldn't find a post referrer - keep this as a failsafe
    
        if(PHP::isEmpty($postReferrer)) {
            
            $postReferrer = WP::getAdminUrl('admin');         
        }

        
        if (!array_key_exists("action", $this->descriptor) || (array_key_exists("action", $this->descriptor) && $this->descriptor["action"] === null)) {
            
            if ($state['create'] === true) {                
                
                $formAction = '?' . Constants::LIST_ACTION_QUERYSTRING_PARAMETER . '=create';
                
            } else if ($state['update'] === true) {
                
                $formAction = '?' . Constants::LIST_ACTION_QUERYSTRING_PARAMETER . '=update';

                if ($state['record'] !== null && $state['key'] !== null) {
                    
                    $formAction .= '&record=' . $state['record'];

                    foreach($this->onReadHandlers as $handler) {
                        
                        $data = $handler($state['record'], $state['key'], $metaId, $metaType, static::getDescriptorKeys($this->descriptor));
                    }

                }
                
            } else {
                    
                foreach($this->onReadHandlers as $handler) {               

                    $data = $handler(null, null, $metaId, $metaType, static::getDescriptorKeys($this->descriptor));
                
                    if($data !== null && !PHP::isAssociativeArray($data) && PHP::isCountable($data) && count($data) > 0) {

                        if(PHP::isAssociativeArray($data[0])) {

                            $data = $data[0];
                            
                        } else {

                            throw new WordPressHelperException("Invalid data record returned from read processor.");
                        }
                    }
                }
            }

            if ($state['key'] !== null) {

                if ($formAction === null) {
                    
                    $formAction = '?';
                } else {
                    
                    $formAction .= '&';
                }

                $formAction .= 'key=' . $state['key'];
            }

            $formAction = WP::getBackEndUri('admin-post.php') . ($formAction === null ? '' : $formAction);
            
        } else {
            
            $formAction = $this->descriptor["action"];
        }



        $output = '';
        $itemMarkup = '';
        
        if (strpos($formAction, '?') === false) {
            
            $formAction .= '?';
            
        } else {
            
            $formAction .= '&';
        }

        $formAction .= 'form=' . $this->descriptor['id'];

        if($isSettings || $isTable) {
        
            $output .= <<<TEMPLATE
    <form method="post" action="{$formAction}" novalidate="novalidate">
        <input type="hidden" name="action" value="{$action}" />
        <input type="hidden" name="__postAdmin" value="true" />
        <input type="hidden" name="__postReferrer" value="{$postReferrer}" />        
TEMPLATE;
        
            $output .= wp_nonce_field(null, null, false, false);
        }
        
        $output .= <<<TEMPLATE
        <input type="hidden" name="__postBack[{$this->getId()}]" value="1" />
        $itemMarkup
TEMPLATE;

        foreach($this->foreignKeys as $name => $value) {
            
        $output .= <<<TEMPLATE
        <input type="hidden" name="{$name}" value="$value" />
TEMPLATE;
        }
        
        $disabledCnt = 0;
        $fieldCnt = 0;
        
        foreach ($this->descriptor["groups"] as $group) {

            $columns = $group["columns"];

            if ($columns === null) {
                
                $columns = $this->descriptor["columns"];
            }

            $visibleFields = 0;
            
            foreach($group['fields'] as $field) {                
                
                if(array_key_exists('hidden', $field) && $field['hidden'] === true) {
                    
                    continue;
                }
                
                $visibleFields++;
            }
            
            if (($group["title"] !== null) && 
                ($this->descriptor["groups"][0]["title"] !== null) && 
                (PHP::count($this->descriptor["groups"]) > 1) &&
                ($visibleFields > 0))
            {

                $groupTitle = $group["title"];

                $output .= <<<TEMPLATE
        <h3 class="title">{$groupTitle}</h3>
TEMPLATE;
            }

            $groupDescription = "";
            if ($group["description"] !== null) {

                $groupDescription = $group["description"];
                $output .= <<<TEMPLATE
        <p>$groupDescription</p>
TEMPLATE;
            }

            $metaId = "";
            if ($group["id"] !== null) {
                $metaId = " id=\"" . $group["id"] . "\"";
            }

            $multiColumn = "";
            if ($columns > 1) {
                $multiColumn = " multi-column multi-column-$columns";
            }

            $output .= <<<TEMPLATE
        <table class="form-table$multiColumn"$metaId>
TEMPLATE;


            $rows = [];
            $row = [];

            foreach ($group["fields"] as &$field) {

                $span = $field["span"];

                if ($span === true && count($row) > 0) {
                    $rows[] = $row;
                    $row = [];
                }

                $row[] = &$field;
                //$row[] = &$field["label"];

                if ($span === true || count($row) === $columns) {
                    
                    $rows[] = $row;
                    $row = [];
                }
                
                if($field['disabled'] === true) {
                    
                    $disabledCnt++;
                }
                
                $fieldCnt++;
            }

            if (count($row) > 0) {
                $rows[] = $row;
            }

            $output .= $this->renderRows($state, $columns, $rows, $data);

            $output .= <<<TEMPLATE
        </table>
TEMPLATE;
        }

        $backBtn = '';
        $submitBtn = '';             

        if($isSettings || $isTable) {
        
            if (filter_input(INPUT_GET, 'list-action', FILTER_DEFAULT) !== null) {

                $paged = filter_input(INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT);
                $page = filter_input(INPUT_GET, 'page', FILTER_DEFAULT);

                $url = WP::getAdminUrl('admin') . '?page=' . $page . '&paged=' . $paged;

                $backBtn = '<a href="' . $url . '" id="btn-cancel" class="button">Cancel</a>';

            }

            $submitBtn = <<<BTN
<p class="submit">
    <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">$backBtn
</p>                
BTN;
        
        
            if($disabledCnt !== $fieldCnt) {
                
                $output .= <<<TEMPLATE
$submitBtn
TEMPLATE;
                    
                if($isTable) {      
                    
                    $output .= <<<TEMPLATE
    </form>                    
TEMPLATE;
                }
            
            } else {
                $output .= $backBtn;
            }
        }

        $this->output = $output;

        if ($echo === true) {
            echo $output;
        }


        return $output;
    }

    private static function getTypeParameter($field, /* mixed */ $value) /* : string */ {

        switch ($value) {
            
            case is_bool($value):
            case is_int($value):
            case is_float($value):
            case is_double($value): {
                
                return '%d';
            }
            default: {
                
                return '%s';
            }
        }
    }        
    
    public function setOptionPrefix(string $optionPrefix = null): AdminFormHelperInterface {
        
        $this->optionPrefix = $optionPrefix;
        return $this;
    }
    
    public function getOptionPrefix(): ?string {
        
        return $this->optionPrefix;
    }
    
    public function setUseSerialization(bool $useSerialization): AdminFormHelperInterface {
        
        $this->useSerialization = $useSerialization;
        return $this;
    }
    
    public function getUseSerialization(): bool {
        
        return $this->useSerialization;
    }    
   
    
    public function readFromOptions(string $optionName = null): AdminFormHelperInterface {
        
        $self = $this;

        if($optionName !== null) {
            
            return $this->onRead(function(
                    
                /* string */ $record = null, 
                string $key = null, 
                int $metaId = null, 
                string $type = null,
                array $descriptor = []
                    
            ) use ($self, $optionName) {

//                        $optionRecords = WP::getOption($optionName, [], $metaId, $type, $this->getRawOptionOperations());                    

                        $optionRecords = $this->getOption($optionName, [], $metaId, $type);                    
                
                        $result = null;

                        if (PHP::isCountable($optionRecords) && count($optionRecords) > 0) {

                            $result = [];

                            if ($record !== null && array_key_exists((string) $record, $optionRecords)) {

                                $result = $optionRecords[(string) $record];
                            } else {

                                foreach($optionRecords as $optionRecord) {

                                    $result[] = $optionRecord;
                                }
                            }
                        }

                        return $result;
                    });
        }
        
        return $this->onRead(function(
                
            /* string */ $record = null,
            string $key = null,
            int $metaId = null,
            string $type = null,
            array $descriptor = []) use ($self) {
        
            $result = null;
            
            foreach ($self->descriptor['groups'] as $group) {

                foreach ($group['fields'] as $field) {
                    
                    $key = $field['name'];                                    
                    
//                    $result[$key] = WP::getOption(($this->getOptionPrefix() !== null ? $this->getOptionPrefix() . ':' : '') . $key, null, $metaId, $type, $this->getRawOptionOperations());
                    $result[$key] = $this->getOption(($this->getOptionPrefix() !== null ? $this->getOptionPrefix() . ':' : '') . $key, null, $metaId, $type); 
                }
            }            

            return $result;
        });
    }
    
    public function updateToOptions(string $optionName = null): AdminFormHelperInterface {
        
        $self = $this;

        if($optionName !== null) {
            
            return $this->onUpdate(function (
                    
                $index, 
                $newValues, 
                $oldValues, 
                $key = null, 
                int $metaId = null, 
                string $type = null
                    
            ) use ($self, $optionName) {

//                        $optionRecords = WP::getOption($optionName, [], $metaId, $type, $this->getRawOptionOperations());
                        $optionRecords = $this->getOption($optionName, [], $metaId, $type);
                
                if (count($optionRecords) > 0) {

                    if ((array_key_exists((string) $index, $optionRecords) && $metaId === null) || $metaId !== null) {

                        $optionRecord = [];

                        if($metaId === null) {

                            $optionRecord = $optionRecords[(string) $index];                                                   

                            foreach ($newValues as $key => $value) {

                                $optionRecord[$key] = $value;
                            }         

                            $optionRecords[(string) $index] = $optionRecord;

                        } else {

                            $optionRecord = [];

                            foreach ($newValues as $key => $value) {

                                $optionRecord[$key] = $value;
                            }    

                            $optionRecords = [$optionRecord];
                        }                            
                    } 
                }

//                        WP::setOption($optionName, $optionRecords, $metaId, $type, $this->getRawOptionOperations());
                        $this->setOption($optionName, $optionRecords, $metaId, $type);
                    });
        }
        

        
        return $this->onUpdate(function (
                
            $index, 
            $newValues, 
            $oldValues, 
            $key = null, 
            int $metaId = null, 
            string $type = null,
            array $descriptor = []
                
        ) use ($self) {
            
            $options = [];
            
            foreach($oldValues as $key => $value) {
                                
                $options[($this->getOptionPrefix() !== null ? $this->getOptionPrefix() . ':' : '') . $key] = $value;
            }            
            
            foreach($newValues as $key => $value) {
                                
                $options[($this->getOptionPrefix() !== null ? $this->getOptionPrefix() . ':' : '') . $key] = $value;
            }
            
            foreach($options as $key => $value) {
                
//                WP::setOption($key, $value, $metaId, $type, $this->getRawOptionOperations());
                $this->setOption($key, $value, $metaId, $type);
            }            
            
            return;
        });
    }
    

    
    public function createToOptions(string $optionName = null): AdminFormHelperInterface {
        
        $self = $this;

        if($optionName !== null) {
                    
            return $this->onCreate(function (
                    
                array $values, 
                string $key = null, 
                int $metaId = null, 
                string $type = null
                    
            ) use ($optionName) {

//                        $optionRecords = WP::getOption($optionName, [], $metaId, $type, $this->getRawOptionOperations());
                $optionRecords = $this->getOption($optionName, [], $metaId, $type);

                if(array_key_exists($key, $values)) {

                    $optionRecords[$values[(string) $key]] = $values;

                } else {

                    $optionRecords[] = $values;
                }

//                        WP::setOption($optionName, $optionRecords, $metaId, $type, $this->getRawOptionOperations());                        
                $this->setOption($optionName, $optionRecords, $metaId, $type);
                return;
            });
        }
        
        return $this->onCreate(function (
                
            array $values, 
            string $key = null, 
            int $metaId = null, 
            string $type = null
                
        ) use ($optionName) {
           
            $options = [];              
            
            foreach($values as $key => $value) {
                                
                $options[($this->getOptionPrefix() !== null ? $this->getOptionPrefix() . ':' : '') . $key] = $value;
            }

            foreach($options as $key => $value) {
                
//                WP::setOption($key, $value, $metaId, $type, $this->getRawOptionOperations());
                $this->setOption($key, $value, $metaId, $type);
                return;
            }     
        });
    }         
        
    public function redirect(callable $redirect): AdminFormHelperInterface {
        
        $this->redirectProcessor = $redirect;
        return $this;
    }   
    
   public function process(int $metaId = null, string $metaType = null) {
       
        if ($this->processed === false) {

            $postBack = filter_input(INPUT_POST, '__postBack', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            
            if(!$postBack || $postBack === null) {
                
                $postBack = [];
            }            
            
            if (array_key_exists($this->getId(), $postBack)) {                           
                
                // Verify the Nonce
                
                $nonce = PHP::filterInput('_wpnonce', [INPUT_POST]);
                
                $fields = [];

                foreach ($this->descriptor["groups"] as $group) {
                    
                    foreach ($group["fields"] as $field) {
                        
                        $fields[] = $field;
                    }
                }

                if($metaId === null) {
                    
                    $tmp = filter_input(INPUT_GET, 'post', FILTER_DEFAULT);                    
                    
                    if($tmp !== false) {
                        
                        $metaId = $tmp;
                    }
                }                
       
                
                $state = [
                    
                    'create' => PHP::toBool((PHP::filterInput(Constants::LIST_ACTION_QUERYSTRING_PARAMETER, [INPUT_GET]) === 'create')),
                    'update' => PHP::toBool((PHP::filterInput(Constants::LIST_ACTION_QUERYSTRING_PARAMETER, [INPUT_GET]) === 'update')),
                    'record' => PHP::toString((PHP::filterInput('record', [INPUT_GET]))),
                    'key' => PHP::toString($metaId !== null ? $this->getId() : PHP::filterInput('key', [INPUT_GET])),
                    'taxonomy' => PHP::toString(PHP::filterInput('taxonomy', [INPUT_GET]))
                ];

                $newValues = [];
                $oldValues = [];

                $data = null;                                  
                
                foreach($this->onReadHandlers as $handler) {
                    
                    $data = $handler($state['record'], $state['key'], $metaId, $metaType, static::getDescriptorKeys($this->descriptor));
                                        
                    // We want the read processor to return nulls; but for updating, we only want to know which values are not null.
                    if($data !== null && PHP::isAssociativeArray($data)) {
                        
                        foreach($data as $key => $value) {
                            
                            if($value === null) {
                                
                                unset($data[$key]);
                            }
                        }
                    }
                }
                                
                // Edit form
                foreach ($fields as $field) {

                    $fieldName = $field['name'];
                    
                    $name = $fieldName;
                    
                    if($this->getOptionPrefix()) {
                        
                        $name = "{$this->getOptionPrefix()}:{$name}";
                    }
                    
                    $isArray = filter_input(INPUT_POST, $name, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

                    $tmp = null;

                    $idFieldValue = null;
            
                    
                    if(filter_input(INPUT_POST, $name, FILTER_DEFAULT) !== null) {
                    
                        if ($isArray === false) {
                            
                            $idFieldValue = filter_input(INPUT_POST, $name, FILTER_DEFAULT);
                            
                        } else {
                            
                            $idFieldValue = serialize(filter_input(INPUT_POST, $name, FILTER_DEFAULT, FILTER_FORCE_ARRAY));
                        }
                    }
                    else {
                        //TODO: Investigate why filter_input refuses to recognise integer-named fields
                        
                        if(array_key_exists($name, $_POST)) {
                            
                            $idFieldValue = (string) $_POST[$name];
                        }
                    }                 

                    $postProcessor = $field['post'];
                    $loadProcessor = $field['load'];

                    $newProcessedValue = ($postProcessor === null ? ($idFieldValue === null ? null : (string) $idFieldValue) : $postProcessor($idFieldValue));
                    
                    if ($data !== null) {
                        

                        
                        $loadFieldValue = null;
                        
                        if(PHP::isCountable($data)) {
                        
                            if(PHP::isAssociativeArray($data)) {
                                if(array_key_exists($field['name'], $data)) {
                                    
                                    $loadFieldValue = $data[$field['name']];
                                    //var_dump($loadFieldValue);
                                }
                            } 
                            else if(count($data) > 0 && array_key_exists($field['name'], $data[0])) {

                                if(array_key_exists($field['name'], $data[0])) {
                                    
                                    $loadFieldValue = $data[0][$field['name']];
                                    //var_dump($loadFieldValue);
                                }                         
                            }
                        
                        }
                        
                        $newLoadedValue = ($loadProcessor === null ? ($loadFieldValue === null ? null : $loadFieldValue) : $loadProcessor($loadFieldValue));
                        
                        if ($newLoadedValue !== null) {
                            
                            $oldValues[$field['name']] = $newLoadedValue;
                        }

                    }

                    $newValues[$field['name']] = $newProcessedValue;

                }

                foreach($this->foreignKeys as $key => $value) {

                    $newValues[$key] = $value;      
                }
                
                if ($state['create'] === false && $state['update'] === false) {
                    
                    if ($this->onUpdateHandlers === []) {
                        
                        foreach ($newValues as $key => $value) {
                            
                            $this->setOption($key, $value, $metaId, $metaType);
                        }

                    } else {

                        if(PHP::isInt($metaId) && (PHP::isCountable($oldValues) && count($oldValues) === 0)) {

                            foreach($this->onCreateHandlers as $handler) {
                                
                                $handler($newValues, $state['key'], $metaId, $metaType);
                            }
                            
                        } else {

                            foreach($this->onUpdateHandlers as $handler) {
                                
                                $handler($state['record'], $newValues, $oldValues, $state['key'], $metaId, $metaType);
                            }
                        }
                    }
                    
                } else if ($state['create'] === true && $state['update'] === false) {
                    
                    // List Edit Form
                    
                    foreach($this->onCreateHandlers as $handler) {

                        $handler($newValues, $state['key']);
                    }
                    
                } else if ($state['create'] === false && $state['update'] === true) {
                    
                    foreach($this->onUpdateHandlers as $handler) {

                        $handler($state['record'], $newValues, $oldValues, $state['key'], $metaId);
                    }
                }

                if ($this->redirectProcessor !== null) {

                    $tmp = $this->redirectProcessor;
                    $tmp($newValues);
                }

                if ($state['create'] === true || $state['update'] === true) {

                    $tmp = parse_url(filter_input(INPUT_POST, '__postReferrer', FILTER_SANITIZE_URL));
                    $scheme = (array_key_exists('scheme', $tmp) ? $tmp['scheme'] . '://' : '');
                    $host = (array_key_exists('host', $tmp) ? $tmp['host'] : '');
                    $path = (array_key_exists('path', $tmp) ? $tmp['path'] : '');

                    $query = [];

                    array_key_exists('query', $tmp) ? parse_str($tmp['query'], $query) : [];

                    if (array_key_exists('list-action', $query)) {
                        
                        while (array_key_exists('list-action', $query)) {
                            
                            unset($query['list-action']);
                        }

                        while (array_key_exists('record', $query)) {
                            
                            unset($query['record']);
                        }

                        while (array_key_exists('key', $query)) {
                            
                            unset($query['key']);
                        }

                        while (array_key_exists('list', $query)) {
                            
                            unset($query['list']);
                        }
                    }

                    $url = $scheme . $host . $path . (count($query) > 0 ? '?' . http_build_query($query) : '');                   

                    if($metaId === null) {
                        
                        WP::redirect($url);
                    }
                    
                } else {

                    $idReferrer = filter_input(INPUT_POST, '__postReferrer', FILTER_SANITIZE_URL);
  
                    if($idReferrer !== null) {
                                            
                        WP::redirect($idReferrer);
                    }
                }

                //WordPressHelper::notifySuccess("Settings saved.");           
            }
            
            $this->processed = true;
        }
    }

    //TODO: Verify if the following methods are working
    
    public function readFromSqlQuery(string $query): AdminFormHelperInterface {

        return $this->onRead(function(/* string */ $record = null) use ($query) {

            $post = filter_input(INPUT_GET, 'post', FILTER_DEFAULT);


            $state = [
                'record' => (filter_input(INPUT_GET, 'record', FILTER_DEFAULT)),
                'key' => (filter_input(INPUT_GET, 'key', FILTER_DEFAULT)),
                'form' => (filter_input(INPUT_GET, 'form', FILTER_DEFAULT))
            ];

            $postBack = filter_input(INPUT_POST, "__postBack_" . $this->descriptor["id"]);


            if ((bool) $postBack === true && $state['form'] !== null && $state['form'] != $this->getId()) {
                return [];
            }

            if ($record !== null) {

                global $wpdb;

                if ($state['key'] !== null) {

                    $query = "SELECT * FROM ( {$query} ) AS q WHERE CAST(`{$state['key']}` AS CHAR(255)) LKEInterface('{$wpdb->esc_like($record)}')";
                }
            }

            $result = WP::dbQuery($query);

            if (count($result) === 1) {
                
                return $result[0];
            }

            return [];
        });
    }   

    public function readFromSqlTable(string $tableNameWithoutPrefix, string $tableNamePrefix = null, string $recordField = null, int $recordId = null): AdminFormHelperInterface {

        global $wpdb;

        $table = ($tableNamePrefix === null ? $wpdb->prefix : $tableNamePrefix) . $tableNameWithoutPrefix;

        $post = filter_input(INPUT_GET, 'post', FILTER_DEFAULT);

        if(!PHP::isEmpty($post)) {
            
            $post = (int) $post;
        }                  

        $state = [
            'record' => (filter_input(INPUT_GET, 'record', FILTER_DEFAULT)),
            'key' => (filter_input(INPUT_GET, 'key', FILTER_DEFAULT)),
            'post' => $post
        ];

        $columns = [];
        
        if($state['key'] !== null && !in_array('`' . $state['key'] . '`', $columns)) {
            
            $columns = [ '`' . $state['key'] . '`' ];
        }
        
        
        foreach ($this->descriptor["groups"] as $group) {
            
            foreach ($group['fields'] as $field) {
                
                if(!in_array('`' . $field['name'] . '`', $columns)) {
                    
                    $columns[] = '`' . $field['name'] . '`';
                }
            }
        }
        
        foreach($this->foreignKeys as $key => $value) {
            
            if(!in_array('`' . $key . '`', $columns)) {

                $columns[] = '`' . $key . '`';
            }            
        }

        $columnsString = join(', ', $columns);

        $whereString = '';
        
        if($recordId !== null) {
            
            if($recordField === null) {
                
                throw new WordPressHelperException("If a record ID is specified ({$recordId}), a record field must be specified as well.");
            }
            
            $whereString = " WHERE `{$recordField}` = {$wpdb->esc_like($recordId)}";
            
        } else {
        
            if ($state['key'] !== null && $state['record'] !== null) {
                $whereString = ' WHERE CAST(`' . $state['key'] . '` AS CHAR(255)) LIKE (\'' . $wpdb->esc_like($state['record']) . '\')';

                if(!PHP::isEmpty($post) && ($recordField !== null)) {

                    $whereString .= " AND `{$recordField}` = {$wpdb->esc_like($state['record'])}";
                }
            }
        }

        return $this->readFromSqlQuery(<<<SQL
SELECT $columnsString FROM `$table`$whereString LIMIT 1
SQL
        );
    }
    
    public function updateToSqlTable(string $tableNameWithoutPrefix,  string $tableNamePrefix = null, string $recordField = null, int $recordId = null): AdminFormHelperInterface {

        $self = $this;

        return $this->onUpdate(function ($index, $newValues, $oldValues, $key, int $metaId = null) use ($self, $tableNameWithoutPrefix, $tableNamePrefix, $recordField, $recordId) {

            global $wpdb;

            $table = ($tableNamePrefix === null ? $wpdb->prefix : $tableNamePrefix) . $tableNameWithoutPrefix;

            $metaId = filter_input(INPUT_GET, 'post', FILTER_DEFAULT);

            if(!PHP::isEmpty($metaId)) {
                
                $metaId = (int) $metaId;
            }                    

            $state = [

                'key' => (filter_input(INPUT_GET, 'key', FILTER_DEFAULT)),
                'post' => $metaId
            ];

            $updates = [];

            foreach ($self->descriptor["groups"] as $group) {

                foreach ($group['fields'] as $field) {

                    if (array_key_exists($field['name'], $newValues) && $newValues[$field['name']] !== null) {

                        $updates[] = '`' . $field['name'] . '` = ' . static::getTypeParameter($field, $newValues[$field['name']]);
                    } else {

                        $updates[] = '`' . $field['name'] . '` = NULL';
                    }
                }
            }

            foreach($this->foreignKeys as $key => $value) {

                if(!in_array('`' . $key . '`', $updates)) {

                    $updates[] = '`' . $key . "` = %d";

                    $newValues[$key] = $value;
                }            
            }                    

            $updateString = join(', ', $updates);

            $whereString = '';

            if($recordId !== null) {

                if($recordField === null) {

                    throw new WordPressHelperException("If a record ID is specified ({$recordId}), a record field must be specified as well.");
                }

                $whereString = " WHERE `{$recordField}` = {$wpdb->esc_like($recordId)}";

            } else {                    

                if ($state['key'] !== null && $index !== null) {
                    
                    $whereString = ' WHERE CAST(`' . $state['key'] . '` AS CHAR(255)) LIKE (\'' . $wpdb->esc_like($index) . '\')';

                    if(!PHP::isEmpty($metaId) && ($postField !== null)) {

                        $whereString .= " AND `{$postField}` = {$wpdb->esc_like($state['record'])}";
                    }                        
                }
            }

            $sql = "UPDATE `$table` SET $updateString$whereString";

            WP::dbQuery($sql, array_filter(array_values($newValues), function($v) { 

                if($v === null) {
                    
                    return false;
                }

                return true; 

            }));

        });
    }
    
    public function createToSqlTable(string $tableNameWithoutPrefix,  string $tableNamePrefix = null): AdminFormHelperInterface {

        return $this->onCreate(function ($values, $key, int $metaId = null) use ($tableNameWithoutPrefix, $tableNamePrefix) {

            global $wpdb;

            $table = ($tableNamePrefix === null ? $wpdb->prefix : $tableNamePrefix) . $tableNameWithoutPrefix;


            $columns = [];
            
            foreach ($this->descriptor["groups"] as $group) {
                
                foreach ($group['fields'] as $field) {
                    
                    $columns['`' . $field['name'] . '`'] = static::getTypeParameter($field, $values[$field['name']]);

                    if (array_key_exists($field['name'], $values)) {
                        
                        $columns['`' . $field['name'] . '`'] = static::getTypeParameter($field, $values[$field['name']]);
                    
                    } else {
                        
                        $columns['`' . $field['name'] . '`'] = 'NULL';
                    }                            
                }
            }

            foreach($this->foreignKeys as $key => $value) {

                if(!in_array('`' . $key . '`', $columns)) {

                    $columns['`' . $key . '`'] = static::getTypeParameter(null, $value);
                }            
            }                       

            $insertColumnsString = join(', ', array_keys($columns));
            $insertValuesString = join(', ', array_values($columns));

            WP::dbQuery("INSERT INTO `$table` ($insertColumnsString) VALUES ($insertValuesString)", array_values($values));
        });
    }           
}
