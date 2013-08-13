<?php

/**
 * This file contains all the possible errors.
 *
 * PHP Version 5.4
 *
 * @category   Errors
 * @package    Core
 * @subpackage Enums
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

$ERROR = [];

/**
 * Request handled successfully (200)
 * @global Integer $ERROR['ok']
 */
$ERROR['ok'] = 200;

/**
 * Internal Server Error (500)
 * @global Integer $ERROR['server_error']
 */
$ERROR['server_error'] = 500;

?>
