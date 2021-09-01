<?php
return [
    'ctrl' => [
        'title' => 'Raw Dealer Data',
        'label' => 'dealertitel',
        'delete' => 'deleted',
        'default_sortby' => 'uid DESC',
        'searchFields' => 'dealertitel,adresse,postleitzahl,ort,iso2cn,land,telefon,email,lat,lng,formmsg,land2,plz,ville,kanton,processed',
        'iconfile' => 'EXT:armdealers/Resources/Public/Icons/tx_armdealers_domain_model_dealer.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'dealertitel,adresse,postleitzahl,ort,iso2cn,land,telefon,email,lat,lng,formmsg,land2,plz,ville,kanton,processed',
    ],
    'types' => [
        '1' => ['showitem' => 'dealertitel,adresse,postleitzahl,ort,iso2cn,land,telefon,email,lat,lng,formmsg,land2,plz,ville,kanton,processed'],
    ],
    'columns' => [
        'processed' => [
            'exclude' => true,
            'label' => 'Processed',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'Done'
                    ]
                ],
            ],
        ],
        'dealertitel' => [
            'exclude' => true,
            'label' => 'Dealer Titel',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim'
            ],
        ],
        'ort' => [
            'exclude' => true,
            'label' => 'Ort',
            'config' => [
                'type' => 'input',
                'size' => 15,
                'eval' => 'trim'
            ],
        ],
        'formmsg' => [
            'exclude' => true,
            'label' => 'Form Message',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'adresse' => [
            'exclude' => true,
            'label' => 'Adresse',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'postleitzahl' => [
            'exclude' => true,
            'label' => 'Postleitzahl',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim'
            ],
        ],
        'iso2cn'=> [
            'exclude' => true,
            'label' => 'ISO 2 CN',
            'config' => [
                'type' => 'input',
                'size' => 5,
                'eval' => 'trim'
            ],
        ],
        'land'=> [
            'exclude' => true,
            'label' => 'Land',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim'
            ],
        ],
        'telefon' => [
            'exclude' => true,
            'label' => 'Telefon',
            'config' => [
               'type' => 'input',
                'size' => 10,
                'eval' => 'trim'
             ]
        ],
        'email' => [
            'exclude' => true,
            'label' => 'Email',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim'
            ],
        ],
        'lat' => [
            'exclude' => true,
            'label' => 'Latitude',
            'config' => [
                'type' => 'input',
                'size' => 10,
            ],
        ],
        'lng' => [
            'exclude' => true,
            'label' => 'Longitude',
            'config' => [
                'type' => 'input',
                'size' => 10,
            ],
        ],
        'land2' => [
            'exclude' => true,
            'label' => 'Land 2',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim'
            ],
        ],
        'plz' => [
            'exclude' => true,
            'label' => 'PLZ',
            'config' => [
                'type' => 'input',
                'size' => 15,
                'eval' => 'trim'
            ],
        ],
        'ville' => [
            'exclude' => true,
            'label' => 'Ville',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim'
            ],
        ],
        'kanton' => [
            'exclude' => true,
            'label' => 'Kanton',
            'config' => [
                'type' => 'input',
                'size' => 15,
                'eval' => 'trim'
            ],
        ],
    ],
];
