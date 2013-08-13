<?php

/**
 * This file contains the HomeControllerTest class.
 *
 * PHP Version 5.4
 *
 * @category   Testing
 * @package    Virus
 * @subpackage Home
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Virus\Home\Tests;

use Virus\Home\HomeController;
use Lunr\Halo\LunrBaseTest;
use ReflectionClass;

/**
 * This class contains common setup routines, providers
 * and shared attributes for testing the HomeController class.
 *
 * @category   Testing
 * @package    Virus
 * @subpackage Home
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @covers     Virus\Home\HomeController
 */
abstract class HomeControllerTest extends LunrBaseTest
{

    /**
     * Mock instance of the Request class.
     * @var \Lunr\Core\Request
     */
    protected $request;

    /**
     * Mock instance of the Response class.
     * @var \Lunr\Core\Response
     */
    protected $response;

    /**
     * Mock instance of the Service Locator class.
     * @var \Lunr\Core\ConfigServiceLocator
     */
    protected $locator;

    /**
     * Test Case Constructor.
     */
    public function setUp()
    {
        $this->response = $this->getMock('Lunr\Corona\Response');
        $this->request  = $this->getMock('Lunr\Corona\RequestInterface');

        $this->locator = $this->getMockBuilder('Lunr\Core\ConfigServiceLocator')
                              ->disableOriginalConstructor()
                              ->getMock();

        $map = [
            [ 'response', [], $this->response ],
            [ 'request', [], $this->request ],
        ];

        $this->locator->expects($this->any())
                      ->method('__call')
                      ->will($this->returnValueMap($map));

        $this->reflection = new ReflectionClass('Virus\Home\HomeController');

        $this->class = new HomeController($this->locator);
    }

    /**
     * Test Case Destructor.
     */
    public function tearDown()
    {
        unset($this->request);
        unset($this->response);
        unset($this->reflection);
        unset($this->class);
    }

}

?>
