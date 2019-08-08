<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/hello', function (Request $request, Response $response) {
<<<<<<< HEAD
    $data = [];
    return $this->view->render($response, 'hello/index.twig', $data);
});

=======
  $data = [];
  return $this->view->render($response, 'hello/index.twig', $data);
});
>>>>>>> 61f7aad0e8cb9534b8767f71f2287544a8f5ee4b
