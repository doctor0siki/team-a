<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Payinfo;
use Model\Dao\Users;
use Model\Dao\Items;
use Model\Dao\Univ;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

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
;";

  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $data = $stmt->fetchAll();
  $users = [];
  $users['users'] = $data;

    // Render index view
    return $this->view->render($response, 'top/index.twig', $users);
});
