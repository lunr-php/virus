<?php

/**
 * This file contains a facebook controller trait.
 *
 * PHP Version 5.4
 *
 * @category   Controller
 * @package    Virus
 * @subpackage Facebook
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Virus\Facebook;

use Lunr\Corona\HttpCode;

/**
 * Facebook trait for authentication methods.
 *
 * @category   Controller
 * @package    Virus
 * @subpackage Facebook
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 */
trait FacebookAuthenticationTrait
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
     * Get the login URL for facebook.
     *
     * @return void
     */
    public function get_login_url()
    {
        $app_id       = $this->request->get_post_data('app_id');
        $app_secret   = $this->request->get_post_data('app_secret');
        $redirect_url = $this->request->get_post_data('redirect_url');
        $scope        = $this->request->get_post_data('scope');

        if ($app_id == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing app_id', 'app_id');
            return;
        }

        if ($app_secret == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing app_secret', 'app_secret');
            return;
        }

        $facebook = $this->locator->facebookauth();

        $facebook->app_id     = $app_id;
        $facebook->app_secret = $app_secret;

        if ($redirect_url != '')
        {
            $facebook->set_redirect_uri($redirect_url);
        }

        if ($scope != '')
        {
            $facebook->set_scope($scope);
        }


        $this->response->add_response_data('url', $facebook->get_login_url());

        $this->set_result(HttpCode::OK);
        $this->response->view = 'jsonview';
    }

    /**
     * Get the logout URL for facebook.
     *
     * @return void
     */
    public function get_logout_url()
    {
        $app_id       = $this->request->get_post_data('app_id');
        $app_secret   = $this->request->get_post_data('app_secret');
        $redirect_url = $this->request->get_post_data('redirect_url');

        if ($app_id == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing app_id', 'app_id');
            return;
        }

        if ($app_secret == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing app_secret', 'app_secret');
            return;
        }

        $facebook = $this->locator->facebookauth();

        $facebook->app_id     = $app_id;
        $facebook->app_secret = $app_secret;

        if ($redirect_url != '')
        {
            $facebook->set_redirect_uri($redirect_url);
        }

        $this->response->add_response_data('url', $facebook->get_logout_url());

        $this->set_result(HttpCode::OK);
        $this->response->view = 'jsonview';
    }

    /**
     * Get the request token data for facebook API requests.
     *
     * @return void
     */
    public function get_request_token()
    {
        $facebook = $this->locator->facebookauth();

        $output = [];

        $output['code']  = $facebook->get_code();
        $output['state'] = $facebook->get_state();

        $this->response->add_response_data('output', $output);

        $this->index();
    }

    /**
     * Get the access token used for facebook API requests.
     *
     * @return void
     */
    public function get_access_token()
    {
        $app_id       = $this->request->get_post_data('app_id');
        $app_secret   = $this->request->get_post_data('app_secret');
        $code         = $this->request->get_post_data('code');
        $redirect_url = $this->request->get_post_data('redirect_url');

        if ($app_id == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing app_id', 'app_id');
            return;
        }

        if ($app_secret == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing app_secret', 'app_secret');
            return;
        }

        if ($code == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing OAuth token', 'code');
            return;
        }

        $facebook = $this->locator->facebookauth();

        $facebook->app_id     = $app_id;
        $facebook->app_secret = $app_secret;
        $facebook->set_code($code);

        if ($redirect_url != '')
        {
            $facebook->set_redirect_uri($redirect_url);
        }

        $this->response->add_response_data('token', $facebook->get_temporary_access_token());
        $this->response->add_response_data('expires', $facebook->get_token_expires());

        $this->set_result(HttpCode::OK);
        $this->response->view = 'jsonview';
    }

    /**
     * Get the access token used for facebook API requests.
     *
     * @return void
     */
    public function get_app_access_token()
    {
        $app_id     = $this->request->get_post_data('app_id');
        $app_secret = $this->request->get_post_data('app_secret');

        if ($app_id == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing app_id', 'app_id');
            return;
        }

        if ($app_secret == '')
        {
            $this->set_result(HttpCode::BAD_REQUEST, 'Missing app_secret', 'app_secret');
            return;
        }

        $facebook = $this->locator->facebookauth();

        $facebook->app_id     = $app_id;
        $facebook->app_secret = $app_secret;

        $this->response->add_response_data('token', $facebook->get_app_access_token());

        $this->set_result(HttpCode::OK);
        $this->response->view = 'jsonview';
    }

}

?>
