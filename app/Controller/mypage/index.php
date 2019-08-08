<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;


// マイページ画面コントローラ
$app->get('/mypage/', function (Request $request, Response $response) {

    // ログインされている時……

    // セッションのデータ(user_id)でUsersテーブルを参照し、ユーザー情報を取得する。

    // Render index view
    return $this->view->render($response, 'mypage/mypage.twig', $data);
});
