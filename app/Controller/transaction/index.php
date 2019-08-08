<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Item;

// 取引履歴画面コントローラ
$app->get('/transaction/', function (Request $request, Response $response) {

  // ユーザーIDをセッションから取得(買う側
  $data = $this->session["user_info"];

  // 取得したユーザーIDでPayinfoテーブルを検索
  $sql = "
    SELECT P.id, I.id, I.name, I.price, P.transaction_status
    FROM Payinfo P
      INNER JOIN Users U ON P.user2_id = U.id
      INNER JOIN Items I on P.item_id = I.id
    WHERE P.user2_id = ".$data['id'];
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();

  // セッションのデータ(user_id)でItemsテーブルを参照し、出品しているすべての商品の情報を取得する。
  return $this->view->render($response, 'transaction/history.twig', $result);
});

// 取引詳細画面コントローラ
$app->get('/transaction/detail', function (Request $request, Response $response) {

  // ユーザーIDをセッションから取得
  $get_data = $request->getQueryParams();

  // 取得したユーザーIDでPayinfoテーブルを検索
  $sql = "
    SELECT I.id, I.name, I.describe, I.price, P.transaction_status
    FROM Payinfo P
        INNER JOIN Users U ON P.user2_id = U.id
        INNER JOIN Items I on P.item_id = I.id
    WHERE P.item_id = ".$get_data['id'];
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();

  // セッションのデータ(user_id)でItemsテーブルを参照し、出品しているすべての商品の情報を取得する。
  return $this->view->render($response, 'transaction/detail.twig', $result);
});
