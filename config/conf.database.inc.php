<?php

/**
 * Virus Database Access Configuration File
 * This config file contains the database access configuration, like:
 *
 * <ul>
 * <li>Host</li>
 * <li>Username</li>
 * <li>Password</li>
 * <li>Database name</li>
 * <li>...</li>
 * </ul>
 *
 * PHP Version 5.4
 *
 * @category   Config
 * @package    Database
 * @subpackage Config
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013-2014, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

## Database setup

$database = array();

## Live Database

$database['live']             = array();
$database['live']['rw_host']  = '';
$database['live']['ro_host']  = '';
$database['live']['username'] = '';
$database['live']['password'] = '';
$database['live']['database'] = '';
$database['live']['driver']   = 'mysql';

$db = $database['live'];

/**
 * Load local configuration value adjustments, if they exist
 */
$local_db_conf = dirname(__FILE__) . '/conf.database.local.inc.php';

if (file_exists($local_db_conf))
{
    include_once $local_db_conf;
}

?>
