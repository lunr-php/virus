<?php

/**
 * Basic Framework Configuration
 *
 * This config file contains Framework relevant config keys.
 *
 * PHP Version 5.4
 *
 * @category   Config
 * @package    Core
 * @subpackage Config
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013-2014, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

## Lunr setup

/**
 * Version of the Lunr Framework to use
 * @global $config['lunr']['version']
 */
$config['lunr']['version'] = '0.2';

/**
 * Array of path definitions
 * @global Array $config['path']
 */
$config['path'] = array();

/**
 * Path to the Lunr Framework Code
 * @global String $config['path']['lunr']
 */
$config['path']['lunr'] = '/var/www/apps/Lunr-' . $config['lunr']['version'] . '/src/';

$config['path']['statics'] = 'statics/';

/**
 * Default protocol for web queries
 * @global String $config['default_protocol']
 */
$config['default_protocol'] = 'http';

/**
 * Default URL for web queries
 * @global String $config['default_url']
 */
$config['default_url'] = '';

/**
 * Default sub-path for web queries
 * @global String $config['default_webpath']
 */
$config['default_webpath'] = '/';

/**
 * Load local configuration value adjustments, if they exist
 */
$local_lunr_conf = dirname(__FILE__) . '/conf.lunr.local.inc.php';

if (file_exists($local_lunr_conf))
{
    include_once $local_lunr_conf;
}

?>
