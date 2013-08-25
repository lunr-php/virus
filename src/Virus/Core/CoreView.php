<?php

/**
 * This file contains the core view class.
 *
 * PHP Version 5.4
 *
 * @category   Library
 * @package    Core
 * @subpackage View
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Virus\Core;

use Lunr\Corona\View;

/**
 * View class for displaying 'Hello World'.
 *
 * @category   Library
 * @package    Core
 * @subpackage View
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 */
abstract class CoreView extends View
{

    /**
     * List of stylesheets to include.
     * @var array;
     */
    protected $stylesheets;

    /**
     * Constructor.
     *
     * @param \Lunr\Core\ConfigServiceLocator $locator Shared instance of a Service Locator class.
     */
    public function __construct($locator)
    {
        parent::__construct($locator->request(), $locator->response(), $locator->config());

        $this->stylesheets[] = 'http://yui.yahooapis.com/3.11.0/build/cssreset/cssreset-min.css';
        $this->stylesheets[] = 'http://yui.yahooapis.com/3.11.0/build/cssfonts/cssfonts-min.css';
        $this->stylesheets[] = $this->statics('stylesheets/main.css');
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Build the head section of the HTML page.
     *
     * @return void
     */
    protected function print_header()
    {
        include __DIR__ . '/Html/header.php';
    }

    /**
     * Build the top section of the HTML page.
     *
     * @return void
     */
    protected function print_top()
    {
        include __DIR__ . '/Html/top.php';
    }

    /**
     * Build the bottom section of the HTML page.
     *
     * @return void
     */
    protected function print_bottom()
    {
        include __DIR__ . '/Html/bottom.php';
    }

    /**
     * Generate css include statements.
     *
     * @return String $links Generated html code for including css stylesheets
     */
    protected function include_stylesheets()
    {
        $links = '';

        foreach($this->stylesheets as $stylesheet)
        {
            $links .= '<link rel="stylesheet" type="text/css" href="' . $stylesheet . '">' . "\n";
        }

        return $links;
    }

}

?>
