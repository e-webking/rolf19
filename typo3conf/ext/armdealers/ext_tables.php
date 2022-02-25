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
        
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ARM.Armdealers',
            'category',
            'Product Categories'
        );
         
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ARM.Armdealers',
            'pgroup',
            'Product Group'
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ARM.Armdealers',
            'product',
            'Product Detail'
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ARM.Armdealers',
            'dashboard',
            'Dealer Dashboard'
        );
        
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('armdealers', 'Configuration/TypoScript', 'Rolf-Benz Dealers');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_armdealers_domain_model_category', 'EXT:armdealers/Resources/Private/Language/locallang_csh_tx_armdealers_domain_model_category.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_armdealers_domain_model_category');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_armdealers_domain_model_product', 'EXT:armdealers/Resources/Private/Language/locallang_csh_tx_armdealers_domain_model_product.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_armdealers_domain_model_product');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_armdealers_domain_model_productdealer', 'EXT:armdealers/Resources/Private/Language/locallang_csh_tx_armdealers_domain_model_productdealer.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_armdealers_domain_model_productdealer');
        
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_armdealers_domain_model_dealer', 'EXT:armdealers/Resources/Private/Language/locallang_csh_tx_armdealers_domain_model_dealer.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_armdealers_domain_model_dealer');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_armdealers_domain_model_zipcode', 'EXT:armdealers/Resources/Private/Language/locallang_csh_tx_armdealers_domain_model_zipcode.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_armdealers_domain_model_zipcode');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_armdealers_domain_model_rawdata');
       
    }
);


if (TYPO3_MODE === 'BE') {
 
    $mainModuleName = 'armdealersM1';
 
    if (!isset($TBE_MODULES[$mainModuleName])) {
        $temp_TBE_MODULES = array();
        foreach($TBE_MODULES as $key => $val) {
            if($key == 'web') {
                $temp_TBE_MODULES[$key] = $val;
                $temp_TBE_MODULES[$mainModuleName] = '';
            } else {
                $temp_TBE_MODULES[$key] = $val;
            }
        }
        $TBE_MODULES = $temp_TBE_MODULES;
    }

    // Hauptmodul erstellen
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule($mainModuleName, '', '', \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Configuration/BackendModule/');
    $GLOBALS['TBE_MODULES']['_configuration'][$mainModuleName] = [
        'labels' => [
            'll_ref' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_mod_main.xlf'
        ],
        'name' => $mainModuleName,
        'iconIdentifier' => 'module-tools'
    ];
    // Erstes richtiges Backend Modul der Extension
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'ARM.Armdealers',
        $mainModuleName,
        'Import',
        '',
        array(
            'Import' => 'raw,import,migrate', 
        ),
        array(
            'access' => 'user,group',
            'icon'   => 'EXT:armdealers/ext_icon.gif',
            'labels' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_import.xlf',
            'navigationComponentId' => 'typo3-pagetree',
        )
    );
}