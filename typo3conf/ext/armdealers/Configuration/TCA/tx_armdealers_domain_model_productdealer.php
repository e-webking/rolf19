<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product_dealer',
        'label' => 'dealer',
        'label_alt' => 'product',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'product,dealer,',
        'iconfile' => 'EXT:armdealers/Resources/Public/Icons/tx_armdealers_domain_model_dealer.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'hidden, product, dealer, splprice, dispshowroom, inshowroom,',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, product, dealer, splprice, dispshowroom, inshowroom, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                        'foreign_table' => 'tx_armdealers_domain_model_productdealer',
                        'foreign_table_where' => 'AND tx_armdealers_domain_model_productdealer.pid=###CURRENT_PID### AND tx_armdealers_domain_model_productdealer.sys_language_uid IN (-1,0)',
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
        'product' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product_dealer.product',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_armdealers_domain_model_product',
                'minitems' => 0,
                'maxitems' => 1,
            ]
        ],
        'splprice' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product_dealer.splprice',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'Special price'
                    ]
                ],
            ],
        ],
        'dealer' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_product_dealer.dealer',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_armdealers_domain_model_dealer',
                'minitems' => 0,
                'maxitems' => 1,
            ],

        ],
        'dispshowroom' => [
            'exclude' => true,
            'label' => 'Display showroom status?',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'Show status'
                    ]
                ],
            ],
        ],
        'inshowroom' => [
            'exclude' => true,
            'label' => 'Available in showroom?',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                        ['Nein', 0],
                        ['Ja', 1],
                ],
                'minitems' => 0,
                'maxitems' => 1,
            ],

        ],
    ],
];
