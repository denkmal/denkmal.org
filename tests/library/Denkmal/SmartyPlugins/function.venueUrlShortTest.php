<?php

require_once CM_Util::getModulePath('Denkmal') . 'library/Denkmal/SmartyPlugins/function.venueUrlShort.php';

class smarty_function_venueUrlShortTest extends CMTest_TestCase {

    /**
     * @var Smarty_Internal_Template
     */
    private $_template;

    public function setUp() {
        $smarty = new Smarty();
        $render = new CM_Frontend_Render();

        $this->_template = $smarty->createTemplate('string:');
        $this->_template->assignGlobal('render', $render);
    }

    public function testRender() {
        $data = [
            'https://www.example.com/foo'        => 'example.com',
            'http://www.example.com/foo'         => 'example.com',
            'http://example.com/foo'             => 'example.com',
            'https://www.facebook.com/foo'       => 'facebook.com/foo',
            'http://facebook.com/foo'            => 'facebook.com/foo',
            'https://www.facebook.com/pages/foo' => 'facebook.com/foo',
            'https://www.facebook.com/Pages/foo' => 'facebook.com/foo',
        ];

        foreach ($data as $url => $expected) {
            $this->assertSame($expected,
                smarty_function_venueUrlShort(['url' => $url], $this->_template));
        }
    }
}
