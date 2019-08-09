<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Payinfo;
use Model\Dao\Users;
use Model\Dao\Items;
use Model\Dao\Univ;


// TRADEページのコントローラ
$app->get('/purchase/{id}/', function (Request $request, Response $response, $args) {

  $sql = "select
Users.name as username,
Items.name as itemname,
Tags.name as tagname,
Tags.*,
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
inner join Tags
on Tags.id = Payinfo.id
where Users.id = ?
;";
  $user_id = $this->session["user_info"]['id'];
  $stmt = $this->db->prepare($sql);
  $stmt->bindValue(1, $user_id);
  $stmt->execute();
  $data = $stmt->fetch();
  $users = [];
  $users['user'] = $data;

  $user_id = $this->session["user_info"]['id'];


    return $this->view->render($response, 'purchase/purchase.twig', $users);
});
