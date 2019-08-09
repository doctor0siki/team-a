<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Item;

// 取引履歴画面コントローラ
$app->get('/transaction/', function (Request $request, Response $response) {

  // ユーザーIDをセッションから取得(買う側
  //$data = $this->session["user_info"];
  $data['id'] = 2;

  // 取得したユーザーIDでPayinfoテーブルを検索
  $sql = "
    SELECT P.id, I.id, I.name, I.price, I.describe, P.transaction_status
    FROM Payinfo P
      INNER JOIN Users U ON P.user2_id = U.id
      INNER JOIN Items I on P.item_id = I.id
    WHERE P.user2_id = ?";
  $stmt = $this->db->prepare($sql);
  $stmt->bindValue(1, $data['id']);
  $stmt->execute();
  $params['result'] = $stmt->fetchAll();
  echo '<pre>';
  var_dump($params['result']);
  echo '</pre>';

  // セッションのデータ(user_id)でItemsテーブルを参照し、取引しているすべての商品の情報を取得する。
  return $this->view->render($response, 'transaction/history.twig', $params);
});

// 取引詳細画面コントローラ
$app->get('/transaction/detail/', function (Request $request, Response $response) {
// $result = [];
  // 取引IDをgetリクエストから取得
  $get_data = $request->getQueryParams();

  // 取得したユーザーIDでPayinfoテーブルを検索
  $sql = "
        SELECT I.id, I.name, I.`describe`, I.price, P.transaction_status
        FROM Payinfo P
        INNER JOIN Items I on P.item_id = I.id
        WHERE P.id = ?";
  $stmt = $this->db->prepare($sql);
  $stmt->bindValue(1, $get_data['id']);
  $stmt->execute();
  $params['result'] = $stmt->fetchAll();

  // セッションのデータ(user_id)でItemsテーブルを参照し、取引しているすべての商品の情報を取得する。
  return $this->view->render($response, 'transaction/detail.twig', $params);
});
