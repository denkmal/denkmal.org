<?php

class Denkmal_Elasticsearch_Type_EventTest extends CMTest_TestCase {

    /** @var Denkmal_Elasticsearch_Type_Event */
    protected $_type;

    public function setUp() {
        $this->getServiceManager()->getElasticsearch()->setEnabled(true);

        $this->_type = new Denkmal_Elasticsearch_Type_Event();
        $this->_type->createIndex();
    }

    public function tearDown() {
        $this->_type->deleteIndex();
        CMTest_TH::clearEnv();
    }

    public function testCrud() {
        $venue = Denkmal_Model_Venue::create('foo', false, false);
        $event1 = Denkmal_Model_Event::create($venue, 'foo', true, false, new DateTime('2008-08-01 18:11:31'));
        $event2 = Denkmal_Model_Event::create($venue, 'bar', true, false, new DateTime('2008-08-03 18:11:31'));
        $event3 = Denkmal_Model_Event::create($venue, 'foo bar', true, false, new DateTime('2008-08-02 18:11:31'));

        $searchQuery = new Denkmal_Elasticsearch_Query_Event();
        $searchQuery->queryText('foo');
        $searchQuery->sortFrom();

        $pagingSource = new CM_PagingSource_Elasticsearch($this->_type, $searchQuery);
        $this->assertEquals(array($event3->getId(), $event1->getId()), $pagingSource->getItems());

        $event2->setDescription('aaa foo');
        $this->assertEquals(array($event2->getId(), $event3->getId(), $event1->getId()), $pagingSource->getItems());

        $event3->delete();
        $this->assertEquals(array($event2->getId(), $event1->getId()), $pagingSource->getItems());
    }

    public function testQueryText() {
        $venue = Denkmal_Model_Venue::create('foo', false, false);
        $event1 = Denkmal_Model_Event::create($venue, 'mega foo', true, false, new DateTime('2008-08-01 18:11:31'));
        $event2 = Denkmal_Model_Event::create($venue, 'bar', true, false, new DateTime('2008-08-03 18:11:31'));
        $event3 = Denkmal_Model_Event::create($venue, 'jo FOO: mega', true, false, new DateTime('2008-08-03 18:11:31'));

        $searchQuery = new Denkmal_Elasticsearch_Query_Event();
        $searchQuery->queryText('Foo');

        $pagingSource = new CM_PagingSource_Elasticsearch($this->_type, $searchQuery);
        $this->assertEquals(array($event1->getId(), $event3->getId()), $pagingSource->getItems());
    }

    public function testFilterEnabled() {
        $venue = Denkmal_Model_Venue::create('foo', false, false);
        $event1 = Denkmal_Model_Event::create($venue, 'foo', false, false, new DateTime('2008-08-01 18:11:31'));
        $event2 = Denkmal_Model_Event::create($venue, 'foo', true, false, new DateTime('2008-08-03 18:11:31'));
        $event3 = Denkmal_Model_Event::create($venue, 'foo', true, false, new DateTime('2008-08-03 18:11:31'));

        $searchQuery = new Denkmal_Elasticsearch_Query_Event();
        $searchQuery->filterEnabled();

        $pagingSource = new CM_PagingSource_Elasticsearch($this->_type, $searchQuery);
        $this->assertEquals(array($event2->getId(), $event3->getId()), $pagingSource->getItems());
    }

}
