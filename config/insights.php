<?php

declare(strict_types=1);

use NunoMaduro\PhpInsights\Domain\Insights\CyclomaticComplexityIsHigh;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenDefineFunctions;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenFinalClasses;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenNormalClasses;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenPrivateMethods;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenTraits;
use NunoMaduro\PhpInsights\Domain\Metrics\Architecture\Classes;
use NunoMaduro\PhpInsights\Domain\Metrics\Style\Style;
use NunoMaduro\PhpInsights\Domain\Sniffs\ForbiddenSetterSniff;
use ObjectCalisthenics\Sniffs\Classes\ForbiddenPublicPropertySniff;
use ObjectCalisthenics\Sniffs\Files\ClassTraitAndInterfaceLengthSniff;
use ObjectCalisthenics\Sniffs\Metrics\MethodPerClassLimitSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Arrays\DisallowLongArraySyntaxSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineEndingsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DisallowAlternativePHPTagsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DisallowShortOpenTagSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\LowerCaseConstantSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\LowerCaseKeywordSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\LowerCaseTypeSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\SyntaxSniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\Files\EndFileNewlineSniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\Methods\FunctionClosingBraceSniff;
use SlevomatCodingStandard\Sniffs\Classes\SuperfluousInterfaceNamingSniff;
use SlevomatCodingStandard\Sniffs\Commenting\DocCommentSpacingSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\AssignmentInConditionSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\DisallowEmptySniff;
use SlevomatCodingStandard\Sniffs\Namespaces\AlphabeticallySortedUsesSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DeclareStrictTypesSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DisallowMixedTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\TypeHintDeclarationSniff;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Preset
    |--------------------------------------------------------------------------
    |
    | This option controls the default preset that will be used by PHP Insights
    | to make your code reliable, simple, and clean. However, you can always
    | adjust the `Metrics` and `Insights` below in this configuration file.
    |
    | Supported: "default", "laravel", "symfony", "magento2", "drupal"
    |
    */

    'preset' => 'laravel',

    /*
    |--------------------------------------------------------------------------
    | Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may adjust all the various `Insights` that will be used by PHP
    | Insights. You can either add, remove or configure `Insights`. Keep in
    | mind that all added `Insights` must belong to a specific `Metric`.
    |
    */

    'exclude' => [
        //  'path/to/directory-or-file'
    ],

    'add' => [
        Classes::class => [
            ForbiddenFinalClasses::class,
        ],
        Style::class => [
            EndFileNewlineSniff::class,
            LineEndingsSniff::class,
            FunctionClosingBraceSniff::class,
            DisallowLongArraySyntaxSniff::class,
            DisallowAlternativePHPTagsSniff::class,
            DisallowShortOpenTagSniff::class,
            LowerCaseConstantSniff::class,
            LowerCaseKeywordSniff::class,
            SyntaxSniff::class,
        ],
    ],

    'remove' => [
        AlphabeticallySortedUsesSniff::class,
        DeclareStrictTypesSniff::class,
        ForbiddenDefineFunctions::class,
        ForbiddenNormalClasses::class,
        TypeHintDeclarationSniff::class,
        ForbiddenPublicPropertySniff::class,
        ForbiddenSetterSniff::class,
        AssignmentInConditionSniff::class,
        DisallowMixedTypeHintSniff::class,
        SuperfluousInterfaceNamingSniff::class,
        ForbiddenTraits::class,
    ],

    'config' => [
        ForbiddenPrivateMethods::class => [
            'title' => 'The usage of private methods is not idiomatic in Laravel.',
        ],
        ClassTraitAndInterfaceLengthSniff::class => [
            'maxLength' => 300,
        ],
        CyclomaticComplexityIsHigh::class => [
            'maxComplexity' => 15,
        ],
        MethodPerClassLimitSniff::class => [
            'maxCount' => 20,
        ],
        LineLengthSniff::class => [
            'lineLimit' => 150,
            'absoluteLineLimit' => 160,
        ],
        DocCommentSpacingSniff::class => [
            'linesCountBetweenDifferentAnnotationsTypes' => 1,
        ],
    ],
];
