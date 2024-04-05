<?php
session_start();

$id = $_GET["id"]; //?id~**を受け取る
include("funcs.php");
//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM P_onlin_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if($status==false) {
    sql_error($stmt);
}else{
    $row = $stmt->fetch();
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/style.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>

 <?php include("inc/head.html"); ?>


</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<form method="POST" action="update_onlin.php">
  <div class="botron">
   <fieldset>
    <legend>[編集]</legend>
    <label>名前：<?= htmlspecialchars($_SESSION["user_name"], ENT_QUOTES); ?></label><br>
    <input type="hidden" name="user_name" value="<?= htmlspecialchars($_SESSION["user_name"], ENT_QUOTES); ?>">
    <label>ニックネーム：<input type="text" name="nic_name" value="<?=$row["nic_name"]?>"></label><br>

    <div class="form-group">
    <label for="ivent">希望日：</label>
        <select name="ivent" id="ivent" class="form-control">
            <option value="4月9日">4月9日火曜日：20時から</option>
            <option value="4月10日">4月10日水曜日：20時から</option>
        </select>
    </div>
    <div class="form-group">
           
     <input type="submit" class="button" value="更新">
     <input type="hidden" name="id" value="<?=$id?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
