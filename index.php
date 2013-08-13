<?php

/**
 * index.php is meant to setup basic library lookup paths as well as
 * load the configuration. After the setup is done the request will
 * be handled and forwarded to the respective controller.
 *
 * Lunr's preferred Controller setup uses URL based controller, method
 * and parameter definitions. From the client (browser) side this could
 * look like this:
 *
 *  http://www.example.org/controller/method/parameter1/parameter2/....
 *
 * URL rewriting rules (for apache, lighttpd, etc) should take care of
 * transforming the URL to something resembling this pattern:
 *
 *  http://www.example.org/index.php?controller=controller&method=method&param1=parameter1&....
 *
 * This makes those values available from PHP over the $_GET super global.
 */

// SECURITY: do not allow html tags as URL parameters
foreach($_GET AS $get=>$val)
{
    $_GET[$get] = htmlspecialchars(strip_tags($val));
}

$base = __DIR__;

// Define application config lookup path
set_include_path(
    $base . '/config:'
);

// Include framework config
require_once 'conf.lunr.inc.php';

// Add system config paths to lookup path
set_include_path(
    get_include_path() . ':' .
    $base . "/src" . ':' .
    $config['path']['lunr']
);

// Load and setup class file autloader
require_once 'Lunr/Core/Autoloader.php';
$autoloader = new Lunr\Core\Autoloader();
$autoloader->register();

$config = new Lunr\Core\Configuration($config);

$locator = new Lunr\Core\ConfigServiceLocator($config);

$config->load_file('application');
$config->load_file('logging');
$config->load_database_config();

// Set up application error log
ini_set("error_log", $config['log']['application'] . $config['error_log']);

// Load enums
require_once 'Virus/Enums/Errors.php';

// Request handling
$front = $locator->frontcontroller();

$response   = $locator->response();
$request    = $locator->request();
$controller = $front->get_controller('src');

if ($controller === '')
{
    $response->set_return_code($request->call, $ERROR['not_implemented']);
    $response->set_error_message($request->call, 'Not implemented!');
}
else
{
    $controller = new $controller($locator);
    $controller->set_error_enums($ERROR);

    $front->dispatch($controller);
}

if ($response->get_return_code() === 200)
{
    $view = $response->view;
    $locator->{$view}()->print_page();
}

?>
