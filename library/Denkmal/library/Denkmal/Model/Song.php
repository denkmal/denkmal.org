<?php

class Denkmal_Model_Song extends CM_Model_Abstract implements Denkmal_ArrayConvertibleApi {

    /**
     * @param string $label
     */
    public function setLabel($label) {
        $this->_set('label', $label);
    }

    /**
     * @return string
     */
    public function getLabel() {
        return $this->_get('label');
    }

    /**
     * @return CM_File_UserContent
     */
    public function getFile() {
        $filename = $this->getId() . '.mp3';
        return new CM_File_UserContent('songs', $filename);
    }

    public function updateSearchIndex() {
        Denkmal_Elasticsearch_Type_Song::updateItemWithJob($this);
    }

    public function jsonSerialize() {
        $array = parent::jsonSerialize();
        $array['path'] = $this->getFile()->getPathRelative();
        $array['label'] = $this->getLabel();
        return $array;
    }

    public function toArrayApi(CM_Frontend_Render $render) {
        $array = array();
        $array['label'] = $this->getLabel();
        $array['url'] = $render->getUrlUserContent($this->getFile());
        return $array;
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array(
            'label' => array('type' => 'string'),
        ));
    }

    protected function _onChange() {
        $this->updateSearchIndex();
    }

    protected function _onCreate() {
        $this->updateSearchIndex();
    }

    protected function _onDeleteBefore() {
        $this->getFile()->delete();

        $eventList = new Denkmal_Paging_Event_Song($this);
        /** @var Denkmal_Model_Event $event */
        foreach ($eventList as $event) {
            $event->setSong(null);
        }
    }

    protected function _onDeleteAfter() {
        $this->updateSearchIndex();
    }

    /**
     * @param string $label
     * @return Denkmal_Model_Song|null
     */
    public static function findByLabel($label) {
        $label = (string) $label;
        $linkId = CM_Db_Db::select('denkmal_model_song', 'id', array('label' => $label))->fetchColumn();
        if (!$linkId) {
            return null;
        }
        return new self($linkId);
    }

    /**
     * @param string  $label
     * @param CM_File $file
     * @return Denkmal_Model_Song
     */
    public static function create($label, CM_File $file) {
        $song = new self();
        $song->setLabel($label);
        $song->commit();

        $userFile = $song->getFile();
        $userFile->ensureParentDirectory();
        $file->copyToFile($userFile);

        return $song;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
