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

    public function toArrayApi(CM_Frontend_Render $render) {
        $array = array();
        $array['url-view'] = $render->getUrlUserContent($this->getFile('view'));
        $array['url-thumb'] = $render->getUrlUserContent($this->getFile('thumb'));
        return $array;
    }

    protected function _getSchema() {
        return new CM_Model_Schema_Definition(array());
    }

    protected function _onDeleteBefore() {
        foreach ($this->_fileTypeList as $fileType) {
            $this->getFile($fileType)->delete();
        }
    }

    /**
     * @param CM_Image_Image $image
     * @throws CM_Exception
     * @return Denkmal_Model_MessageImage
     */
    public static function create(CM_Image_Image $image) {
        $messageImage = new self();
        $messageImage->commit();

        try {
            $image->clearAndApplyExifRotation();
            $image->setFormat(CM_Image_Image::FORMAT_JPEG);
            $messageImage->getFile('view')->ensureParentDirectory();
            $messageImage->getFile('view')->write($image->getClone()->resize(2000, 2000)->getBlob());
            $messageImage->getFile('thumb')->write($image->resize(400, 400, true)->getBlob());
        } catch (CM_Exception $ex) {
            $messageImage->delete();
            throw $ex;
        }

        return $messageImage;
    }

    public static function getPersistenceClass() {
        return 'CM_Model_StorageAdapter_Database';
    }
}
