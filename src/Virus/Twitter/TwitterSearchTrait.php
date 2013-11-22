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
 * Twitter trait for search methods.
 *
 * @category   Controller
 * @package    Virus
 * @subpackage Twitter
 * @author     Dinos Theodorou <dinos@m2mobi.com>
 */
trait TwitterSearchTrait
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
    public function search_tweets()
    {
        $bearer_token = $this->request->get_post_data('bearer_token');
        $params       = $this->request->get_post_data('params');

        if ($bearer_token == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing bearer token', 'bearer_token');
            return;
        }

        if ($params == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing parameters', 'params');
            return;
        }

        $pairs = explode('&', $params);

        $search_params = [];

        foreach ($pairs as $pair)
        {
            if(stripos($pair, '=') === false)
            {
                $this->set_result(HttpCode::BAD_REQUEST, 'Wrong parameter syntax', 'param_syntax');
                return;
            }

            list($key, $value) = explode('=', $pair);

            $search_params[$key] = $value;
        }

        $twitter = $this->locator->twitterauth();
        $search  = $this->locator->twittersearch();

        $twitter->bearer_token = $bearer_token;

        $tweets = $search->search_tweets($search_params);

        $this->response->add_response_data('tweets', $tweets);

        $this->set_result(HttpCode::OK);
        $this->response->view = 'jsonview';
    }

}

?>
