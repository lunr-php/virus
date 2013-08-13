<?php

/**
 * Basic Application Configuration File
 *
 * This config file contains the most general application specific
 * configuration values, like
 *
 * <ul>
 * <li>Version numbers</li>
 * <li>Path definitions</li>
 * <li>...</li>
 * </ul>
 *
 * PHP Version 5.4
 *
 * @category   Config
 * @package    Core
 * @subpackage Config
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

## Application setup

/**
 * Application version
 * @global String $config['app_version']
 */
$config['version']          = [];
$config['version']['major'] = '0';
$config['version']['minor'] = '0';
$config['version']['patch'] = '1';
$config['version']['name']  = 'Hitman';

/**
 * Webservice API version
 * @global Integer $config['api']
 */
$config['api'] = 0;

/**
 * The filename of the general error log
 * @global String $config['error_log']
 */
$config['error_log'] = 'virus.log';

/**
 * Default method (unimplemented for webservice access)
 * @global String $config['default_method']
 */
$config['default_method'] = 'index';

/**
 * Load local configuration value adjustments, if they exist
 */
$local_app_conf = dirname(__FILE__) . '/conf.application.local.inc.php';

if (file_exists($local_app_conf))
{
    include_once $local_app_conf;
}

?>
