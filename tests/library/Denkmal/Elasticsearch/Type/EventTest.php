<?php

class Denkmal_Elasticsearch_Type_EventTest extends CMTest_TestCase {

    /** @var Denkmal_Elasticsearch_Type_Event */
    protected $_type;

    public function setUp() {
        $elasticsearchCluster = $this->getServiceManager()->getElasticsearch();
        $elasticsearchCluster->setEnabled(true);

        $this->_type = new Denkmal_Elasticsearch_Type_Event($elasticsearchCluster->getClient());
        $this->_type->createIndex();
    }

    public function tearDown() {
        $this->_type->deleteIndex();
        CMTest_TH::clearEnv();
    }

    public function testCrud() {
        $venue = DenkmalTest_TH::createVenue();
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
        $venue = DenkmalTest_TH::createVenue();
        $event1 = Denkmal_Model_Event::create($venue, 'mega foo', true, false, new DateTime('2008-08-01 18:11:31'));
        $event2 = Denkmal_Model_Event::create($venue, 'bar', true, false, new DateTime('2008-08-03 18:11:31'));
        $event3 = Denkmal_Model_Event::create($venue, 'jo FOO: mega', true, false, new DateTime('2008-08-03 18:11:31'));

        $searchQuery = new Denkmal_Elasticsearch_Query_Event();
        $searchQuery->queryText('Foo');

        $pagingSource = new CM_PagingSource_Elasticsearch($this->_type, $searchQuery);
        $this->assertEquals(array($event1->getId(), $event3->getId()), $pagingSource->getItems());
    }

    public function testFilterEnabled() {
        $venue = DenkmalTest_TH::createVenue();
        $event1 = Denkmal_Model_Event::create($venue, 'foo', false, false, new DateTime('2008-08-01 18:11:31'));
        $event2 = Denkmal_Model_Event::create($venue, 'foo', true, false, new DateTime('2008-08-03 18:11:31'));
        $event3 = Denkmal_Model_Event::create($venue, 'foo', true, false, new DateTime('2008-08-03 18:11:31'));

        $searchQuery = new Denkmal_Elasticsearch_Query_Event();
        $searchQuery->filterEnabled();

        $pagingSource = new CM_PagingSource_Elasticsearch($this->_type, $searchQuery);
        $this->assertEquals(array($event2->getId(), $event3->getId()), $pagingSource->getItems());
    }

    public function testFilterRegion() {
        $region1 = DenkmalTest_TH::createRegion('Regio 1', 'regio1', 'r1');
        $region2 = DenkmalTest_TH::createRegion('Regio 2', 'regio2', 'r2');

        $venue1 = DenkmalTest_TH::createVenue(null, null, null, $region1);
        $venue2 = DenkmalTest_TH::createVenue(null, null, null, $region2);

        $event1 = Denkmal_Model_Event::create($venue1, 'event 1', false, false, new DateTime('2008-08-01 18:11:31'));
        $event2 = Denkmal_Model_Event::create($venue2, 'event 2', false, false, new DateTime('2008-08-01 18:11:31'));

        $searchQuery = new Denkmal_Elasticsearch_Query_Event();
        $searchQuery->filterRegion($region2);

        $pagingSource = new CM_PagingSource_Elasticsearch($this->_type, $searchQuery);
        $this->assertEquals(array($event2->getId()), $pagingSource->getItems());
    }

}
