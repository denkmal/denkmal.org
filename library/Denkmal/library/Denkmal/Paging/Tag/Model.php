<?php

class Denkmal_Paging_Tag_Model extends Denkmal_Paging_Tag_Abstract {

    /** @var CM_Model_Abstract */
    private $_model;

    /**
     * @param CM_Model_Abstract $model
     * @throws CM_Exception_Invalid
     */
    public function __construct(CM_Model_Abstract $model) {
        $modelType = $model->getType();
        $modelId = $model->getId();
        if (!is_int($modelId)) {
            throw new CM_Exception_Invalid('Tags only work with numerical model IDs');
        }
        $this->_model = $model;

        $source = new CM_PagingSource_Sql('tagId', 'denkmal_model_tag_model', 'modelType=? AND modelId=?', null, null, null,
            [$modelType, $modelId]);
        $source->enableCache();
        parent::__construct($source);
    }

    /**
     * @param Denkmal_Model_Tag $tag
     */
    public function add(Denkmal_Model_Tag $tag) {
        CM_Db_Db::insert('denkmal_model_tag_model', [
            'modelType' => $this->_model->getType(),
            'modelId'   => $this->_model->getId(),
            'tagId'     => $tag->getId(),
        ]);
        $this->_change();
    }

    /**
     * @param Denkmal_Model_Tag $tag
     */
    public function delete(Denkmal_Model_Tag $tag) {
        CM_Db_Db::delete('denkmal_model_tag_model', [
            'modelType' => $this->_model->getType(),
            'modelId'   => $this->_model->getId(),
            'tagId'     => $tag->getId(),
        ]);
        $this->_change();
    }
}
