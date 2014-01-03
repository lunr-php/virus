<?php

/**
 * This file contains the HomeViewBaseTest class.
 *
 * PHP Version 5.4
 *
 * @category   Testing
 * @package    Virus
 * @subpackage Home
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013-2014, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Virus\Home\Tests;

/**
 * This class contains simple tests for the HomeView class.
 *
 * @category   Testing
 * @package    Virus
 * @subpackage Home
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @covers     Virus\Home\HomeView
 */
class HomeViewBaseTest extends HomeViewTest
{

    /**
     * Test that the stylesheets list contains all required elements.
     */
    public function testStylesheetsListIsCorrect()
    {
        $list = $this->get_reflection_property_value('stylesheets');

        $this->assertCount(4, $list);
        $this->assertContains('http://yui.yahooapis.com/3.11.0/build/cssreset/cssreset-min.css', $list);
        $this->assertContains('http://yui.yahooapis.com/3.11.0/build/cssfonts/cssfonts-min.css', $list);
        $this->assertContains('/stylesheets/main.css', $list);
        $this->assertContains('/stylesheets/home.css', $list);
    }

    /**
     * Test print_page() prints an html page.
     *
     * @covers Virus\Home\HomeView::print_page
     */
    public function testPrintPage()
    {
        $this->expectOutputregex("/<!DOCTYPE html>\n<html>(.|\n)+<\/html>/");

        $this->class->print_page();
    }

}

?>
