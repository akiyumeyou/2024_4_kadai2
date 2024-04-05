<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
    // 現在のファイル名を$file_nameにセット$file_name = basename(__FILE__);
sschk();

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>オンライン申し込み</title>
        <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
   
 <header class="header">
    <?php include("inc/head.html");?>

</header>
      <!-- Main[Start] -->
<form method="POST" action="write.php">
    <div class="button">
        <fieldset>
            <legend>オンライン交流会申し込み</legend>
            <label>名前：<?= htmlspecialchars($_SESSION["user_name"], ENT_QUOTES); ?></label><br>
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION["user_id"], ENT_QUOTES); ?>">
            <input type="hidden" name="user_name" value="<?= htmlspecialchars($_SESSION["user_name"], ENT_QUOTES); ?>">
            <label>ニックネーム：<input type="text" name="nic_name" class="form-input"></label><br>
                <div class="form-group">
        <label for="ivent">希望日：</label>
        <select name="ivent" id="ivent" class="form-control">
            <option value="4月9日">4月9日火曜日：20時から</option>
            <option value="4月10日">4月10日水曜日：20時から</option>
        </select>
    </div>
    <div class="form-group">
            
                <input type="submit" value="申込">
            </fieldset>
            </div>
            <?php $date = date('Y年m月d日 H:i:s'); ?>
<?php echo $date; ?>
        </form>
        <!-- Main[End] -->
 <footer class="footer">
<?php include("inc/foot.html"); ?>
</footer>
    </body>
</html>