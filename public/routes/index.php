<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;


$app->get('/', function (Request $request, Response $response, $args) {
    $db = new db_connection();
    $temp = $db->fetchAll('SELECT * FROM content_tag');

    $view = Twig::fromRequest($request);
    return $view->render($response, 'index.twig', [
        'tags' => $temp,

    ]);
});
