<?php

/**
 * This file contains the CoreViewBaseTest class.
 *
 * PHP Version 5.4
 *
 * @category   Testing
 * @package    Virus
 * @subpackage Home
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Virus\Core\Tests;

/**
 * This class contains simple tests for the CoreView class.
 *
 * @category   Testing
 * @package    Virus
 * @subpackage Home
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @covers     Virus\Core\CoreView
 */
class CoreViewBaseTest extends CoreViewTest
{

    /**
     * Test that the stylesheets list contains all required elements.
     */
    public function testStylesheetsListIsCorrect()
    {
        $list = $this->get_reflection_property_value('stylesheets');

        $this->assertCount(3, $list);
        $this->assertContains('http://yui.yahooapis.com/3.11.0/build/cssreset/cssreset-min.css', $list);
        $this->assertContains('http://yui.yahooapis.com/3.11.0/build/cssfonts/cssfonts-min.css', $list);
        $this->assertContains('/stylesheets/main.css', $list);
    }

    /**
     * Test generating stylesheet include links for no stylesheets.
     *
     * @covers Virus\Core\CoreView::include_stylesheets
     */
    public function testIncluceStylesheetsWithNoStylesheets()
    {
        $this->set_reflection_property_value('stylesheets', []);

        $method = $this->get_accessible_reflection_method('include_stylesheets');

        $this->assertSame('', $method->invoke($this->class));
    }

    /**
     * Test generating stylesheet include links for one stylesheet.
     *
     * @covers Virus\Core\CoreView::include_stylesheets
     */
    public function testIncludeStylesheetsWithOneStylesheet()
    {
        $this->set_reflection_property_value('stylesheets', [ 'style1.css' ]);

        $method = $this->get_accessible_reflection_method('include_stylesheets');

        $this->assertStringEqualsFile(TEST_STATICS . '/Core/stylesheet_1.html', $method->invoke($this->class));
    }

    /**
     * Test generating stylesheet include links for multiple stylesheets.
     *
     * @covers Virus\Core\CoreView::include_stylesheets
     */
    public function testIncludeStylesheetsWithMultipleStylesheets()
    {
        $this->set_reflection_property_value('stylesheets', [ 'style1.css', 'style2.css' ]);

        $method = $this->get_accessible_reflection_method('include_stylesheets');

        $this->assertStringEqualsFile(TEST_STATICS . '/Core/stylesheet_2.html', $method->invoke($this->class));
    }

}

?>
