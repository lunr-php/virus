<?php

/**
 * This file contains the API console view class.
 *
 * PHP Version 5.4
 *
 * @category   Library
 * @package    Virus
 * @subpackage Core
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013-2014, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Virus\Core;

/**
 * View class for displaying the API console.
 *
 * @category   Library
 * @package    Virus
 * @subpackage Core
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 */
class ApiConsoleView extends CoreView
{

    /**
     * Constructor.
     *
     * @param \Lunr\Core\ConfigServiceLocator $locator Shared instance of a Service Locator class.
     */
    public function __construct($locator)
    {
        parent::__construct($locator);

        $this->stylesheets[] = $this->statics('stylesheets/apiconsole.css');
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
        $this->print_header();
        $this->print_top();

        include __DIR__ . '/Html/apiconsole.php';

        $this->print_bottom();
    }

}

?>
