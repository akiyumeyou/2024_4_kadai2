<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！

sschk();


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
<title>管理画面</title>
</head>
<body id="main">

<header class="header">
 <?php include("inc/head.html"); ?>
</header>

<a class="navbar-brand" href="kanri_onlin.php">交流会申込者一覧</a>
<a class="navbar-brand" href="kanri_form.php">問い合わせ一覧</a>

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
