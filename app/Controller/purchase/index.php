<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Payinfo;
use Model\Dao\Users;
use Model\Dao\Items;
use Model\Dao\Univ;


// TRADEページのコントローラ
$app->get('/purchase/{id}/', function (Request $request, Response $response, $args) {

    $itemId = $args['id'];

    $sql = "select
    Items.user_id,
    from Items 
    where Items.id = ?
    ;";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(1, $itemId);
    $stmt->execute();
    $data = $stmt->fetch();

    $user1_id = $data['user_id'];
    $user2_id = $this->session["user_info"]['id'];

  // Payinfoに購入情報を登録
  // 必要な情報…… user1_id:session_id, user2_id:I.user_id, item_id:I.id
  $sql = "
    INSERT INTO
        Payinfo(user1_id, user2_id, item_id, transaction_status, payout_date)
    VALUES 
        (:user1_id, :user2_id, :item_id, 0, NOW())";
  $stmt = $this->db->prepare($sql);
  $params = array(':user_id' => $user1_id,
                  ':user2_id' => $user2_id,
                  'item_id' => $itemId);
  $stmt->execute($params);

  // Itemsのステータスも変更しておく。1:取引完了(sold状態)
  $sql = "
        UPADTE Items
         SET payout_state = 1
         WHERE id = ".$itemId;
  $stmt = $this->db->prepare($sql);
  $stmt->execute();


  // 購入者側のmoneyを引いておく。
  // 購入者のmoneyを取得
  $sql = "SELECT money FROM Users WHERE id = ".$user2_id;
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $data_cal = $stmt->fetchAll();

  // moneyからpriceを引く
  $data_cal['money'] = $data_cal['money'] - $data['price'];

  // 残った額でUPDATE
  $sql = "UPDATE Users 
            SET money = " . $data_cal['money'] .
            " WHERE id = " .$user2_id;
  $stmt = $this->db->prepare($sql);
  $stmt->execute();

    // Render index view
    return $this->view->render($response, 'thanks/thanks.twig');
});
