<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Payinfo;
use Model\Dao\Users;
use Model\Dao\Items;
use Model\Dao\Univ;

$app->get('/thanks/{id}/', function (Request $request, Response $response, $args) {

  $itemId = $args['id'];

  $sql = "select
  Items.user_id,
  Items.price
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

  $this->db->insert('Payinfo', [
      'user1_id' => $user1_id,
      'user2_id' => $user2_id,
      'payout_date' => date("Y-m-d H:i:s"),
      'item_id' => $itemId,
      'transaction_status' => 1
  ]);

// Itemsのステータスも変更しておく。1:取引完了(sold状態)
$this->db->update('Items', ['payout_state' => 1], ['id'=>$itemId]);



  // 購入者側のmoneyを引いておく。
// 購入者のmoneyを取得
$sql = "SELECT money FROM Users WHERE id = ".$user2_id;
$stmt = $this->db->prepare($sql);
$stmt->execute();
$data_cal = $stmt->fetch();

// moneyからpriceを引く
$balance = $data_cal['money'] - $data['price'];


$this->db->update('Users', ['money' => $balance], ['id'=>$user2_id]);



    // Render index view
    return $this->view->render($response, 'thanks/thanks.twig');
});
