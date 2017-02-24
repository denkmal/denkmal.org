<?php

class Denkmal_Model_EventCategory extends CM_Model_Abstract {

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
     * @return CM_Color_RGB
     */
    public function getColor() {
        return CM_Color_RGB::fromHexString($this->_get('color'));
    }

    /**
     * @param CM_Color_RGB $color
     */
    public function setColor(CM_Color_RGB $color) {
        $this->_set('color', $color->getHexString());
    }

    /**
     * @return string[]
     */
    public function getGenreList() {
        return CM_Util::jsonDecode($this->_get('genreList'));
    }

    /**
     * @param string[] $genreList
     */
    public function setGenreList(array $genreList) {
        $genreList = Functional\map($genreList, function ($genre) {
            return (string) $genre;
        });
        $this->_set('genreList', CM_Util::jsonEncode($genreList));
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'label'     => array('type' => 'string'),
            'color'     => array('type' => 'string'),
            'genreList' => array('type' => 'string'),
        ));
    }

    protected function _getContainingCacheables() {
        $containingCacheables = parent::_getContainingCacheables();
        return $containingCacheables;
    }

    /**
     * @param string       $label
     * @param CM_Color_RGB $color
     * @param string[]     $genreList
     * @return Denkmal_Model_EventCategory
     */
    public static function create($label, CM_Color_RGB $color, array $genreList) {
        $eventCategory = new self();
        $eventCategory->setLabel($label);
        $eventCategory->setColor($color);
        $eventCategory->setGenreList($genreList);
        $eventCategory->commit();
        return $eventCategory;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
