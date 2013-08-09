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
$config->load_database_config();

// Load enums
require_once 'Template/Enums/Errors.php';

// Request handling
$front = $locator->frontcontroller();

$controller = $front->get_controller('src');
$controller = new $controller($locator);
$controller->set_error_enums($ERROR);

$front->dispatch($controller);

$response = $locator->response();

if ($response->get_return_code() === 200)
{
    $view = $response->view;
    $locator->{$view}()->print_page();
}

