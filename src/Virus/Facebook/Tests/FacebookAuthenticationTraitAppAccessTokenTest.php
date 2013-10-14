<?php

/**
 * This file contains the FacebookAuthenticationTraitAppAccessTokenTest class.
 *
 * PHP Version 5.4
 *
 * @category   Controller
 * @package    Facebook
 * @subpackage Tests
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
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
class FacebookAuthenticationTraitAppAccessTokenTest extends FacebookAuthenticationTraitTest
{

    /**
     * Test that get_app_acess_token() sets invalid input error on missing App ID.
     *
     * @covers Virus\Facebook\FacebookAuthenticationTrait::get_app_access_token
     */
    public function testGetAppAccessTokenReturnsInvalidInputForMissingAppID()
    {
        // Non-functional until PHPUnit 3.8 is released
    }

}

?>
