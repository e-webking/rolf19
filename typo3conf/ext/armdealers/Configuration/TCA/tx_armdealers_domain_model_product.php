<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product',
        'label' => 'sku',
        'label_alt' => 'title',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'default_sortby' => 'title',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,sku,description,category,mtitle,mdescription,',
        'iconfile' => 'EXT:armdealers/Resources/Public/Icons/tx_armdealers_domain_model_dealer.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'hidden, title, sku, category, description, coverphoto, preview, images, pdf, techpdf, video, mtitle, mdescription, dealers,',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, category, sku, title, description, coverphoto, preview, images, pdf, techpdf, video, mtitle, mdescription, dealers, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                        'items' => array(
                                array('LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages', -1),
                                array('LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.default_value', 0)
                        ),
                        'default' => 0,
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
                        'foreign_table' => 'tx_armdealers_domain_model_product',
                        'foreign_table_where' => 'AND tx_armdealers_domain_model_product.pid=###CURRENT_PID### AND tx_armdealers_domain_model_product.sys_language_uid IN (-1,0)',
                        'default' => 0,
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
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product.title',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim'
            ],
        ],
        'sku' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product.sku',
            'config' => [
                'type' => 'input',
                'size' => 15,
                'eval' => 'trim'
            ],
        ],
        'category' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product.category',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_armdealers_domain_model_category',
                'minitems' => 0,
                'maxitems' => 1,
            ]
        ],
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product.description',
            'config' => [
                'type' => 'text',
                'rows' => 3,
                'cols' => 40,
                'eval' => 'trim'
            ]
        ],
        'coverphoto' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product.coverphoto',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                    'coverphoto',
                    array('maxitems' => 1),
                    $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            )
        ],
        'preview'=> [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product.preview',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'preview',
                array('maxitems' => 1),
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            )
        ],
        'images'=> [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product.images',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'images',
                array('maxitems' => 99),
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            )
        ],
        'pdf' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product.pdf',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'pdf',
                array('maxitems' => 1),
                'pdf'
            )
        ],
        'techpdf' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product.techpdf',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'techpdf',
                array('maxitems' => 1),
                'pdf'
            )
        ],
        'video' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product.video',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'video',
                array('maxitems' => 1),
                'mp4'
            )
        ],
        'mtitle' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product.mtitle',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim'
            ],
        ],
        'mdescription'=> [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product.mdescription',
            'config' => [
                'type' => 'text',
                'rows' => 3,
                'cols' => 40,
                'eval' => 'trim'
            ],
        ],
        'dealers' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product.dealers',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_armdealers_domain_model_productdealer',
                'foreign_field' => 'product',
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
