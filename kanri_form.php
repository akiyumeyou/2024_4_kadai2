<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();


//２．データ登録SQL作成
$pdo = db_conn();
$sql = "SELECT * FROM gs_an_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>管理画面</title>
<link href="css/style.css" rel="stylesheet">

</head>
<body>
<!-- Head[Start] -->

<header class="header">
 <?php include("inc/head.html"); ?>

</header>
<!-- Head[End] -->


<!-- Main[Start] -->

    <div class="container jumbotron">

      <table>
      <?php foreach($values as $v){ ?>
        <tr>
          <td><?=$v["id"]?></td>
          <td><a href="detail.php?id=<?=$v["id"]?>"><?=$v["name"]?></a></td>
          <td><a href="detail.php?id=<?=$v["id"]?>"><?=$v["date_option"]?></a></td>         
          <td><a href="delete.php?id=<?=$v["id"]?>">[削除]</a></td>
        </tr>
      <?php } ?>
      </table>

<!-- Main[End] -->
<script>
  const a = '<?php echo $json; ?>';
  console.log(JSON.parse(a));
</script>
<footer class="footer">
<?php include("inc/foot.html"); ?>
</footer>

</body>
</html>
