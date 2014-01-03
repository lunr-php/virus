<?php

/**
 * This file contains the FacebookAuthenticationTraitTest class.
 *
 * PHP Version 5.4
 *
 * @category   Controller
 * @package    Facebook
 * @subpackage Tests
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013-2014, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Virus\Facebook\Tests;

use Virus\Facebook\FacebookAuthenticationTrait;
use Lunr\Halo\LunrBaseTest;
use ReflectionClass;

/**
 * This class contains the tests for the FacebookAuthenticationTrait.
 *
 * @category   Controller
 * @package    Facebook
 * @subpackage Tests
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @covers     Virus\Facebook\FacebookAuthenticationTrait
 */
abstract class FacebookAuthenticationTraitTest extends LunrBaseTest
{

    /**
     * Instance of the FacebookAuthenticationTrait.
     * @var \Virus\Facebook\FacebookAuthenticationTrait
     */
    protected $class;

    /**
     * Reflection instance of the ErrorEnumTrait.
     * @var \ReflectionClass
     */
    protected $reflection;

    /**
     * Mock instance of the Request class
     * @var \Lunr\Corona\RequestInterface
     */
    protected $request;

    /**
     * Mock instance of the Response class
     * @var \Lunr\Corona\Response
     */
    protected $response;

    /**
     * Mock instance of the Service Locator class
     * @var \Lunr\Core\ConfigServiceLocator
     */
    protected $locator;

    /**
     * Mock instance of the Facebook Authentication class
     * @var \Lunr\Spark\Facebook\Authentication
     */
    protected $facebookauth;

    /**
     * Test case constructor.
     */
    public function setUp()
    {
        $this->request  = $this->getMock('Lunr\Corona\RequestInterface');
        $this->response = $this->getMock('Lunr\Corona\Response');
        $this->locator  = $this->getMockBuilder('Lunr\Core\ConfigServiceLocator')
                               ->disableOriginalConstructor()
                               ->getMock();

        $this->facebookauth = $this->getMockBuilder('Lunr\Spark\Facebook\Authentication')
                                   ->disableOriginalConstructor()
                                   ->getMock();

        $this->class      = $this->getMockForTrait('Virus\Facebook\FacebookAuthenticationTrait');
        $this->reflection = new ReflectionClass($this->class);

        $this->set_reflection_property_value('request', $this->request);
        $this->set_reflection_property_value('response', $this->response);
        $this->set_reflection_property_value('locator', $this->locator);
    }

    /**
     * Test case destructor.
     */
    public function tearDown()
    {
        unset($this->request);
        unset($this->response);
        unset($this->locator);
        unset($this->facebookauth);
        unset($this->class);
        unset($this->reflection);
    }

}
