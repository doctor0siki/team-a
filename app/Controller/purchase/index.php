<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Payinfo;
use Model\Dao\Users;
use Model\Dao\Items;
use Model\Dao\Univ;

// TRADEページのコントローラ
$app->get('/purchase', function (Request $request, Response $response) {

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
where Items.id = 1
;";

  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $data = $stmt->fetchAll();
  $users = [];
  $users['users'] = $data;



    // Render index view
    return $this->view->render($response, 'purchase/purchase.twig', $users);
});
