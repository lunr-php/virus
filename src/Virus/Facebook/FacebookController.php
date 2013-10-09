<?php

/**
 * This file contains a facebook controller class.
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

use Virus\Core\ApiController;

/**
 * Facebook controller class
 *
 * @category   Controller
 * @package    Virus
 * @subpackage Facebook
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 */
class FacebookController extends ApiController
{

    /**
     * Constructor.
     *
     * @param \Lunr\Core\ConfigServiceLocator $locator Shared instance of the Service Locator
     */
    public function __construct($locator)
    {
        parent::__construct($locator);
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Default method.
     *
     * @return void
     */
    public function index()
    {
        $this->set_result('ok');

        $params = [];

        $params['app_id']['title']       = 'App ID';
        $params['app_secret']['title']   = 'App Secret';
        $params['redirect_url']['title'] = 'Redirect URL';
        $params['scope']['title']        = 'Additional permissions';
        $params['token']['title']        = 'Access Token';
        $params['code']['title']         = 'OAuth Token';
        $params['userid']['title']       = 'User ID';
        $params['fields']['title']       = 'Fields';

        $params['app_id']['methods']       = [ 'get_login_url', 'get_logout_url', 'get_access_token', 'get_user_profile' ];
        $params['app_secret']['methods']   = [ 'get_login_url', 'get_logout_url', 'get_access_token', 'get_user_profile' ];
        $params['redirect_url']['methods'] = [ 'get_login_url', 'get_logout_url', 'get_access_token' ];
        $params['scope']['methods']        = [ 'get_login_url' ];
        $params['token']['methods']        = [ 'get_user_profile' ];
        $params['code']['methods']         = [ 'get_access_token' ];
        $params['userid']['methods']       = [ 'get_user_profile' ];
        $params['fields']['methods']       = [ 'get_user_profile' ];

        $this->response->add_response_data('title', 'Facebook');
        $this->response->add_response_data('platform', 'facebook');
        $this->response->add_response_data('methods', $this->get_api_methods());
        $this->response->add_response_data('parameters', $params);
        $this->response->view = 'apiconsoleview';
    }

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
            $this->set_result('invalid_input', 'Missing app_id', 'app_id');
            return;
        }

        if ($app_secret == '')
        {
            $this->set_result('invalid_input', 'Missing app_secret', 'app_secret');
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

        $this->set_result('ok');
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
            $this->set_result('invalid_input', 'Missing app_id', 'app_id');
            return;
        }

        if ($app_secret == '')
        {
            $this->set_result('invalid_input', 'Missing app_secret', 'app_secret');
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

        $this->set_result('ok');
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
            $this->set_result('invalid_input', 'Missing app_id', 'app_id');
            return;
        }

        if ($app_secret == '')
        {
            $this->set_result('invalid_input', 'Missing app_secret', 'app_secret');
            return;
        }

        if ($code == '')
        {
            $this->set_result('invalid_input', 'Missing OAuth token', 'code');
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

        $this->set_result('ok');
        $this->response->view = 'jsonview';
    }

    /**
     * Get the facebook user profile.
     *
     * @return void
     */
    public function get_user_profile()
    {
        $app_id     = $this->request->get_post_data('app_id');
        $app_secret = $this->request->get_post_data('app_secret');
        $token      = $this->request->get_post_data('token');
        $userid     = $this->request->get_post_data('userid');
        $fields     = $this->request->get_post_data('fields');

        if ($app_id == '')
        {
            $this->set_result('invalid_input', 'Missing app_id', 'app_id');
            return;
        }

        if ($app_secret == '')
        {
            $this->set_result('invalid_input', 'Missing app_secret', 'app_secret');
            return;
        }

        if ($token == '')
        {
            $this->set_result('invalid_input', 'Missing access token', 'token');
            return;
        }

        $facebook = $this->locator->facebookuserprofile();

        $facebook->app_id       = $app_id;
        $facebook->app_secret   = $app_secret;
        $facebook->access_token = $token;

        if ($userid != '')
        {
            $facebook->set_profile_id($userid);
        }

        if ($fields != '')
        {
            $facebook->set_fields(explode(',', $fields));
        }

        $facebook->get_data();

        $old = error_reporting(0);

        $this->response->add_response_data('id', $facebook->get_id());
        $this->response->add_response_data('name', $facebook->get_name());
        $this->response->add_response_data('first_name', $facebook->get_first_name());
        $this->response->add_response_data('middle_name', $facebook->get_middle_name());
        $this->response->add_response_data('last_name', $facebook->get_last_name());
        $this->response->add_response_data('gender', $facebook->get_gender());
        $this->response->add_response_data('locale', $facebook->get_locale());
        $this->response->add_response_data('link', $facebook->get_link());
        $this->response->add_response_data('username', $facebook->get_username());
        $this->response->add_response_data('age_range', $facebook->get_age_range());
        $this->response->add_response_data('third_party_id', $facebook->get_third_party_id());
        $this->response->add_response_data('updated_time', $facebook->get_updated_time());
        $this->response->add_response_data('timezone', $facebook->get_timezone());
        $this->response->add_response_data('installed', $facebook->get_installed());
        $this->response->add_response_data('verified', $facebook->get_verified());
        $this->response->add_response_data('currency', $facebook->get_currency());
        $this->response->add_response_data('cover', $facebook->get_cover());
        $this->response->add_response_data('devices', $facebook->get_devices());
        $this->response->add_response_data('payment_pricepoints', $facebook->get_payment_pricepoints());
        $this->response->add_response_data('payment_mobile_pricepoints', $facebook->get_payment_mobile_pricepoints());
        $this->response->add_response_data('video_upload_limits', $facebook->get_video_upload_limits());
        $this->response->add_response_data('security_settings', $facebook->get_security_settings());
        $this->response->add_response_data('picture', $facebook->get_picture());
        $this->response->add_response_data('languages', $facebook->get_languages());
        $this->response->add_response_data('bio', $facebook->get_bio());
        $this->response->add_response_data('quotes', $facebook->get_quotes());
        $this->response->add_response_data('birthday', $facebook->get_birthday());
        $this->response->add_response_data('education', $facebook->get_education());
        $this->response->add_response_data('email', $facebook->get_email());
        $this->response->add_response_data('hometown', $facebook->get_hometown());
        $this->response->add_response_data('interested_in', $facebook->get_interested_in());
        $this->response->add_response_data('location', $facebook->get_location());
        $this->response->add_response_data('political', $facebook->get_political());
        $this->response->add_response_data('religion', $facebook->get_religion());
        $this->response->add_response_data('favorite_athletes', $facebook->get_favorite_athletes());
        $this->response->add_response_data('favorite_teams', $facebook->get_favorite_teams());
        $this->response->add_response_data('relationship_status', $facebook->get_relationship_status());
        $this->response->add_response_data('significant_other', $facebook->get_significant_other());
        $this->response->add_response_data('website', $facebook->get_website());
        $this->response->add_response_data('work', $facebook->get_work());

        error_reporting($old);

        $this->set_result('ok');
        $this->response->view = 'jsonview';
    }

    /**
     * Get API methods implemented by this controller.
     *
     * @return array $names Array of method names.
     */
    protected function get_api_methods()
    {
        $methods = parent::get_api_methods();

        $key = array_search('get_request_token', $methods);

        unset($methods[$key]);

        return $methods;
    }

}

?>
