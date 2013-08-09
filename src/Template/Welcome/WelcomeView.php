<?php

/**
 * This file contains the welcome view class.
 *
 * PHP Version 5.4
 *
 * @category   Library
 * @package    Template
 * @subpackage Welcome
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Template\Welcome;

use Lunr\Corona\View;

/**
 * View class for displaying 'Hello World'.
 *
 * @category   Library
 * @package    Template
 * @subpackage Welcome
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 */
class WelcomeView extends View
{

    /**
     * Constructor.
     *
     * @param \Lunr\Core\ConfigServiceLocator $locator Shared instance of a Service Locator class.
     */
    public function __construct($locator)
    {
        parent::__construct($locator->request(), $locator->response(), $locator->config());
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Build the actual display and print it.
     *
     * @return void
     */
    public function print_page()
    {
        echo '<html><head><title>Welcome</title></head><body><h1>Hello World!</h1></body></html>';
    }

}

?>
