<?php

/**
 * This file contains the json view class.
 *
 * PHP Version 5.4
 *
 * @category   View
 * @package    Virus
 * @subpackage Core
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Virus\Core;

use Lunr\Corona\View;

/**
 * View class for displaying JSON return values.
 *
 * @category   View
 * @package    Virus
 * @subpackage Core
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 */
class JsonView extends View
{

    /**
     * Reference to the Logger class.
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * Constructor.
     *
     * @param \Lunr\Core\ConfigServiceLocator $locator Shared instance of a Service Locator class.
     */
    public function __construct($locator)
    {
        parent::__construct($locator->request(), $locator->response(), $locator->configuration());
        $this->logger = $locator->logger();
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
        $data = [ 'result' => $this->response->get_return_code() ] + $this->response->get_response_data();

        if ($this->request->sapi == 'cli')
        {
            echo json_encode($data, JSON_PRETTY_PRINT) . "\n";
        }
        else
        {
            echo json_encode($data);
        }
   }

}

?>
