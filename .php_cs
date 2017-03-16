<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php')
    ->exclude('bootstrap/cache')
    ->exclude('storage')
    ->exclude('vendor')
    ->notPath('_ide_helper_models.php')
    ->notPath('_ide_helper.php')
    ->notPath('.phpstorm.meta.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return PhpCsFixer\Config::create()
    ->setRules(array(
        '@Symfony' => true,
        'ordered_imports' => true,
        'array_syntax' => array('syntax' => 'short'),
    ))
    ->setFinder($finder);
