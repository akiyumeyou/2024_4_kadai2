<?php
// 開発中エラー確認
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("funcs.php");
$pdo = db_conn(); // DB接続関数の呼び出し

if(isset($_POST["ivent"])) {
    $name = $_POST['user_name']; // フォームのname属性からユーザー名を取得
    $user_id = $_POST['user_id']; // フォームからuser_idを取得
    $nic_name = $_POST['nic_name']; // フォームのname属性からニックネームを取得
    $ivent = $_POST['ivent']; // フォームのname属性からイベント名を取得

    // データ登録SQL作成
    $stmt = $pdo->prepare("INSERT INTO P_onlin_table(name, user_id, nic_name, ivent, date) VALUES (:name, :user_id, :nic_name, :ivent, sysdate())");
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->bindValue(':nic_name', $nic_name, PDO::PARAM_STR);
    $stmt->bindValue(':ivent', $ivent, PDO::PARAM_STR);
    $status = $stmt->execute(); // SQL文を実行

    // データ登録処理後
    if($status == false) {
        sql_error($stmt); // SQLエラーの場合の処理
    } else {
        redirect("index.php"); // 処理成功後にリダイレクト
    }
} else {
    // POSTデータが存在しない場合のエラー処理や処理
}

exit();
?>

