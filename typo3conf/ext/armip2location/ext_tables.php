<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}
call_user_func(function(){
    
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'ARM.Armip2location',
            'loc',
            'IP to Location'
        );
    
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('armip2location', 'Configuration/TypoScript', 'IP2Location');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_armip2location_ip', 'EXT:armip2location/Resources/Private/Language/locallang_csh_tx_armip2location_ip.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_armip2location_ip');
    }
);


