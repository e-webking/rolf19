<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}
call_user_func(function () {
    
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'ARM.Armdealers',
        'map',
        [
            'Dealer' => 'list'
        ],
        // non-cacheable actions
        [
            'Dealer' => 'list'
        ]
    );
    
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'ARM.Armdealers',
        'maplink',
        [
            'Dealer' => 'maplink'
        ],
        // non-cacheable actions
        [
            'Dealer' => 'maplink'
        ]
    );
    
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'ARM.Armdealers',
        'form',
        [
            'Dealer' => 'form,thankyou'
        ],
        // non-cacheable actions
        [
            'Dealer' => 'form,thankyou'
        ]
    );
    
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals']['ARM\\Armdelaers\\Evaluation\\FloatEvaluation'] = '';
});
