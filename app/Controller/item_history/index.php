<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Item;

// Making item detail
$app->get('/item_history/',
    function (Request $request, Response $response) {
$sql_query = "SELECT * FROM Items WHERE id =? ";

$stmt = $this->db->prepare($sql_query);
$stmt->bindValue(1, 1);

$stmt->execute();
$result["row"] = $stmt->fetchAll();

return $this->view->render(
  $response, 'item_history/history.twig', $result);
});
// id, name, describe, price, pay_state,
