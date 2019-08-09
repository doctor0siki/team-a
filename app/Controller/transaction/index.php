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

  // セッションのデータ(user_id)でItemsテーブルを参照し、取引しているすべての商品の情報を取得する。
  return $this->view->render($response, 'transaction/history.twig', $result);
});

// 取引詳細画面コントローラ
$app->get('/transaction/detail', function (Request $request, Response $response) {
  // getで取引ID、sessionでuser_idを取得する
  $get_data = $request->getQueryParams(); // $get_data['id']  商品ID
//  $session = $this->session["user_info"]; // $session['id'] 買い手側のユーザーID

  // 取得した取引IDでPayinfoテーブルを検索
  // 必要なのは、商品ID・商品名・商品説明・商品価格・payout_date
  //          ・transaction_status(0:取引中の為取引完了ボタンが必要、1:取引完了の為取引完了情報を表示。)
  $sql = "
    SELECT I.id, I.name, I.describe, I.price, P.payout_date, P.transaction_status
    FROM Items I
        INNER JOIN Payinfo P on I.id = P.item_id
    WHERE I.id = ".$get_data['id'];
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();

  // $result内のデータ郡を表示する。
  return $this->view->render($response, 'transaction/detail.twig', $result);
});

// 取引完了画面コントローラ
$app->post('/transaction/complete', function (Request $request, Response $response) {
  // 取引完了ボタンが押された時の処理

  // 取引IDをpostリクエストから取得
  $get_data = $request->getQueryParams();

  // 商品価格分の料金データを売り手userのmoneyに追加する。
  // 売り手userのmoneyを取得
  $sql = "
    SELECT U.id, U.money, I.price
    FROM Payinfo P
      INNER JOIN Users U on P.user1_id = U.id
      INNER JOIN Items I on P.item_id = I.id
    WHERE P.id = 3;".$get_data['id'];
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $data = $stmt->fetchAll();

  $data['money'] = $data['money'] - $data['price'];

  // user1のmoneyを更新
  $sql = "UPDATE Users SET money = {$data['money']} WHERE id = {$data['id']}";
  $stmt = $this->db->prepare($sql);
  $stmt->execute();

  // Payinfoのpayout_dateとtrasaction_statusを更新する
  $sql = "UPDATE Payinfo
            SET payout_date = NOW(),
                transaction_status = 1
            WHERE id = {$get_data['id']}";
  $stmt = $this->db->prepare($sql);
  $stmt->execute();

  // 取引IDからPayinfoを検索する(表示用)
  $sql = "
    SELECT I.id, I.name, I.describe, I.price, P.payout_date, P.transaction_status
    FROM Items I
        INNER JOIN Payinfo P on I.id = P.item_id
    WHERE I.id = ".$get_data['id'];
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();

  // 取引完了ボタンがただのステータス表示に切り替わる。
  return $this->view->render($response, 'transaction/detail.twig', $result);
});
