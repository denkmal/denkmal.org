<?php

class Denkmal_Model_MessageImage extends CM_Model_Abstract implements Denkmal_ArrayConvertibleApi {

    /**
     * @return CM_File_UserContent
     */
    public function getFile() {
        $filename = $this->getId() . '.jpg';
        return new CM_File_UserContent('message-image', $filename);
    }

    public function toArrayApi(CM_Render $render) {
        $array = array();
        $array['url'] = $render->getUrlUserContent($this->getFile());
        return $array;
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array());
    }

    protected function _onDelete() {
        $this->getFile()->delete();
    }

    /**
     * @param CM_File $file
     * @return Denkmal_Model_Song
     */
    public static function create(CM_File $file) {
        $image = new self();
        $image->commit();

        $userFile = $image->getFile();
        $userFile->mkDir();
        $file->copy($userFile->getPath());
        @chmod($userFile->getPath(), 0666);

        return $image;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
