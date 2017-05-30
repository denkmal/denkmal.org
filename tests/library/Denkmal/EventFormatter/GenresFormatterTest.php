<?php

class Denkmal_EventFormatter_GenresFormatterTest extends CMTest_TestCase {

    protected function tearDown() {
        CMTest_TH::clearEnv();
    }

    public function testGetHtml() {
        $render = new CM_Frontend_Render();
        $filter = new Denkmal_EventFormatter_GenresFormatter($render);

        $this->assertSame(
            'Foo1, foo2, bar',
            $filter->getHtml('foo1, FOO2, bar'));

        $eventCategory = Denkmal_Model_EventCategory::create('cat-foo', new CM_Color_RGB(255, 0, 0), ['foo1']);
        $this->assertRegExp(
            '|^<span class="genre" style="([^"]*)#FF0000([^"]*)">Foo1</span>, foo2, bar$|',
            $filter->getHtml('foo1, FOO2, bar'));

        $eventCategory->addGenre('foo2');
        $this->assertRegExp(
            '|<span class="genre" style="([^"]*)#FF0000([^"]*)">Foo1</span>, <span class="genre" style="([^"]*)#FF0000([^"]*)">foo2</span>, bar$|',
            $filter->getHtml('foo1, FOO2, bar'));
    }

    public function testGetHtmlRockNRoll() {
        $render = new CM_Frontend_Render();
        $filter = new Denkmal_EventFormatter_GenresFormatter($render);

        Denkmal_Model_EventCategory::create('my-cat', new CM_Color_RGB(255, 0, 0), [
            'rock', "rock'n'roll", "r'n'r"
        ]);

        $this->assertRegExp(
            '|<span class="genre" style="([^"]*)">Rock&#039;n&#039;roll</span>|',
            $filter->getHtml("rock'n'roll"));

        $this->assertRegExp(
            '|<span class="genre" style="([^"]*)">R&#039;n&#039;r</span>|',
            $filter->getHtml("r'n'r"));
    }

    public function testGetHtmlBoogie() {
        $render = new CM_Frontend_Render();
        $filter = new Denkmal_EventFormatter_GenresFormatter($render);

        Denkmal_Model_EventCategory::create('my-cat', new CM_Color_RGB(255, 0, 0), [
            'disco', 'funk', 'boogie',
        ]);

        $this->assertRegExp(
            '|<span class="genre" style="([^"]*)">Disco</span>|',
            $filter->getHtml('Disco, funk, boogie'));

        $this->assertRegExp(
            '|<span class="genre" style="([^"]*)">funk</span>|',
            $filter->getHtml('Disco, funk, boogie'));

        $this->assertRegExp(
            '|<span class="genre" style="([^"]*)">boogie</span>|',
            $filter->getHtml('Disco, funk, boogie'));
    }

    public function testGetHtmlContained() {
        $render = new CM_Frontend_Render();
        $filter = new Denkmal_EventFormatter_GenresFormatter($render);

        Denkmal_Model_EventCategory::create('cat-punkrock', new CM_Color_RGB(0, 255, 0), ['punk rock']);
        Denkmal_Model_EventCategory::create('cat-rock', new CM_Color_RGB(255, 0, 0), ['rock']);

        $this->assertRegExp(
            '|<span class="genre" style="([^"]*)#00FF00([^"]*)">Punk rock</span>$|',
            $filter->getHtml('punk rock'));

        $this->assertRegExp(
            '|<span class="genre" style="([^"]*)#00FF00([^"]*)">Punk rock</span>, <span class="genre" style="([^"]*)#FF0000([^"]*)">rock</span>|',
            $filter->getHtml('punk rock, rock'));
    }
}
