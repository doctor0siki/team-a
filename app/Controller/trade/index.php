<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Payinfo;
use Model\Dao\Users;
use Model\Dao\Items;

// TRADEページのコントローラ
$app->get('/trade', function (Request $request, Response $response) {

    $data = [];
    

    // Render index view
    return $this->view->render($response, 'trade/trade.twig', $data);
});
