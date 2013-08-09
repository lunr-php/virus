<?php

/**
 * This file contains a welcome controller class.
 *
 * PHP Version 5.4
 *
 * @category   Controller
 * @package    Template
 * @subpackage Welcome
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Template\Welcome;

use Lunr\Corona\Controller;

/**
 * Welcome controller class
 *
 * @category   Controller
 * @package    Template
 * @subpackage Welcome
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 */
class WelcomeController extends Controller
{

    /**
     * Constructor.
     *
     * @param \Lunr\Core\ConfigServiceLocator $locator Shared instance of the Service Locator
     */
    public function __construct($locator)
    {
        parent::__construct($locator->request(), $locator->response());
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

        $this->response->view = 'welcomeview';
    }

}

?>
