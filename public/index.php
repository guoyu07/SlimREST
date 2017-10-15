<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

session_start();

require __DIR__ . '/../vendor/autoload.php';

$config = Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . '/../app/config.yml'))['config'];
$app = new Slim\App($config);

require __DIR__ . '/../app/dependencies.php';

require __DIR__ . '/../app/handlers.php';

require __DIR__ . '/../app/middleware.php';

require __DIR__ . '/../app/controllers.php';

require __DIR__ . '/../app/routes.php';

$app->run();
