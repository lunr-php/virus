<?php

/**
 * This file contains the WelcomeControllerBaseTest class.
 *
 * PHP Version 5.4
 *
 * @category   Testing
 * @package    Template
 * @subpackage Welcome
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Template\Welcome\Tests;

/**
 * This class contains simple tests for the WelcomeController class.
 *
 * @category   Testing
 * @package    Template
 * @subpackage Welcome
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @covers     Template\Welcome\WelcomeController
 */
class WelcomeControllerBaseTest extends WelcomeControllerTest
{

    /**
     * Test that the Request class is passed correctly in the constructor.
     */
    public function testRequestIsPassedCorrectly()
    {
        $this->assertSame($this->request, $this->get_reflection_property_value('request'));
    }

    /**
     * Test that the Response class is passed correctly in the constructor.
     */
    public function testResponseIsPassedCorrectly()
    {
        $this->assertSame($this->response, $this->get_reflection_property_value('response'));
    }

    /**
     * Test that index() returns a success case.
     *
     * @covers Template\Welcome\WelcomeController::index
     */
    public function testIndexReturnsSuccessful()
    {
        $this->set_reflection_property_value('error', [ 'ok' => 200 ]);

        $map = [[ 'call', 'controller/method' ]];

        $this->request->expects($this->exactly(1))
                      ->method('__get')
                      ->will($this->returnValueMap($map));

        $this->response->expects($this->once())
                       ->method('set_return_code')
                       ->with('controller/method', $this->equalTo(200));

        $this->class->index();
    }

}

?>
