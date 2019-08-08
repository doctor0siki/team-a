<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Users;

// 出品履歴画面コントローラ
$app->get('/item_reg_history/', function (Request $request, Response $response) {

  // ユーザーIDをセッションから取得(売る側
  $data = $this->session["user_info"];

  // 取得したユーザーIDでPayinfoテーブルを検索
  $sql = "
    SELECT P.id, I.id AS item_id, I.name, I.price, P.transaction_status
    FROM Payinfo P
       INNER JOIN Items I on P.item_id = I.id
    WHERE P.user1_id = ".$data['id'];
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();

  // セッションのデータ(user_id)でItemsテーブルを参照し、出品しているすべての商品の情報を取得する。
  return $this->view->render($response, 'item_reg_history/history.twig', $result);
});

// 出品詳細画面コントローラ
$app->get('/item_reg_history/detail', function (Request $request, Response $response) {

  // 商品IDを取得
  $get_data = $request->getQueryParams();

  // 取得した商品でPayinfoテーブルを検索
  $sql = "
    SELECT I.id, I.name, I.describe, I.price, P.transaction_status, U.id AS user_id, U.name AS user_name 
    FROM Payinfo P
        INNER JOIN Users U ON P.user2_id = U.id
        INNER JOIN Items I on P.item_id = I.id
    WHERE P.item_id = ".$get_data['id'];
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();

  // セッションのデータ(user_id)でItemsテーブルを参照し、出品しているすべての商品の情報を取得する。
  return $this->view->render($response, 'item_reg_history/detail.twig', $result);
});
