<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/displayAA', function (Request $request, Response $response) {
    $data = [];
    return $this->view->render($response, 'display/index.twig', $data);
});
