<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Item;
use Doctrine\DBAL\Query\QueryBuilder;

$app->post('/item_register/', function (Request $request, Response $response) {
    $data[];
    $id = $item->insert($data);
    $queryBuilder = new QueryBuilder($this->db);
   $queryBuilder
       ->insert('Item')
       ->values(
           array(
               'name' => '?',
               'description' => '?',
               'price' => '?',
           )
       )
       ->setParameter(0, $name)
       ->setParameter(1, $description)
       ->setParameter(2, $price)
       ;
    return $this->view->render(
      $response, 'item_register/index.twig', $data
    );
});
