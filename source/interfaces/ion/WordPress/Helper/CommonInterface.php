<?php

namespace Ion\WordPress\Helper;

use \Ion\SemVerInterface;


/**
 * Description of CommonTrait*
 * @author Justus
 */
interface CommonInterface {

    static function applyTemplate(string $template, array $parameters): string;

    static function redirect(string $url, array $parameters = null, int $status = null);

    static function getSiteLink(array $controllers = null, array $parameters = null, bool $absolute = true): string;

    static function addScript(

        string $id,
        string $src,
        bool $backEnd = true,
        bool $frontEnd = false,
        bool $inline = false,
        bool $addToEnd = false,
        int $priority = 1,
        SemVerInterface $version = null,
        array $dependencies = []

    ): void;

    static function hasScript(string $id): bool;

    static function addStyle(

        string $id,
        string $src,
        bool $backEnd = true,
        bool $frontEnd = false,
        bool $inline = false,
        string $media = "screen",
        int $priority = 1,
        SemVerInterface $version = null,
        array $dependencies = []

    ): void;

    static function hasStyle(string $id): bool;

    static function isWordPress(): bool;

    static function isAdmin(bool $includeLoginPage = false): bool;

    static function isCustomizer(): bool;

    static function hasPermalinks(): bool;

    static function addImageSize(

        string $name,
        int $width = null,
        int $height = null,
        bool $crop = null,
        bool $selectable = null,
        string $caption = null

    ): void;

    static function exitWithCode(int $code): void;

    static function setCookie(

        string $name,
        string $value,
        int $expiryTimeStamp = null,
        string $domain = null,
        string $path = null,
        bool $secure = null,
        bool $httpOnly = null

    ): bool;

    static function getCurrentObjectType(bool $ignoreTheLoop = false): ?string;

    static function getCurrentObject(bool $ignoreTheLoop = false): ?object;

    static function getCurrentObjectId(bool $ignoreTheLoop = false): ?int;

}
