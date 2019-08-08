<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Item;

$app->post('/item_register_done/',
  function (Request $request, Response $response) {
    $data = $request->getQueryParams();
    debug($data);
  return ;
});
