<?php
return [
    'ctrl' => [
        'title' => 'IP Data (Zuerich and Rapperswil)',
        'label' => 'ipstart',
        'label_alt' => 'ipend,cn2iso',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'ipstart,ipend,cn2iso,country,',
        'iconfile' => 'EXT:armip2location/Resources/Public/Icons/tx_armip2location.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'hidden, ipstart, ipend, cn2iso,country, region, city',
    ],
    'types' => [
        '1' => ['showitem' => 'hidden, ipstart, ipend, cn2iso, country, region, city'],
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
        'ipstart' => [
            'exclude' => true,
            'label' => 'IP range start',
            'config' => [
                'type' => 'input',
                'size' => 15,
                'eval' => 'int'
            ],
        ],
        'ipend' => [
            'exclude' => true,
            'label' => 'IP range end',
            'config' => [
                'type' => 'input',
                'size' => 15,
                'eval' => 'int'
            ],
        ],
        'cn2iso' => [
            'exclude' => true,
            'label' => 'ISO Country',
            'config' => [
                'type' => 'input',
                'size' => 5,
                'eval' => 'trim'
            ],
        ],
        'country' => [
            'exclude' => true,
            'label' => 'Country',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim'
            ]
        ],
        'region' => [
            'exclude' => true,
            'label' => 'Region',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim'
            ]
        ],
        'city' => [
            'exclude' => true,
            'label' => 'City',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim'
            ]
        ],
    ],
];
