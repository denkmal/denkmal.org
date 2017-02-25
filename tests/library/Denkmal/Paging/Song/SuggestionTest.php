<?php

class Denkmal_Paging_Song_SuggestionTest extends CMTest_TestCase {

    /** @var Denkmal_Elasticsearch_Type_Song */
    protected $_typeSong;

    /** @var Denkmal_Elasticsearch_Type_Event */
    protected $_typeEvent;

    public function setUp() {
        $elasticsearch = $this->getServiceManager()->getElasticsearch();
        $elasticsearch->setEnabled(true);

        $this->_typeSong = new Denkmal_Elasticsearch_Type_Song($elasticsearch->getClient());
        $this->_typeSong->createIndex();

        $this->_typeEvent = new Denkmal_Elasticsearch_Type_Event($elasticsearch->getClient());
        $this->_typeEvent->createIndex();
    }

    public function tearDown() {
        $this->_typeSong->deleteIndex();
        $this->_typeEvent->deleteIndex();
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $file = new CM_File(DIR_TEST_DATA . 'music.mp3');
        $song1 = Denkmal_Model_Song::create('foo', $file);
        $song2 = Denkmal_Model_Song::create('bar', $file);
        $song3 = Denkmal_Model_Song::create('bar foo', $file);
        $song4 = Denkmal_Model_Song::create('zoo', $file);

        $venue = DenkmalTest_TH::createVenue();
        $event = Denkmal_Model_Event::create($venue, 'my event', true, false, new DateTime());

        $paging = new Denkmal_Paging_Song_Suggestion($event);
        $this->assertEquals([], $paging->getItems());

        $event->setDescription('mega foo test');
        $paging = new Denkmal_Paging_Song_Suggestion($event);
        $this->assertEquals([$song1, $song3], $paging->getItems());

        $event->setDescription('mega foo bar test');
        $paging = new Denkmal_Paging_Song_Suggestion($event);
        $this->assertEquals([$song3, $song1, $song2], $paging->getItems());
    }

    public function testGetItemsApostrophe() {
        $file = new CM_File(DIR_TEST_DATA . 'music.mp3');
        $song1 = Denkmal_Model_Song::create('don\'t kill the beast - so alone', $file);

        $venue = DenkmalTest_TH::createVenue();
        $event = Denkmal_Model_Event::create($venue, 'my event: Don\'t Kill the Beast', true, false, new DateTime());

        $paging = new Denkmal_Paging_Song_Suggestion($event);
        $this->assertEquals([$song1], $paging->getItems());
    }
}
