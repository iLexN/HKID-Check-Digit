<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/tests')
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        'concat_space' => ['spacing'=>'none'],
    ])
    ->setLineEnding("\n")
    ->setFinder($finder)
    ->setCacheFile(__DIR__.'/cache/.php_cs.cache');