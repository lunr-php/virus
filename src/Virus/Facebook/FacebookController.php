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

        $this->response->add_response_data('title', 'Facebook');
        $this->response->add_response_data('platform', 'facebook');
        $this->response->add_response_data('methods', $this->get_api_methods());
        $this->response->view = 'apiconsoleview';
    }

}

?>
