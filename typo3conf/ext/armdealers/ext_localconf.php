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
    
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'ARM.Armdealers',
        'category',
        [
            'Product' => 'category'
        ],
        // non-cacheable actions
        [
            'Product' => 'category'
        ]
    );
    
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'ARM.Armdealers',
        'pgroup',
        [
            'Product' => 'group'
        ],
        // non-cacheable actions
        [
            'Product' => 'group'
        ]
    );
    
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'ARM.Armdealers',
        'product',
        [
            'Product' => 'show'
        ],
        // non-cacheable actions
        [
            'Product' => 'show'
        ]
    );
    
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals']['ARM\\Armdelaers\\Evaluation\\FloatEvaluation'] = '';
});

$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['armdealer'] = \ARM\Armdealers\Controller\DealerController::class . '::dlrmsgAction';