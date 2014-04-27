<?php

class Denkmal_Paging_Song_SuggestionTest extends CMTest_TestCase {

    /** @var Denkmal_Elasticsearch_Type_Song */
    protected $_typeSong;

    /** @var Denkmal_Elasticsearch_Type_Event */
    protected $_typeEvent;

    public function setUp() {
        CM_Config::get()->CM_Elasticsearch_Client->enabled = true;

        $this->_typeSong = new Denkmal_Elasticsearch_Type_Song();
        $this->_typeSong->createVersioned();

        $this->_typeEvent = new Denkmal_Elasticsearch_Type_Event();
        $this->_typeEvent->createVersioned();
    }

    public function tearDown() {
        $this->_typeSong->getIndex()->delete();
        $this->_typeEvent->getIndex()->delete();
        CMTest_TH::clearEnv();
    }

    public function testGetItems() {
        $file = new CM_File(DIR_TEST_DATA . 'music.mp3');
        $song1 = Denkmal_Model_Song::create('foo', $file);
        $song2 = Denkmal_Model_Song::create('bar', $file);
        $song3 = Denkmal_Model_Song::create('bar foo', $file);
        $song4 = Denkmal_Model_Song::create('zoo', $file);

        Denkmal_Model_Link::create('foo', 'http://foo.com', true);
        Denkmal_Model_Link::create('bar', 'http://bar.com', true);
        Denkmal_Model_Link::create('my zoo', 'http://my-zoo.com', true);

        $venue = Denkmal_Model_Venue::create('my venue', false, false);
        $event = Denkmal_Model_Event::create($venue, 'my event', true, false, new DateTime());

        $paging = new Denkmal_Paging_Song_Suggestion($event);
        $this->assertEquals(array(), $paging->getItems());

        $event->setDescription('mega foo test');
        $paging = new Denkmal_Paging_Song_Suggestion($event);
        $this->assertEquals(array($song1, $song3), $paging->getItems());

        $event->setDescription('mega foo bar test');
        $paging = new Denkmal_Paging_Song_Suggestion($event);
        $this->assertEquals(array($song3, $song1, $song2), $paging->getItems());
    }

    public function testGetItemsApostrophe() {
        $file = new CM_File(DIR_TEST_DATA . 'music.mp3');
        $song1 = Denkmal_Model_Song::create('don\'t kill the beast - so alone', $file);

        Denkmal_Model_Link::create('Don\'t Kill the Beast', 'http://foo.com', true);

        $venue = Denkmal_Model_Venue::create('my venue', false, false);
        $event = Denkmal_Model_Event::create($venue, 'my event: Don\'t Kill the Beast', true, false, new DateTime());

        $paging = new Denkmal_Paging_Song_Suggestion($event);
        $this->assertEquals(array($song1), $paging->getItems());
    }
}
