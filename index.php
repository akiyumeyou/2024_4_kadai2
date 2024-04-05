<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>POTZ最初のページ</title>
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <header class="header">
    <?php include("inc/menu.php");?>
    <?php 
    // ログインしている場合、ユーザー名を表示
    if(isset($_SESSION["user_name"])) {
        echo $_SESSION["user_name"] . "さん";
    }
    ?>
    </header>
    <section>

  <div class="image-container">
    <img src="img/mainbg.png" alt="">
    <div class="text-overlay">
      <p class="text1">誰もひとりにしない<P>
      <P class="text1">私も誰かの力に</p>
      <p class="text2">高齢社会を楽しくする</p>
    </div>
  </div>
</section>
<h2>お知らせ</h2>
<p></p>
<h2>会員コンテンツ</h2>
   <main>
 <div class="blog_card">
     <h3>オンラインイベント作成</h3>
    <a href="event_new.php">
      <div class="pict">
        <img src="img/news1.jpg" class=blog_card_img alt="" />
      </div>
      <p>イベントを作って呼びかけよう</p>
    </a>
  </div>
  <div class="blog_card">
     <h3 >イベント一覧</h3>
    <a href="evevt_list.php">
      <div class="pict">
        <img src="img/news2.jpg" class=blog_card_img alt="" />
      </div>
      <p>オンラインイベント予定</p>
    </a>
  </div>
  <div class="blog_card">
     <h3>オンライン交流会申込フォーム</h3>
    <a href="mousikomi.php">
      <div class="pict">
        <img src="img/news3.jpg" class=blog_card_img alt="" />
      </div>
      <p>オンラインでつながるイベント</p>
    </a>
  </div>
  <div class="blog_card">
     <h3 >管理者の画面</h3>
    <a href="evevt_list.php">
      <div class="pict">
        <img src="img/news4.jpg" class=blog_card_img alt="" />
      </div>
      <p>問い合わせや交流会参加者一覧</p>
    </a>
  </div>
  </main> 


<h2>コンタクト</h2>
        <form method="POST" action="insert.php">
            <div class="button">
            <fieldset>
                <legend>お問い合わせフォーム</legend>
                <label>名前：<input type="text" name="name" class="form-input"></label><br>
                <label>Email：<input type="text" name="email" class="form-input"></label><br>
                <label>年齢：<input type="text" name="age" class="form-input"></label><br>
                <div class="form-group">
        <label for="date_option">お問い合わせ：</label>
        <select name="date_option" id="date_option" class="form-control">
            <option value="会員登録について">会員登録について</option>
            <option value="オンラインイベントについて">オンラインイベントについて</option>
            <option value="互助マッチングについて">互助マッチングについて</option>
            <option value="その他（感想ご意見）">その他（感想・ご意見）</option>
        </select>
    </div>
    <div class="form-group">
                <label>内容：<textarea name="naiyou" rows="4" cols="40" class="form-textarea"></textarea></label><br>
                <input type="submit" value="送信" class="form-submit">
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
