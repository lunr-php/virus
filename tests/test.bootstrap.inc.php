<?php

/**
 * PHPUnit bootstrap file.
 *
 * Set include path and initialize autoloader.
 *
 * PHP Version 5.4
 *
 * @category   Loaders
 * @package    Tests
 * @subpackage Tests
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013-2014, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

$base = __DIR__ . '/..';

// Include framework config
require_once $base . '/config/conf.lunr.inc.php';

set_include_path(
    $base . '/src:' .
    $base . "/config:" .
    $config['path']['lunr'] . ':' .
    get_include_path()
);

// Load and setup class file autloader
require_once 'Lunr/Core/Autoloader.php';

$autoloader = new Lunr\Core\Autoloader();
$autoloader->register();

define('TEST_STATICS', __DIR__ . '/statics');

?>
