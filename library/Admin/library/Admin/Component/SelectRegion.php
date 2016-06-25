<?php

class Admin_Component_SelectRegion extends Admin_Component_Abstract {

    public function prepare(CM_Frontend_Environment $environment, CM_Frontend_ViewResponse $viewResponse) {
        $site = $environment->getSite();
        if (!$site instanceof Admin_Site) {
            throw new CM_Exception('Unexpected site', null, ['site' => $site]);
        }

        $region = $site->hasRegion() ? $site->getRegion() : null;

        $regionList = new Denkmal_Paging_Region_All();
        $itemList = Functional\map($regionList, function (Denkmal_Model_Region $regionItem) use($region) {
            return [
                'region' => $regionItem,
                'site' => new Admin_Site($regionItem),
                'current' => ($region && $region->equals($regionItem)),
            ];
        });
        array_unshift($itemList, [
            'region' => null,
            'site' => new Admin_Site(null),
            'current' => (null === $region),
        ]);

        $viewResponse->set('region', $region);
        $viewResponse->set('itemList', $itemList);
    }

}
