<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/php/db_connection.php';
require_once __DIR__ . '/../src/php/utils.php';


use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app = AppFactory::create();
$app->setBasePath("/Progetti/content_manager_better/public");
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$twig = Twig::create(__DIR__ . '/view', ['cache' => false]);

$app->add(TwigMiddleware::create($app, $twig));

require_once __DIR__ . '/routes/autoload.php';


$app->run();
