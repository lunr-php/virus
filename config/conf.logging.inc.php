<?php

/**
 * Application Logging Configuration
 *
 * This config file contains all the log path configurations.
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

## Logging setup

/**
 * Config key for log file paths
 * @global String $config['log']
 */
$config['log'] = array();

/**
 * General log file path for Virus
 * @global String $config['log']['application']
 */
$config['log']['application'] = '/var/log/webapps/infest.lunr.nl/';

/**
 * Load local configuration value adjustments, if they exist
 */
$local_logging_conf = dirname(__FILE__) . '/conf.logging.local.inc.php';

if (file_exists($local_logging_conf))
{
    include_once $local_logging_conf;
}

?>
