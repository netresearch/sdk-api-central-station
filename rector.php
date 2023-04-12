<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Identical\SimplifyBoolIdenticalTrueRector;
use Rector\CodingStyle\Rector\Catch_\CatchExceptionNameMatchingTypeRector;
use Rector\CodingStyle\Rector\ClassMethod\UnSpreadOperatorRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Php80\Rector\FunctionLike\MixedTypeRector;
use Rector\Php80\Rector\FunctionLike\UnionTypesRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/test',
    ]);

    $rectorConfig->skip([
        __DIR__ . '/vendor',
    ]);

    $rectorConfig->phpstanConfig('phpstan.neon');
    $rectorConfig->importNames();
    $rectorConfig->removeUnusedImports();
    $rectorConfig->disableParallel();

    // Define what rule sets will be applied
    $rectorConfig->sets([
        SetList::PSR_4,
        SetList::EARLY_RETURN,
        SetList::ACTION_INJECTION_TO_CONSTRUCTOR_INJECTION,
        SetList::NAMING,
        SetList::TYPE_DECLARATION,
        SetList::CODING_STYLE,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        LevelSetList::UP_TO_PHP_81,
    ]);

    // Skip some rules
    $rectorConfig->skip([
        RemoveUselessParamTagRector::class,
        RemoveUselessReturnTagRector::class,
        CatchExceptionNameMatchingTypeRector::class,
        UnionTypesRector::class,
        MixedTypeRector::class,
        SimplifyBoolIdenticalTrueRector::class,
        ClassPropertyAssignToConstructorPromotionRector::class,
        UnSpreadOperatorRector::class,
    ]);
};
