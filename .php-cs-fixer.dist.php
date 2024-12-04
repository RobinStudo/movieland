<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'global_namespace_import' => [
            'import_classes' => true,
        ],
        'concat_space' => [
            'spacing' => 'one',
        ],
    ])
    ->setFinder($finder)
;
