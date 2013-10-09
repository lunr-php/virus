<?php

/**
 * This file contains an API controller class.
 *
 * PHP Version 5.5
 *
 * @category   Controller
 * @package    Virus
 * @subpackage Core
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Virus\Core;

use Lunr\Corona\Controller;
use ReflectionClass;

/**
 * API controller class
 *
 * @category   Controller
 * @package    Virus
 * @subpackage Core
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 */
abstract class ApiController extends Controller
{

    /**
     * Shared instance of the Service Locator.
     * @var \Lunr\Core\ConfigServiceLocator
     */
    protected $locator;

    /**
     * Constructor.
     *
     * @param \Lunr\Core\ConfigServiceLocator $locator Shared instance of the Service Locator
     */
    public function __construct($locator)
    {
        parent::__construct($locator->request(), $locator->response());

        $this->locator = $locator;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        unset($this->locator);

        parent::__destruct();
    }

    /**
     * Get API methods implemented by this controller.
     *
     * @return array $names Array of method names.
     */
    protected function get_api_methods()
    {
        $methods = (new ReflectionClass($this))->getMethods();
        $non_api = [ '__construct', '__destruct', 'index' ];

        $names = [];

        foreach ($methods as $index => $method)
        {
            if ($method->getDeclaringClass()->getName() !== static::class)
            {
                unset($methods[$index]);
            }
            elseif (in_array($method->getName(), $non_api) === TRUE)
            {
                unset($methods[$index]);
            }
            elseif ($method->isPublic() === FALSE)
            {
                unset($methods[$index]);
            }
            else
            {
                $names[] = $method->getName();
            }
        }

        return $names;
    }

}

?>
