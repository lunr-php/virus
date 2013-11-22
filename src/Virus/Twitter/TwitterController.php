<?php

/**
 * This file contains a twitter controller class.
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
use Virus\Core\ApiController;

/**
 * Twitter controller class
 *
 * @category   Controller
 * @package    Virus
 * @subpackage Twitter
 * @author     Dinos Theodorou <dinos@m2mobi.com>
 */
class TwitterController extends ApiController
{

    use TwitterAuthenticationTrait;
    use TwitterSearchTrait;

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

        $params['user_agent']['title']      = 'User Agent';
        $params['consumer_key']['title']    = 'Consumer Key';
        $params['consumer_secret']['title'] = 'Consumer Secret';
        $params['bearer_token']['title']    = 'Bearer Token';
        $params['params']['title']          = 'Pairs of parameters as param1=value1&param2=value2';

        $params['user_agent']['methods']      = ['get_bearer_token'];
        $params['consumer_key']['methods']    = ['get_bearer_token'];
        $params['consumer_secret']['methods'] = ['get_bearer_token'];
        $params['bearer_token']['methods']    = ['search_tweets'];
        $params['params']['methods']          = ['search_tweets'];

        $this->response->add_response_data('title', 'Twitter');
        $this->response->add_response_data('platform', 'twitter');
        $this->response->add_response_data('methods', $this->get_api_methods());
        $this->response->add_response_data('parameters', $params);
        $this->response->view = 'apiconsoleview';
    }

}

?>
