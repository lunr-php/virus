<?php

/**
 * This file contains the WelcomeViewBaseTest class.
 *
 * PHP Version 5.4
 *
 * @category   Testing
 * @package    Template
 * @subpackage Welcome
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Template\Welcome\Tests;

/**
 * This class contains simple tests for the WelcomeView class.
 *
 * @category   Testing
 * @package    Template
 * @subpackage Welcome
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @covers     Template\Welcome\WelcomeView
 */
class WelcomeViewBaseTest extends WelcomeViewTest
{

    /**
     * Test print_page() prints hello world.
     *
     * @covers Template\Welcome\WelcomeView::print_page
     */
    public function testPrintPage()
    {
        $this->expectOutputString('<html><head><title>Welcome</title></head><body><h1>Hello World!</h1></body></html>');

        $this->class->print_page();
    }

}

?>
