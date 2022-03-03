<?php

namespace ion\WordPress\Helper;

use \ion\WordPress\Helper\AdminCustomizeHelperInterface;


/**
 * Description of RewriteApiTrait*
 * @author Justus
 */
interface OptionsInterface {

    static function getSiteOption(string $name, $default = null);

    static function setSiteOption(string $name, $value = null, bool $autoLoad = false): bool;

    static function hasSiteOption(string $name): bool;

    static function removeSiteOption(string $name): bool;

    static function getPostOption(string $name, int $metaId, $default = null);

    static function setPostOption(

        string $name,
        int $metaId,
        $value = null,
        bool $autoLoad = false

    ): bool;

    static function hasPostOption(string $name, int $metaId): bool;

    static function removePostOption(string $name, int $metaId, $value = null): bool;

    static function getTermOption(string $name, int $metaId, $default = null);

    static function setTermOption(

        string $name,
        int $metaId,
        $value = null,
        bool $autoLoad = false

    ): bool;

    static function hasTermOption(string $name, int $metaId): bool;

    static function removeTermOption(string $name, int $metaId, $value = null): bool;

    static function getUserOption(string $name, int $metaId, $default = null);

    static function setUserOption(

        string $name,
        int $metaId,
        $value = null,
        bool $autoLoad = false

    ): bool;

    static function hasUserOption(string $name, int $metaId): bool;

    static function removeUserOption(string $name, int $metaId, $value = null): bool;

    static function getCommentOption(string $name, int $metaId, $default = null);

    static function setCommentOption(

        string $name,
        int $metaId,
        $value = null,
        bool $autoLoad = false

    ): bool;

    static function hasCommentOption(string $name, int $metaId): bool;

    static function removeCommentOption(string $name, int $metaId, $value = null): bool;

    static function getCustomizationOption(string $name, $default = null);

    static function setCustomizationOption(string $name, $value = null): void;

    static function hasCustomizationOption(string $name): bool;

    static function removeCustomizationOption(string $name): void;

    static function addCustomizationSection(

        string $title,
        string $slug = null,
        int $priority = null,
        string $textDomain = null

    ): AdminCustomizeHelperInterface;

}
