<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/item_register/', function (Request $request, Response $response) {
    $data['title'] = 'string';
    return $this->view->render($response, 'item_register/index.twig', $data);
});
