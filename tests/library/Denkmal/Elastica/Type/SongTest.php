<?php

class Denkmal_Elastica_Type_SongTest extends CMTest_TestCase {

    /** @var Denkmal_Elastica_Type_Song */
    protected static $_type;

    /** @var CM_Search_Index_Cli */
    protected static $_searchIndexCli;

    public function setUp() {
        CM_Config::get()->CM_Search->enabled = true;

        self::$_type = new Denkmal_Elastica_Type_Song();
        self::$_searchIndexCli = new CM_Search_Index_Cli();
        self::$_searchIndexCli->create(self::$_type->getIndex()->getName());
    }

    public function tearDown() {
        self::$_type->getIndex()->delete();
        CMTest_TH::clearEnv();
    }

    public function testCrud() {
        $file = new CM_File(DIR_TEST_DATA . 'music.mp3');
        $song1 = Denkmal_Model_Song::create('foo', $file);
        $song2 = Denkmal_Model_Song::create('bar', $file);
        $song3 = Denkmal_Model_Song::create('bar foo', $file);
        self::$_searchIndexCli->update(self::$_type->getIndex()->getName());

        $searchQuery = new Denkmal_SearchQuery_Song();
        $searchQuery->queryText('foo');
        $searchQuery->sortLabel();

        $pagingSource = new CM_PagingSource_Search(self::$_type, $searchQuery);
        $this->assertEquals(array($song3->getId(), $song1->getId()), $pagingSource->getItems());

        $song2->setLabel('aaa foo');
        self::$_searchIndexCli->update(self::$_type->getIndex()->getName());
        $this->assertEquals(array($song2->getId(), $song3->getId(), $song1->getId()), $pagingSource->getItems());

        $song3->delete();
        self::$_searchIndexCli->update(self::$_type->getIndex()->getName());
        $this->assertEquals(array($song2->getId(), $song1->getId()), $pagingSource->getItems());
    }

    public function testQueryText() {
        $file = new CM_File(DIR_TEST_DATA . 'music.mp3');
        $song1 = Denkmal_Model_Song::create('foo bar', $file);
        $song2 = Denkmal_Model_Song::create('bar', $file);
        self::$_searchIndexCli->update(self::$_type->getIndex()->getName());

        $searchQuery = new Denkmal_SearchQuery_Song();
        $searchQuery->queryText('Foo');

        $pagingSource = new CM_PagingSource_Search(self::$_type, $searchQuery);
        $this->assertEquals(array($song1->getId()), $pagingSource->getItems());
    }

}
