<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/hello', function (Request $request, Response $response) {
    $data = [];
    return $this->view->render($response, 'hello/index.twig', $data);
});

