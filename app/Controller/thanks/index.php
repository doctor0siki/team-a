<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Payinfo;
use Model\Dao\Users;
use Model\Dao\Items;
use Model\Dao\Univ;

$app->get('/thanks/{id}/', function (Request $request, Response $response, $args) {

  $sql = "select
Users.name as username,
Items.name as itemname,
Univ.*,
Users.*,
Items.*,
Payinfo.*
from Users
inner join Payinfo
on Users.id = Payinfo.id
inner join Items
on Items.id = Payinfo.id
inner join Univ
on Univ.id = Payinfo.id
where Users.id = ?
;";
  $id = $args['id'];
  $stmt = $this->db->prepare($sql);
  $stmt->bindValue(1, $id);
  $stmt->execute();
  $data = $stmt->fetch();
  $users = [];
  $users['user'] = $data;



    // Render index view
    return $this->view->render($response, 'thanks/thanks.twig', $users);
});
