<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$dir = __DIR__;
require $dir . '../../../vendor/autoload.php';
require $dir . '/../../config.php';
require_once '../php/db_connection.php';
//require $dir . '../../../config.php';
require '../php/utils.php';


ini_set('display_errors', 1);
error_reporting(E_ALL);

$app = AppFactory::create();
$app->setBasePath("/Progetti/content_manager_better/public");
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$twig = Twig::create('../../public', ['cache' => false]);

$app->add(TwigMiddleware::create($app, $twig));

$db = new db_connection();

$app->get('/test', function (Request $request, Response $response, $args) {
    $db = new db_connection();

    $query = 'SELECT * FROM content_source';
    $temp = $db->fetchAll($query);
    _json_ok($temp);

    $view = Twig::fromRequest($request);
    $params = $request->getQueryParams();
    var_dump($params);
    return $view->render($response, 'testTwig.twig', [
        'test' => $params
    ]);
})->setName('test');


$app->run();
