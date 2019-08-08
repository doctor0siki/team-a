<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Item;


// 取引履歴画面コントローラ
$app->get('/transaction/', function (Request $request, Response $response) {

    // ログインされている時……

    // セッションのデータ(user_id)でItemsテーブルを参照し、出品しているすべての商品の情報を取得する。

    // Render index view
    return $this->view->render($response, 'transaction/history.twig', $data);
});

// 取引詳細画面コントローラ
//          ↓の書き方が謎
// $app->get('/transaction/', function (Request $request, Response $response) {

//     // ログインされている時……

//     // GETリクエストデータ(item_id)でItemsテーブルを参照し、出品している商品の情報を取得する。

//     // Render index view
//     return $this->view->render($response, 'transaction/detail.twig', $data);
// });
