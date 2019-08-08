<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Item;


// 取引履歴画面コントローラ
$app->get('/transaction/', function (Request $request, Response $response) {

  // ユーザーIDをセッションから取得
//  $data = $this->session["user_info"];

  // 取得したユーザーIDでPayinfoテーブルを検索
  $queryBuilder = new QueryBuilder($this->db);
  $queryBuilder->select("P.id, I.id, I.name, I.price, P.transaction_status
    FROM Payinfo P
      INNER JOIN Users U ON P.user2_id = U.id
      INNER JOIN Items I on P.item_id = I.id
    WHERE P.user2_id = 2");
  $query = $queryBuilder->execute();
  $result = $query->fetchAll();

  // セッションのデータ(user_id)でItemsテーブルを参照し、出品しているすべての商品の情報を取得する。
  return $this->view->render($response, 'transaction/history.twig', $result);
});

// 取引詳細画面コントローラ
//          ↓の書き方が謎
<<<<<<< HEAD
=======
// $app->get('/transaction/', function (Request $request, Response $response) {

//     // ログインされている時……

//     // GETリクエストデータ(item_id)でItemsテーブルを参照し、出品している商品の情報を取得する。

//     // Render index view
//     return $this->view->render($response, 'transaction/detail.twig', $data);
// });
>>>>>>> 81868c005518bc83da19272b2b365cd9c6cbe619
