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
    
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'ARM.Armip2location',
        'zuerich',
        [
            'Location' => 'toZuerich'
        ],
        // non-cacheable actions
        [
            'Location' => 'toZuerich'
        ]
    );
    
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'ARM.Armip2location',
        'rapperswil',
        [
            'Location' => 'toRapperswil'
        ],
        // non-cacheable actions
        [
            'Location' => 'toRapperswil'
        ]
    );
});

//$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['armip2location'] = \ARM\Armip2location\Controller\LocationController::class . '::findDealerAction';