<?php

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['armip2location_loc'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'armip2location_loc',
    'FILE:EXT:armip2location/Configuration/Flexform/flexform_loc.xml'
);