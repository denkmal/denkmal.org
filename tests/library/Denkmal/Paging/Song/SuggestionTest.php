<?php

class Denkmal_Paging_Song_SuggestionTest extends CMTest_TestCase {

    /** @var Denkmal_Elasticsearch_Type_Song */
    protected $_type;

    public function setUp() {
        CM_Config::get()->CM_Search->enabled = true;
        $this->_type = new Denkmal_Elasticsearch_Type_Song();
        $this->_type->createVersioned();
    }

    public function tearDown() {
        $this->_type->getIndex()->delete();
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

        $event->setTitle('mega bar jo');
        $paging = new Denkmal_Paging_Song_Suggestion($event);
        $this->assertEquals(array($song3, $song1, $song2), $paging->getItems());
    }
}
