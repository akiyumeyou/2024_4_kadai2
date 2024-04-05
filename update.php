<?php
session_start();
ini_set('display_errors', "On");
error_reporting(E_ALL);

//1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["email"];
$naiyou = $_POST["naiyou"];
$date_option = $_POST["date_option"];
$age    = $_POST["age"];
$id     = $_POST["id"];

//2. DB接続します
include("funcs.php");
//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_an_table SET name=:name,email=:email,age=:age,date_option=:date_option,naiyou=:naiyou WHERE id=:id");
$stmt->bindValue(':name',   $name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email',  $email,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age',    $age,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':date_option', $date_option, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("kanri_form.php");
}
?>
