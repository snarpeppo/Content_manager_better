<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;


$app->get('/test', function (Request $request, Response $response, $args) {
    $db = new db_connection();
    $query = 'SELECT * FROM content_source';
    $temp = $db->fetchAll($query);

    $view = Twig::fromRequest($request);
    return $view->render($response, 'testTwig.twig', [
        'items' => $temp,

    ]);
});
