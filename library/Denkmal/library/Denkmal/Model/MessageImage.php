<?php

class Denkmal_Model_MessageImage extends CM_Model_Abstract implements Denkmal_ArrayConvertibleApi {

    private $_fileTypeList = array(
        'thumb',
        'view',
    );

    /**
     * @param string $type
     * @throws CM_Exception_Invalid
     * @return CM_File_UserContent
     */
    public function getFile($type) {
        if (!in_array($type, $this->_fileTypeList, true)) {
            throw new CM_Exception_Invalid('Unknown file type `' . $type . '`.');
        }
        $filename = $this->getId() . '-' . $type . '.jpg';
        return new CM_File_UserContent('message-image', $filename);
    }

    public function toArrayApi(CM_Render $render) {
        $array = array();
        $array['url-view'] = $render->getUrlUserContent($this->getFile('view'));
        $array['url-thumb'] = $render->getUrlUserContent($this->getFile('thumb'));
        return $array;
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array());
    }

    protected function _onDelete() {
        foreach ($this->_fileTypeList as $fileType) {
            $this->getFile($fileType)->delete();
        }
    }

    /**
     * @param CM_File_Image $file
     * @throws CM_Exception
     * @return Denkmal_Model_MessageImage
     */
    public static function create(CM_File_Image $file) {
        $image = new self();
        $image->commit();

        try {
            $image->getFile('view')->mkDir();
            $file->resize(2000, 2000, false, $image->getFile('view')->getPath(), CM_File_Image::FORMAT_JPEG);
            $file->resize(400, 400, true, $image->getFile('thumb')->getPath(), CM_File_Image::FORMAT_JPEG);
        } catch (CM_Exception $ex) {
            $image->delete();
            throw $ex;
        }

        return $image;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
