<?php

$appDir = dirname(__DIR__, 2);

$finder = PhpCsFixer\Finder::create()
    ->in($appDir . '/classes')
    ->in($appDir . '/tests')
    ->in($appDir . '/public')
    ->in($appDir . '/config')
    ->in($appDir . '/bootstrap')
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
    ->exclude('vendor')
    ->filter(function (\SplFileInfo $file) {
        if (in_array($file->getFilename(), ['api_integrations.php', 'data_visualizations.php'])) {
            return false;
        }
    });

$config = new PhpCsFixer\Config();

return $config->setRules(
    [
        '@PER-CS2.0' => true,
        'align_multiline_comment' => true,
        'array_syntax' => ['syntax' => 'short'],
        'class_attributes_separation' => [
            'elements' => [
                'const' => 'only_if_meta',
                'property' => 'only_if_meta',
                'method' => 'one',
                'trait_import' => 'none',
                'case' => 'none',
            ],
        ],
        'class_reference_name_casing' => true,
        'declare_parentheses' => true,
        'heredoc_indentation' => true,
        'include' => true,
        'magic_constant_casing' => true,
        'magic_method_casing' => true,
        'method_chaining_indentation' => true,
        'native_function_casing' => true,
        'native_type_declaration_casing' => true,
        'no_empty_comment' => true,
        'no_extra_blank_lines' => [
            'tokens' => [
                'attribute',
                'break',
                'case',
                'continue',
                'curly_brace_block',
                'default',
                'extra',
                'parenthesis_brace_block',
                'return',
                'square_brace_block',
                'switch',
                'throw',
            ],
        ],
        'no_mixed_echo_print' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_trailing_comma_in_singleline' => true,
        'no_whitespace_before_comma_in_array' => true,
        'ordered_class_elements' => [
            'sort_algorithm' => 'none',
            'order' => [
                'use_trait',
                'case',
                'constant_public',
                'constant_protected',
                'constant_private',
                'property_static',
                'property_public',
                'property_public_readonly',
                'property_protected',
                'property_protected_readonly',
                'property_private',
                'property_private_readonly',
                'construct',
                'destruct',
                'phpunit',
                'method_static',
                'method_public',
                'method_protected',
                'method_private',
                'magic',
            ]
        ],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'ordered_types' => ['null_adjustment' => 'always_last'],
        'single_line_comment_spacing' => true,
        'single_line_comment_style' => ['comment_types' => ['asterisk', 'hash']],
        'single_quote' => ['strings_containing_single_quote_chars' => false],
        'single_space_around_construct' => true,
        'trim_array_spaces' => true,
        'whitespace_after_comma_in_array' => ['ensure_single_space' => true],
    ]
)->setFinder($finder)
    ->setUsingCache(true)
    ->setCacheFile(__DIR__ . '/.php-cs-fixer.cache');
