<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

call_user_func(function () {
    
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'ARM.Armip2location',
        'loc',
        [
            'Location' => 'switcher, visitCom'
        ],
        // non-cacheable actions
        [
            'Location' => 'switcher, visitCom'
        ]
    );
});
