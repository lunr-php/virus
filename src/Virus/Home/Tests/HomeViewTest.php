<?php

/**
 * This file contains the HomeViewTest class.
 *
 * PHP Version 5.4
 *
 * @category   Testing
 * @package    Virus
 * @subpackage Home
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013-2014, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Virus\Home\Tests;

use Virus\Home\HomeView;
use Lunr\Halo\LunrBaseTest;
use ReflectionClass;

/**
 * This class contains common setup routines, providers
 * and shared attributes for testing the HomeView class.
 *
 * @category   Testing
 * @package    Virus
 * @subpackage Home
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @covers     Virus\Home\HomeView
 */
abstract class HomeViewTest extends LunrBaseTest
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
        $config         = $this->getMock('Lunr\Core\Configuration');

        $this->locator = $this->getMockBuilder('Lunr\Core\ConfigServiceLocator')
                              ->disableOriginalConstructor()
                              ->getMock();

        $map = [
            [ 'response', [], $this->response ],
            [ 'request', [], $this->request ],
            [ 'config', [], $config ]
        ];

        $this->locator->expects($this->any())
                      ->method('__call')
                      ->will($this->returnValueMap($map));

        $this->reflection = new ReflectionClass('Virus\Home\HomeView');

        $this->class = new HomeView($this->locator);
    }

    /**
     * Test Case Destructor.
     */
    public function tearDown()
    {
        unset($this->request);
        unset($this->response);
        unset($this->locator);
        unset($this->reflection);
        unset($this->class);
    }

}

?>
