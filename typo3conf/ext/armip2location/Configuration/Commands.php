<?php
/**
 * Commands to be executed by typo3, where the key of the array
 * is the name of the command (to be called as the first argument after typo3).
 * Required parameter is the "class" of the command which needs to be a subclass
 * of Symfony/Console/Command.
 * @deprecated since TYPO3 v9, will be removed in TYPO3 v10.0. Use symfony/console commands instead.
 */
return [
    // Overriding Symfony Help command to use Extbase-specific output
    'armip2location:import' => [
        'class' => \ARM\Armip2location\Command\ImportCommand::class
    ]
];