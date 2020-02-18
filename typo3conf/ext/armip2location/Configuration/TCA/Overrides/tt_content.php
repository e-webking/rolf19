<?php

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['armdealers_map'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'armdealers_map',
    'FILE:EXT:armdealers/Configuration/FlexForm/flexform_map.xml'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['armdealers_maplink'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'armdealers_maplink',
    'FILE:EXT:armdealers/Configuration/FlexForm/flexform_map.xml'
);