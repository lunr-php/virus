<?php

/**
 * This file contains the home view class.
 *
 * PHP Version 5.4
 *
 * @category   Library
 * @package    Virus
 * @subpackage Home
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Virus\Home;

use Virus\Core\CoreView;

/**
 * View class for displaying 'Hello World'.
 *
 * @category   Library
 * @package    Virus
 * @subpackage Home
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 */
class HomeView extends CoreView
{

    /**
     * Constructor.
     *
     * @param \Lunr\Core\ConfigServiceLocator $locator Shared instance of a Service Locator class.
     */
    public function __construct($locator)
    {
        parent::__construct($locator);

        $this->stylesheets[] = $this->statics('stylesheets/home.css');
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

        include __DIR__ . '/Html/grid.php';

        $this->print_bottom();
    }

}

?>
