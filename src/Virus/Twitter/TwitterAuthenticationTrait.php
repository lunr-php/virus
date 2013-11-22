<?php

/**
 * This file contains a twitter controller trait.
 *
 * PHP Version 5.4
 *
 * @category   Controller
 * @package    Virus
 * @subpackage Twitter
 * @author     Dinos Theodorou <dinos@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Virus\Twitter;

use Lunr\Corona\HttpCode;

/**
 * Twitter trait for authentication methods.
 *
 * @category   Controller
 * @package    Virus
 * @subpackage Twitter
 * @author     Dinos Theodorou <dinos@m2mobi.com>
 */
trait TwitterAuthenticationTrait
{

    /**
     * Store result of the call in the response object.
     *
     * @param Integer $code    Return Code
     * @param String  $message Error Message
     * @param mixed   $info    Additional error information
     *
     * @return void
     */
    abstract protected function set_result($code, $message = NULL, $info = NULL);

    /**
     * Get the access token used for twitter API requests app-auth-only.
     *
     * @return void
     */
    public function get_bearer_token()
    {
        $consumer_key    = $this->request->get_post_data('consumer_key');
        $consumer_secret = $this->request->get_post_data('consumer_secret');
        $user_agent      = $this->request->get_post_data('user_agent');

        if ($consumer_key == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing consumer_key', 'consumer_key');
            return;
        }

        if ($consumer_secret == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing consumer_secret', 'consumer_secret');
            return;
        }

        if ($user_agent == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing user_agent', 'user_agent');
            return;
        }

        $twitter = $this->locator->twitterauth();

        $twitter->consumer_key    = $consumer_key;
        $twitter->consumer_secret = $consumer_secret;
        $twitter->user_agent      = $user_agent;

        $result = $twitter->get_bearer_token();

        $this->response->add_response_data('access_token', $result);

        $this->set_result(HttpCode::OK);
        $this->response->view = 'jsonview';
    }

}