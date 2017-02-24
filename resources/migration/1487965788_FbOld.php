<?php

class Migration_1487965788_FbOld implements \CM_Migration_UpgradableInterface, \CM_Service_ManagerAwareInterface {

    use CM_Service_ManagerAwareTrait;

    public function up(\CM_OutputStream_Interface $output) {
        $linkIds = CM_Db_Db::select('denkmal_model_eventlink', 'id', ['label' => 'Facebook'])->fetchAllColumn();
        foreach ($linkIds as $linkId) {
            $link = new Denkmal_Model_EventLink($linkId);
            $link->delete();
        }
    }
}
