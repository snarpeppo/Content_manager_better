<?php
$dir = __DIR__;
require_once $dir . '/../vendor/autoload.php';
require_once $dir . '/../config.php';
require_once $dir . '/../src/php/db_connection.php';
require_once $dir . '/../src/php/utils.php';


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

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
