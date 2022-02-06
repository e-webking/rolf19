<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_category',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'default_sortby' => 'uid DESC',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,image,pageuid',
        'iconfile' => 'EXT:armdealers/Resources/Public/Icons/tx_armdealers_domain_model_dealer.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'hidden, title, image, pageuid, products',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, image, pageuid, products, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
                'exclude' => 1,
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.language',
                'config' => [
                        'type' => 'select',
                        'renderType' => 'selectSingle',
                        'foreign_table' => 'sys_language',
                        'foreign_table_where' => 'ORDER BY sys_language.title',
                        'items' => [
                                ['LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages', -1],
                                ['LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.default_value', 0]
                        ],
                ],
        ],
        'l10n_parent' => [
                'displayCond' => 'FIELD:sys_language_uid:>:0',
                'exclude' => 1,
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
                'config' => [
                        'type' => 'select',
                        'renderType' => 'selectSingle',
                        'items' => [
                                ['', 0],
                        ],
                        'foreign_table' => 'tx_armdealers_domain_model_category',
                        'foreign_table_where' => 'AND tx_armdealers_domain_model_category.pid=###CURRENT_PID### AND tx_armdealers_domain_model_category.sys_language_uid IN (-1,0)',
                ],
        ],
        'l10n_diffsource' => [
                'config' => [
                        'type' => 'passthrough',
                ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
            ],
        ],
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_category.title',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim'
            ],
        ],
        'image' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_category.image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                    'image',
                    array('maxitems' => 1),
                    $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            )
        ],
        'pageuid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_category.pageuid',
            'config' => [
                'type' => 'input',
                'inputLink' => 'inputLink',
            ],
        ],
        'products' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_category.products',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_armdealers_domain_model_product',
                'foreign_field' => 'category',
                'maxitems' => 999,
                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],

        ],
    
    ],
];
