<?php

class Denkmal_Elasticsearch_Type_Song extends CM_Elastica_Type_Abstract {

    const INDEX_NAME = 'song';

    protected $_mapping = array(
        'label' => array('type' => 'string'),
    );

    protected $_indexParams = array(
        'index' => array(
            'number_of_shards'   => 1,
            'number_of_replicas' => 0
        ),
    );

    protected function _getQuery($ids = null, $limit = null) {
        $query = '
            SELECT `song`.*
            FROM `denkmal_model_song` `song`
        ';

        if (is_array($ids)) {
            $query .= ' WHERE song.id IN (' . implode(',', $ids) . ')';
        }
        if (($limit = (int) $limit) > 0) {
            $query .= ' LIMIT ' . $limit;
        }
        return $query;
    }

    protected function _getDocument(array $data) {
        $doc = new Elastica_Document($data['id'],
            array(
                'label' => $data['label'],
            )
        );
        return $doc;
    }

    /**
     * @param Denkmal_Model_Song $item
     * @return int
     */
    protected static function _getIdForItem($item) {
        return $item->getId();
    }
}
