<?php
session_start();

$id = $_GET["id"]; //?id~**を受け取る
include("funcs.php");
//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table WHERE id=:id");
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

<header class="header">
    <?php include("inc/menu.php");?>
    <?php 
    // ログインしている場合、ユーザー名を表示
    if(isset($_SESSION["user_name"])) {
        echo $_SESSION["user_name"] . "さん";
    }
    ?>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<form method="POST" action="update.php">
  <div class="botron">
   <fieldset>
    <legend>[編集]</legend>
     <label>名前：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>Email：<input type="text" name="email" value="<?=$row["email"]?>"></label><br>
     <label>年齢：<input type="text" name="age" value="<?=$row["age"]?>"></label><br>
     <label for="date_option">希望日：</label>
        <select name="date_option" id="date_option" class="form-control">
        <option value="会員登録について">会員登録について</option>
            <option value="オンラインイベントについて">オンラインイベントについて</option>
            <option value="互助マッチングについて">互助マッチングについて</option>
            <option value="その他（感想ご意見）">その他（感想・ご意見）</option>
        </select>
     <label><textArea name="naiyou" rows="4" cols="40"><?=$row["naiyou"]?></textArea></label><br>
     <input type="submit" value="更新">
     <input type="hidden" name="id" value="<?=$id?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
