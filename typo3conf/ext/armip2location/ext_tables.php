<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}
call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ARM.Armdealers',
            'form',
            'Kontakt Form'
        );
        
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ARM.Armdealers',
            'map',
            'Dealers Map'
        );
        
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ARM.Armdealers',
            'maplink',
            'Dealers Map (links)'
        );
         
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('armdealers', 'Configuration/TypoScript', 'Rolf-Benz Dealers');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_armdealers_domain_model_dealer', 'EXT:armdealers/Resources/Private/Language/locallang_csh_tx_armdealers_domain_model_dealer.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_armdealers_domain_model_dealer');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_armdealers_domain_model_zipcode', 'EXT:armdealers/Resources/Private/Language/locallang_csh_tx_armdealers_domain_model_zipcode.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_armdealers_domain_model_zipcode');
        
       
    }
);


