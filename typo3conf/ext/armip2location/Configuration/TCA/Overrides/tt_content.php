<?php

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['armip2location_loc'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'armip2location_loc',
    'FILE:EXT:armip2location/Configuration/Flexform/flexform_loc.xml'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['armip2location_zuerich'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'armip2location_zuerich',
    'FILE:EXT:armip2location/Configuration/Flexform/flexform_zuerich.xml'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['armip2location_rapperswil'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'armip2location_rapperswil',
    'FILE:EXT:armip2location/Configuration/Flexform/flexform_zuerich.xml'
);