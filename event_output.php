<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include "funcs.php"; // funcs.phpをインクルード
// ユーザーがログインしているかチェック
if (!isset($_SESSION["user_id"])) {
  // ユーザーがログインしていなければ、ログインページにリダイレクト
  header("Location: login.php"); // login.phpはログインページのURLに置き換えてください。
  exit;
}

sschk();
$pdo = db_conn(); // db_conn関数からPDOオブジェクトを取得

$user_id = $_SESSION["user_id"]; // セッションからユーザーIDを取得

// ユーザーのイベント申し込み情報を取得
$sql = "SELECT * FROM P_onlin_table WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false) {
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
} else {
    $user_events = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ユーザー情報を取得
$sql_user = "SELECT * FROM potz_user_table WHERE user_id = :user_id";
$stmt_user = $pdo->prepare($sql_user);
$stmt_user->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$status_user = $stmt_user->execute();

$zoom_url = 'https://zoom.us/j/XXXXXXXXXX'; // 実際のZoom URLを使用

if($status_user==false) {
    $error = $stmt_user->errorInfo();
    exit("SQLError:".$error[2]);
} else {
    $user_info = $stmt_user->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link href="css/style.css" rel="stylesheet">
<title>交流会申込一覧</title>
</head>
<body id="main">
<!-- Head[Start] -->
<header class="header">

 <?php include("inc/head.html"); ?>

</header>

<h2>ユーザー登録情報</h2>
<p>ID: <?= htmlspecialchars($user_info["user_id"], ENT_QUOTES) ?></p>
<p>名前: <?= htmlspecialchars($user_info["user_name"], ENT_QUOTES) ?></p>
<p>登録区分: <?= htmlspecialchars($_SESSION["kanri_flg"], ENT_QUOTES) ?></p>
  

<!-- ユーザーが申し込んだイベントと、それに参加する予定の他の人々のニックネームの一覧 -->
<?php foreach($user_events as $event){ ?>
  
    <h2>予定一覧</h2>
  <div class="message-box">
      <h3>イベント: <?= htmlspecialchars($event["ivent"], ENT_QUOTES) ?></h3>
      <p>当日下の参加ボタンを押してください⬇️</p>
      <a href="<?= htmlspecialchars($zoom_url, ENT_QUOTES, 'UTF-8'); ?>" class="join_button">👉参加</a>

      <p>他の参加予定の方々:</p>
      <div class="participants">
          <?php
          // そのイベントに参加する他のユーザーのニックネームを取得
          $sql_participants = "SELECT nic_name FROM P_onlin_table WHERE ivent = :ivent AND user_id != :user_id";
          $stmt_participants = $pdo->prepare($sql_participants);
          $stmt_participants->bindValue(':ivent', $event["ivent"], PDO::PARAM_STR);
          $stmt_participants->bindValue(':user_id', $user_id, PDO::PARAM_INT);
          $stmt_participants->execute();
          $participants = $stmt_participants->fetchAll(PDO::FETCH_ASSOC);
          
          foreach($participants as $participant){
              echo "<div class='participant'>" . htmlspecialchars($participant["nic_name"], ENT_QUOTES) . "</div>";
          }
          ?>
        </div>
    </div>
<?php } ?>
</body>
</html>

