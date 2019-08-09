<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Users;
use Model\Dao\Univ;
use Doctrine\DBAL\Query\QueryBuilder;


// マイページ画面コントローラ
$app->get('/mypage/', function (Request $request, Response $response, $args) {
  $data = $this->session["user_info"];
  var_dump($data);

  $sql = "select
*
from Users
inner join Univ
ON Users.univ_id = Univ.id
where Users.id = ?
;";
  $stmt = $this->db->prepare($sql);
  $stmt->bindValue(1, $data['id']);
  $stmt->execute();
  $data = $stmt->fetch();
  $users['user'] = $data;

  // Render index view
  return $this->view->render($response, 'mypage/mypage.twig', $users);

//// ログインしていない時…
//else {
//  // topページに飛ばさせる。
//
//  // Render index view
//  return $this->view->render($response, 'top/top.twig', $data);
//}
});
