<?php

class Denkmal_Model_Tag extends CM_Model_Abstract {

    /**
     * @return string
     */
    public function getLabel() {
        return $this->_get('label');
    }

    /**
     * @param string $label
     */
    public function setLabel($label) {
        $this->_set('label', $label);
    }

    /**
     * @return bool
     */
    public function getActive() {
        return $this->_get('active');
    }

    /**
     * @param bool $active
     */
    public function setActive($active) {
        $this->_set('active', $active);
        (new Denkmal_Paging_Tag_Active())->_change();
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'label'  => array('type' => 'string'),
            'active' => array('type' => 'boolean'),
        ));
    }

    protected function _getContainingCacheables() {
        $containingCacheables = parent::_getContainingCacheables();
        $containingCacheables[] = new Denkmal_Paging_Tag_All();
        $containingCacheables[] = new Denkmal_Paging_Tag_Active();
        return $containingCacheables;
    }

    protected function _onDeleteBefore() {
        throw new CM_Exception_Invalid('Cannot delete tags');
    }

    /**
     * @param string $label
     * @return Denkmal_Model_Tag
     */
    public static function create($label) {
        $tag = new self();
        $tag->setLabel($label);
        $tag->setActive(true);
        $tag->commit();

        return $tag;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }

    /**
     * @param string $label
     * @return Denkmal_Model_Tag|null
     * @throws CM_Class_Exception_TypeNotConfiguredException
     * @throws CM_Exception_Invalid
     */
    public static function findByLabel($label) {
        $label = (string) $label;

        /** @var CM_Model_StorageAdapter_Database $persistence */
        $persistence = self::_getStorageAdapter(self::getPersistenceClass());
        $model = $persistence->findByData(self::getTypeStatic(), [
            'label' => $label,
        ]);

        if (null !== $model) {
            $model = new self($model['id']);
        }
        return $model;
    }
}
