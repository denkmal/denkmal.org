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
            return (string) mb_strtolower($genre);
        });
        $genreList = array_unique($genreList);
        $this->_set('genreList', CM_Util::jsonEncode($genreList));
    }

    /**
     * @param string $genre
     */
    public function addGenre($genre) {
        $genre = (string) $genre;
        $genreList = $this->getGenreList();
        $genreList[] = $genre;
        $this->setGenreList($genreList);
    }

    /**
     * @param string $genre
     */
    public function removeGenre($genre) {
        $genre = (string) strtolower($genre);
        $genreList = $this->getGenreList();
        $genreList = Functional\reject($genreList, function ($genreItem) use ($genre) {
            return $genreItem === $genre;
        });
        $this->setGenreList($genreList);
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
        $containingCacheables[] = new Denkmal_Paging_EventCategory_All();
        return $containingCacheables;
    }

    protected function _onChange() {
        parent::_onChange();
        Denkmal_EventFormatter_GenresFilter::clearCache();
    }

    protected function _onCreate() {
        parent::_onCreate();
        Denkmal_EventFormatter_GenresFilter::clearCache();
    }

    protected function _onDelete() {
        parent::_onDelete();
        Denkmal_EventFormatter_GenresFilter::clearCache();
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

    /**
     * @param string $label
     * @return static|null
     */
    public static function findByLabel($label) {
        /** @var CM_Model_StorageAdapter_FindableInterface $persistence */
        $persistence = self::_getStorageAdapter(self:: getPersistenceClass());
        $type = self::getTypeStatic();
        $result = $persistence->findByData($type, ['label' => $label]);
        $id = $result['id'];
        if (!$id) {
            return null;
        }
        return new static($id);
    }

    /**
     * @param string $label
     * @return Denkmal_Model_EventCategory
     * @throws CM_Exception_Invalid
     */
    public static function getByLabel($label) {
        $category = self::findByLabel($label);
        if (null === $category) {
            throw new CM_Exception_Invalid('Cannot find event-category by label', null, [
                'label' => $label,
            ]);
        }
        return $category;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
