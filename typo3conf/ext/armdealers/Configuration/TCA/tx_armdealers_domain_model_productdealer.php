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
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'product,dealer,',
        'iconfile' => 'EXT:armdealers/Resources/Public/Icons/tx_armdealers_domain_model_dealer.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'hidden, product, dealer, splprice,',
    ],
    'types' => [
        '1' => ['showitem' => 'hidden, product, dealer, splprice, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
         
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
    
    ],
];
