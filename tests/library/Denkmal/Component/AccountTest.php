<?php

class Denkmal_Component_AccountTest extends DenkmalTest_TestCase {

    public function testGuest() {
        $cmp = new Denkmal_Component_Account();

        $this->assertComponentNotAccessible($cmp);
    }

    public function testHipsteruser() {
        $viewer = $this->_createViewer(Denkmal_Role::HIPSTER);
        $cmp = new Denkmal_Component_Account(null);
        $page = $this->_renderComponent($cmp, $viewer);

        $this->assertComponentAccessible($cmp, $viewer);

        $this->assertContainsAll(array('Denkmal_Component_ChangePassword'), $page->getHtml());
    }
}
