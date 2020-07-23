<?php

/*
 * See license information at the package root in LICENSE.md
 */

namespace ion\WordPress\Helper\Wrappers;

/**
 *
 * @author Justus
 */

use \ion\WordPress\Helper\IAdminCustomizeHelper;

interface IOptions {

    static function getSiteOption(string $name, /* mixed */ $default = null) /* mixed */;
    
    static function setSiteOption(string $name, /* mixed */ $value = null, bool $autoLoad = false): bool;
    
    static function hasSiteOption(string $name): bool;
    
    static function removeSiteOption(string $name): bool;   
    
    
    static function getPostOption(string $name, int $metaId, /* mixed */ $default = null) /* mixed */;
    
    static function setPostOption(string $name, int $metaId, /* mixed */ $value = null, bool $autoLoad = false): bool;
    
    static function hasPostOption(string $name, int $metaId): bool;
    
    static function removePostOption(string $name, int $metaId, $value = null): bool;      
    
    
    static function getTermOption(string $name, int $metaId, /* mixed */ $default = null) /* mixed */;
    
    static function setTermOption(string $name, int $metaId, /* mixed */ $value = null, bool $autoLoad = false): bool;
    
    static function hasTermOption(string $name, int $metaId): bool;
    
    static function removeTermOption(string $name, int $metaId, $value = null): bool;    


    static function getUserOption(string $name, int $metaId, /* mixed */ $default = null) /* mixed */;
    
    static function setUserOption(string $name, int $metaId, /* mixed */ $value = null, bool $autoLoad = false): bool;
    
    static function hasUserOption(string $name, int $metaId): bool;
    
    static function removeUserOption(string $name, int $metaId, $value = null): bool;        
    
    
    static function getCommentOption(string $name, int $metaId, /* mixed */ $default = null) /* mixed */;
    
    static function setCommentOption(string $name, int $metaId, /* mixed */ $value = null, bool $autoLoad = false): bool;
    
    static function hasCommentOption(string $name, int $metaId): bool;
    
    static function removeCommentOption(string $name, int $metaId, $value = null): bool;     

    
    static function addCustomizationSection(string $title, string $slug = null, int $priority = null, string $textDomain = null): IAdminCustomizeHelper;

    static function getCustomizationOption(string $name, /* mixed */ $default = null) /* mixed */;

    static function setCustomizationOption(string $name, /* mixed */ $value = null): void;
    
    static function hasCustomizationOption(string $name): bool;
    
    static function removeCustomizationOption(string $name): void;   

    
    
//    static function getOption(string $key, /* mixed */ $default = null, int $id = null, OptionMetaType $type = null, bool $raw = false) /* mixed */;
//    
//    static function setOption(string $key, /* mixed */ $value = null, int $id = null, OptionMetaType $type = null, bool $raw = false, bool $autoLoad = false): bool;
//    
//    static function hasOption(string $key, int $id = null, OptionMetaType $type = null): bool;
//    
//    static function removeOption(string $key,  int $postId = null, OptionMetaType $type = null): bool;     
//    
//    static function getRawOption(string $key, /* mixed */ $default = null, int $id = null, OptionMetaType $type = null) /* mixed */;
//    
//    static function setRawOption(string $key, /* mixed */ $value = null, int $id = null, OptionMetaType $type = null, bool $autoLoad = false): bool;    
}
