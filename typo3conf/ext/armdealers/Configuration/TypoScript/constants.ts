
plugin.tx_armdealers {
    view {
        # cat=plugin.tx_armdealers_minilist/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:armdealers/Resources/Private/Templates/
        # cat=plugin.tx_armdealers_minilist/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:armdealers/Resources/Private/Partials/
        # cat=plugin.tx_armdealers_minilist/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:armdealers/Resources/Private/Layouts/
    }
    persistence {
        # cat=plugin.tx_armdealers_minilist//a; type=string; label=Default storage PID
        storagePid = 68
    }
    settings {
        googleApiKey = AIzaSyDvxfn8V-NbGRhIJWmkljFC2k9pwnj4L4k
        lat = 47.378498
        lng = 8.5174823
        zoom = 8
        contactPid = 8
        sysEmail = nobody@rolf-benz.haus
        sysName = Rolf-Benz
        defaultEmail = info@rolf-benz.haus
        defaultName = Rolf-Benz
        formSubject = Kontakt formular
        thanku = 71
        
    }
}
