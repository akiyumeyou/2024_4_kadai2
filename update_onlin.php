<?php
session_start();
ini_set('display_errors', "On");
error_reporting(E_ALL);

//1. POSTデータ取得
$name = $_POST['user_name']; // 
$nic_name = $_POST['nic_name'];
$ivent = $_POST['ivent'];
$id     = $_POST["id"];

//2. DB接続します
include("funcs.php");
//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE P_onlin_table SET name=:name, nic_name=:nic_name, ivent=:ivent, date=NOW() WHERE id=:id");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':nic_name', $nic_name, PDO::PARAM_STR);
$stmt->bindValue(':ivent', $ivent, PDO::PARAM_STR);
// ':date' 用のbindValueは不要。dateカラムにはNOW()を使用
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); // 実行


//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("kanri_onlin.php");
}
?>
