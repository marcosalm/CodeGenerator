<?php
// Delegate static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server'
    && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
) {
    return false;
}
chdir(dirname(__DIR__));

require 'vendor/autoload.php';

if(!defined('FILES_PATH')){
    define('FILES_PATH', dirname(__DIR__). "\\files");
}

if(!defined('OUTPUT_PATH')){
    define('OUTPUT_PATH', dirname(__DIR__). "\\Output");
}

/** @var \Interop\Container\ContainerInterface $container */
$container = require 'config/container.php';

/** @var \Zend\Expressive\Application $app */
$app = $container->get(\Zend\Expressive\Application::class);

$app->get("/teste", function ($req,$res,$next ){
    echo "Action";
});

$app->run();
