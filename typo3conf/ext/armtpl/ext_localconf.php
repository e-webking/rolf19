<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TypoScript/TsConfig/pageTsConfig.txt">');


$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['armtpl_preset'] = 'EXT:armtpl/Configuration/RTE/Default.yaml';