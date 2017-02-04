<?php

return function (CM_Config_Node $config) {
    $config->Denkmal_Site_Default->url = 'https://denkmal.dev.cargomedia.ch';
    $config->Denkmal_Site_Default->urlCdn = 'https://origin-denkmal.dev.cargomedia.ch';
    $config->Admin_Site->url = 'https://admin-denkmal.dev.cargomedia.ch';
    $config->Admin_Site->urlCdn = 'https://origin-denkmal.dev.cargomedia.ch';
};
