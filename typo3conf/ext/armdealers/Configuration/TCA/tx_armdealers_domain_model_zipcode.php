<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_zipcode',
        'label' => 'zipcode',
        'label_alt' => 'country',
        'label_alt_force' => TRUE,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'default_sortby' => 'zipcode ASC',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'zipcode,dealer,city,canton',
        'iconfile' => 'EXT:armdealers/Resources/Public/Icons/tx_armdealers_domain_model_zipcode.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'hidden, dealer, zipcode, city, canton, country',
    ],
    'types' => [
        '1' => ['showitem' => 'hidden, dealer, country, zipcode, city, canton, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
        'country' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_zipcode.country',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                        array('Schweiz', 'CHE'),
                        array('Österreich', 'AUT')
                ],
            ],
        ],
        'city' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_zipcode.city',
            'config' => [
                'type' => 'input',
                'size' => 15,
                'eval' => 'trim'
            ],
        ],
        'canton' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_zipcode.canton',
            'config' => [
                'type' => 'input',
                'size' => 5,
                'eval' => 'trim'
            ]
        ],
        'zipcode' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_zipcode.zipcpde',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'int'
            ],
        ],
        'dealer' => [
            'exclude' => true,
            'label' => 'LLL:EXT:armdealers/Resources/Private/Language/locallang_db.xlf:tx_armdealers_domain_model_zipcode.dealer',
            'config' => [
               'type' => 'select',
               'renderType' => 'selectSingle',
               'foreign_table' => 'tx_armdealers_domain_model_dealer',
               'minitems' => 0,
               'maxitems' => 1,
             ]
        ],
    
    ],
];
