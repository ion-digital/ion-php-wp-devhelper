<?php

namespace ion\WordPress\Helper;

use \ion\SemVerInterface;
use \ion\WordPress\Helper\WordPressHelperLogInterface;

interface HelperContextInterface {

    static function uninstall(): void;

    function setParent(HelperContextInterface $context = null): HelperContextInterface;

    function getParent(): ?HelperContextInterface;

    function hasParent(): bool;

    function getChildren(): array;

    function hasChildren(): bool;

    function addChild(HelperContextInterface $child): void;

    function getLog(): WordPressHelperLogInterface;

    function isInitialized(): bool;

    function isFinalized(): bool;

    function getId(): int;

    function getPackageName(): string;

    function getVendorName(): string;

    function getProjectName(): string;

    function isPrimary(): bool;

    function getWorkingUri(): string;

    function getWorkingDirectory(): string;

    function getLoadPath(): string;

    function getInitializeOperation(): ?callable;

    function getFinalizeOperation(): ?callable;

    function getActivateOperation(): ?callable;

    function getDeactivateOperation(): ?callable;

    function getUninstallOperation(): ?array;

    function setInitializeOperation(callable $operation = null): ?HelperContextInterface;

    function setFinalizeOperation(callable $operation = null): ?HelperContextInterface;

    function setActivateOperation(callable $operation = null): HelperContextInterface;

    function setDeactivateOperation(callable $operation = null): HelperContextInterface;

    function setUninstallOperation(array $operation = null): HelperContextInterface;

    function hasInitializeOperation(): bool;

    function hasFinalizeOperation(): bool;

    function hasActivateOperation(): bool;

    function hasDeactivateOperation(): bool;

    function hasUninstallOperation(): bool;

    function invokeInitializeOperation(): void;

    function invokeFinalizeOperation(): void;

    function invokeActivateOperation(): void;

    function invokeDeactivateOperation(): void;

    function invokeUninstallOperation(): void;

    function getType(): int;

    function getActivationTimeStamp(): ?int;

    function getVersion(): ?SemVerInterface;

    function getActivationVersion(): ?SemVerInterface;

    function getTemplates(

        bool $flat = true,
        bool $themeOnly = false,
        bool $labels = false,
        string $nullItem = null,
        string $relativePath = null

    ): array;

    function templateExists(string $name): bool;

    function extend(string $name, callable $extension): void;

    function __call(string $name, array $arguments);

}
