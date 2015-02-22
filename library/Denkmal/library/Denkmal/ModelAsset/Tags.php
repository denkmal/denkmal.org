<?php

class Denkmal_ModelAsset_Tags extends CM_ModelAsset_Abstract {

    /** @var Denkmal_Paging_Tag_Model */
    private $_paging;

    public function _loadAsset() {
    }

    /**
     * @return Denkmal_Model_Tag[]
     */
    public function getAll() {
        return $this->_getPaging()->getItems();
    }

    /**
     * @param Denkmal_Model_Tag $tag
     */
    public function add(Denkmal_Model_Tag $tag) {
        $this->_getPaging()->add($tag);
    }

    /**
     * @param Denkmal_Model_Tag $tag
     */
    public function delete(Denkmal_Model_Tag $tag) {
        $this->_getPaging()->delete($tag);
    }

    /**
     * Model deletion
     */
    public function _onModelDelete() {
        $this->_getPaging()->deleteAll();
    }

    /**
     * @return Denkmal_Paging_Tag_Model
     */
    private function _getPaging() {
        if (null === $this->_paging) {
            $this->_paging = new Denkmal_Paging_Tag_Model($this->_model);
        }
        return $this->_paging;
    }
}
