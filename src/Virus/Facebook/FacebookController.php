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

use Lunr\Corona\HttpCode;
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

    use FacebookAuthenticationTrait;
    use FacebookPageTrait;
    use FacebookUserTrait;

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
        $this->set_result(HttpCode::OK);

        $params = [];

        $params['app_id']['title']       = 'App ID';
        $params['app_secret']['title']   = 'App Secret';
        $params['redirect_url']['title'] = 'Redirect URL';
        $params['scope']['title']        = 'Additional permissions';
        $params['token']['title']        = 'Access Token';
        $params['code']['title']         = 'OAuth Token';
        $params['userid']['title']       = 'User ID';
        $params['pageid']['title']       = 'Page ID';
        $params['fields']['title']       = 'Fields';

        $params['app_id']['methods']       = [ 'get_login_url', 'get_access_token', 'get_app_access_token', 'get_page', 'get_user_profile' ];
        $params['app_secret']['methods']   = [ 'get_login_url', 'get_access_token', 'get_app_access_token', 'get_page', 'get_user_profile' ];
        $params['redirect_url']['methods'] = [ 'get_login_url', 'get_logout_url', 'get_access_token' ];
        $params['scope']['methods']        = [ 'get_login_url' ];
        $params['token']['methods']        = [ 'get_logout_url', 'get_page', 'get_user_profile' ];
        $params['code']['methods']         = [ 'get_access_token' ];
        $params['userid']['methods']       = [ 'get_user_profile' ];
        $params['pageid']['methods']       = [ 'get_page' ];
        $params['fields']['methods']       = [ 'get_page', 'get_user_profile' ];

        $this->response->add_response_data('title', 'Facebook');
        $this->response->add_response_data('platform', 'facebook');
        $this->response->add_response_data('methods', $this->get_api_methods());
        $this->response->add_response_data('parameters', $params);
        $this->response->view = 'apiconsoleview';
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
