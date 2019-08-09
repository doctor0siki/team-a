<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Payinfo;
use Model\Dao\Users;
use Model\Dao\Items;
use Model\Dao\Univ;

// 商品購入処理のコントローラ
$app->get('/purchase/', function (Request $request, Response $response) {
  // 商品IDをGETリクエストで取得
  $get_data = $request->getQueryParams();

  $sql = "SELECT user_id, price FROM Items WHERE id = ".$get_data['id'];
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $data = $stmt->fetchAll();
//  $data['user_id']がuser1_id


  // ログインIDをセッションから取得
  $session['login_id'] = 2;     // 2は例

  // Payinfoに購入情報を登録
  // 必要な情報…… user1_id:session_id, user2_id:I.user_id, item_id:I.id
  $sql = "
    INSERT INTO
        Payinfo(user1_id, user2_id, item_id, transaction_status, payout_date)
    VALUES 
        (:user1_id, :user2_id, :item_id, 0, NOW())";
  $stmt = $this->db->prepare($sql);
  $params = array(':user_id' => $data['user_id'],
                  ':user2_id' => $session['login_id'],
                  'item_id' => $get_data['id']);
  $stmt->execute($params);

  // Itemsのステータスも変更しておく。1:取引完了(sold状態)
  $sql = "
        UPADTE Items
         SET payout_state = 1
         WHERE id = ".$get_data['id'];
  $stmt = $this->db->prepare($sql);
  $stmt->execute();


  // 購入者側のmoneyを引いておく。
  // 購入者のmoneyを取得
  $sql = "SELECT money FROM Users WHERE id = ".$session['login_id'];
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $data_cal = $stmt->fetchAll();

  // moneyからpriceを引く
  $data_cal['money'] = $data_cal['money'] - $data['price'];

  // 残った額でUPDATE
  $sql = "UPDATE Users 
            SET money = {$data_cal['money']}
            WHERE id = {$session['login_id']}";
  $stmt = $this->db->prepare($sql);
  $stmt->execute();

    // Render index view
    return $this->view->render($response, 'purchase/purchase.twig', $users);
});
