/* ===================================================
  * CONFIGURACION DE LOS TABS
===================================================*/
let tabsConfigGH = {
    tabs: [
        {
            id: 'gh-tab1',
            label: 'Personal',
            url: 'gh-personal',
            tooltip: 'Personal',
            tabClass: 'customTabClass',
            spacerClass: 'customSpacerClass',
        },
        {
            id: 'gh-tab2',
            label: 'Alertas de contratos',
            url: 'gh-alertas',
            tooltip: 'Alertas de contratos',
            tabClass: 'customTabClass',
            spacerClass: 'customSpacerClass',
        }

        // ...
    ]
};

/* ===================================================
  * PERSONAL
===================================================*/
if (
    window.location.href == `${urlPagina}gh-personal/` ||
    window.location.href == `${urlPagina}gh-personal`
) {
    $(document).ready(function () {
        // PERSONAL
        $('#ghTabs').simpleTabs(tabsConfigGH, 'gh-tab1');

    });
}

/* ===================================================
  * ALERTAS DE CONTRATOS
===================================================*/
if (
    window.location.href == `${urlPagina}gh-alertas/` ||
    window.location.href == `${urlPagina}gh-alertas`
) {
    $(document).ready(function () {
        // Alertas
        $('#ghTabs').simpleTabs(tabsConfigGH, 'gh-tab2');
    });
}

