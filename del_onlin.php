<?php
session_start();
//1. POSTデータ取得
$id = $_GET["id"];
ini_set('display_errors', "On");
error_reporting(E_ALL);

//2. DB接続します
include("funcs.php");
//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();
$pdo = db_conn();
//３．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM P_onlin_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("kanri_onlin.php");
}
?>
