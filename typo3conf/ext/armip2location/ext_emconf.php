<?php
/***************************************************************
 * Extension Manager/Repository config file for ext "armip2location".
 *
 * Auto generated 02-07-2021 06:18
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'IP to Location',
    'description' => 'Migrate CSV Ip2location LITE database to TYPO3',
    'category' => 'plugins',
    'author' => 'Anisur R. Mullick',
    'author_email' => 'anisur@armtechnologies.com',
    'author_company' => 'ARM Technologies',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '1',
    'createDirs' => 'fileadmin/armip2location',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '9.6.1',
    'constraints' => [
        'depends' => ['typo3' => '8.0-9.9'],
        'conflicts' => [],
        'suggests' =>  [],
    ],
];

