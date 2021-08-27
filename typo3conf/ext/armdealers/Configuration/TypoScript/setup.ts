page.includeCSS {
    file1000 = EXT:armdealers/Resources/Public/Css/armdealer.css
}
page.includeJSFooter {
    file1000 = EXT:armdealers/Resources/Public/Js/dealer.js
}
plugin.tx_armdealers {
    view {
        templateRootPaths.0 = EXT:armdealers/Resources/Private/Templates/
        templateRootPaths.10 = {$plugin.tx_armdealers.view.templateRootPath}
        partialRootPaths.0 = EXT:armdealers/Resources/Private/Partials/
        partialRootPaths.10 = {$plugin.tx_armdealers.view.partialRootPath}
        layoutRootPaths.0 = EXT:armdealers/Resources/Private/Layouts/
        layoutRootPaths.10 = {$plugin.tx_armdealers.view.layoutRootPath}
    }
    persistence {
        storagePid = {$plugin.tx_armdealers.persistence.storagePid}
    }
    settings {
        googleApiKey = {$plugin.tx_armdealers.settings.googleApiKey}
        lat = {$plugin.tx_armdealers.settings.lat}
        lng = {$plugin.tx_armdealers.settings.lng}
        alat = {$plugin.tx_armdealers.settings.alat}
        alng = {$plugin.tx_armdealers.settings.alng}
        zoom = {$plugin.tx_armdealers.settings.zoom}
        contactPid = {$plugin.tx_armdealers.settings.contactPid}
        sysEmail = {$plugin.tx_armdealers.settings.sysEmail}
        sysName = {$plugin.tx_armdealers.settings.sysName}
        defaultEmail = {$plugin.tx_armdealers.settings.defaultEmail}
        defaultName = {$plugin.tx_armdealers.settings.defaultName}
        formSubject = {$plugin.tx_armdealers.settings.formSubject}
        thanku = {$plugin.tx_armdealers.settings.thanku}
    }
}

 # Module configuration
module.tx_armdealers {
    settings {
        storagePid = {$module.tx_armdealers.persistence.storagePid}
    }
    persistence {
        storagePid = {$module.tx_armdealers.persistence.storagePid}
    }
    view {
        templateRootPaths.0 = {$module.tx_armdealers.view.templateRootPath}
        partialRootPaths.0 = {$module.tx_armdealers.view.partialRootPath}
        layoutRootPaths.0 = {$module.tx_armdealers.view.layoutRootPath}
    }
}