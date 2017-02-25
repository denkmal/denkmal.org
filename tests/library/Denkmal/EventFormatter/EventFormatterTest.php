<?php

class Denkmal_EventFormatter_EventFormatterTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetHtmlGetText() {
        $render = new CM_Frontend_Render();
        $eventFormatter = new Denkmal_EventFormatter_EventFormatter($render);

        $venue = DenkmalTest_TH::createVenue();
        $event = Denkmal_Model_Event::create($venue, 'My <> description', true, true, new DateTime('2017-02-01'));
        $event->setGenres('Rock <> pop');

        Denkmal_Model_EventCategory::create('pop', new CM_Color_RGB(0, 255, 0), ['pop', 'funk']);

        $this->assertRegExp(
            '|My &lt;&gt; description. Rock &lt;&gt; <span class="genre" style="([^"]*)#00FF00([^"]*)">pop</span>|',
            $eventFormatter->getHtml($event)
        );

        $this->assertSame(
            'My <> description. Rock <> pop',
            $eventFormatter->getText($event)
        );
    }
}
