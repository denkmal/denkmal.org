<?php

class Denkmal_Elasticsearch_Type_SongTest extends CMTest_TestCase {

    /** @var Denkmal_Elasticsearch_Type_Song */
    protected $_type;

    public function setUp() {
        $elasticsearchCluster = $this->getServiceManager()->getElasticsearch();
        $elasticsearchCluster->setEnabled(true);

        $this->_type = new Denkmal_Elasticsearch_Type_Song($elasticsearchCluster->getClient());
        $this->_type->createIndex();
    }

    public function tearDown() {
        $this->_type->deleteIndex();
        CMTest_TH::clearEnv();
    }

    public function testCrud() {
        $file = new CM_File(DIR_TEST_DATA . 'music.mp3');
        $song1 = Denkmal_Model_Song::create('foo', $file);
        $song2 = Denkmal_Model_Song::create('bar', $file);
        $song3 = Denkmal_Model_Song::create('bar foo', $file);

        $searchQuery = new Denkmal_Elasticsearch_Query_Song();
        $searchQuery->queryText('foo');
        $searchQuery->sortLabel();

        $pagingSource = new CM_PagingSource_Elasticsearch($this->_type, $searchQuery);
        $this->assertEquals(array($song3->getId(), $song1->getId()), $pagingSource->getItems());

        $song2->setLabel('aaa foo');
        $this->assertEquals(array($song2->getId(), $song3->getId(), $song1->getId()), $pagingSource->getItems());

        $song3->delete();
        $this->assertEquals(array($song2->getId(), $song1->getId()), $pagingSource->getItems());
    }

    public function testQueryText() {
        $file = new CM_File(DIR_TEST_DATA . 'music.mp3');
        $song1 = Denkmal_Model_Song::create('foo bar', $file);
        $song2 = Denkmal_Model_Song::create('bar', $file);

        $searchQuery = new Denkmal_Elasticsearch_Query_Song();
        $searchQuery->queryText('Foo');

        $pagingSource = new CM_PagingSource_Elasticsearch($this->_type, $searchQuery);
        $this->assertEquals(array($song1->getId()), $pagingSource->getItems());
    }

}
