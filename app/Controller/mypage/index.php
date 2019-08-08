<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Users;
use Doctrine\DBAL\Query\QueryBuilder;


// マイページ画面コントローラ
$app->get('/mypage/', function (Request $request, Response $response) {
  $data = $this->session["user_info"];

  // ログインしている時…
  // if (!empty($this->session["user_info"])) {

  // セッションのデータ(user_id)でUsersテーブルを参照し、ユーザー情報を取得する。
  $queryBuilder = new QueryBuilder($this->db);
  $queryBuilder->select("* FROM Users WHERE id = ".$data['id']);
  $query = $queryBuilder->execute();
  $result = $query->fetchAll();

  // Render index view
  return $this->view->render($response, 'mypage/mypage.twig', $result);

//// ログインしていない時…
//else {
//  // topページに飛ばさせる。
//
//  // Render index view
//  return $this->view->render($response, 'top/top.twig', $data);
//}
});
