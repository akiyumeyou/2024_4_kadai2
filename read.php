<?php
// 開発中のエラーを表示する設定
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("funcs.php"); // DB接続やセッションチェックの関数を含むファイル

$pdo = db_conn(); // DB接続

// POSTデータ取得
$name        = $_POST["name"];
$email       = $_POST["email"];
$age         = $_POST["age"];
$date_option = $_POST["date_option"]; // セレクトボックスから選択された値
$naiyou      = $_POST["naiyou"];
$id          = $_POST["id"];

// データベースへの登録情報更新
$stmt = $pdo->prepare("UPDATE gs_an_table SET name=:name, email=:email, age=:age, date_option=:date_option, naiyou=:naiyou WHERE id=:id");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':age', $age, PDO::PARAM_INT);
$stmt->bindValue(':date_option', $date_option, PDO::PARAM_STR);
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute();

// 実行後の処理
if($status==false){
    // エラーの場合はエラー情報を出力
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
} else {
    // エラーがなければoutput.phpへリダイレクト
    header("Location: output.php?name=".urlencode($name)."&date_option=".urlencode($date_option));
    exit;
}
?>
