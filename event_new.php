<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>イベント投稿フォーム</title>
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
   
 <header class="header">
    <?php include("inc/head.html");?>

</header>
      <!-- Main[Start] -->
<form method="POST" action="event_write.php" enctype="multipart/form-data"><!-- enctype="" -->
    <div class="button">
        <fieldset>
            <legend>交流会作成ページ</legend>
            <label>投稿者の名前：<?= htmlspecialchars($_SESSION["user_name"], ENT_QUOTES); ?></label><br>
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION["user_id"], ENT_QUOTES); ?>">
            <input type="hidden" name="user_name" value="<?= htmlspecialchars($_SESSION["user_name"], ENT_QUOTES); ?>">
        <div class="form-group">
  <label for="title">イベントタイトル:</label><br>
  <input type="text" id="title" name="title" value="オンラインおしゃべり会"><br><br>

  <label for="date">日時:</label><br>
  <input type="number" id="year" name="year" placeholder="年" min="2024" max="2100">年
  <input type="number" id="month" name="month" placeholder="月" min="1" max="12">月
  <input type="number" id="day" name="day" placeholder="日" min="1" max="31">日
  <input type="time" id="time" name="time">時<br><br>

  <label for="jikan">所用時間:</label><br>
  <input type="number" id="jikan" name="jikan" placeholder="分">分<br><br>

  <label for="naiyou">内容説明:</label><br>
  <textarea id="naiyou" name="naiyou" rows="4" cols="50"></textarea><br><br>

  <label for="image">イベント画像:</label><br>
  <div id="drop-area">
      <p>画像をドラッグ＆ドロップまたは<span class="file-input-label">クリック</span>して選択</p>
      <input type="file" id="image" name="image" hidden><br><br>
      <div id="file-name"></div>

  </div>
    </div>
    <!-- その他のフォーム要素 -->
    <input type="submit" value="イベントを投稿">
</form>



</fieldset>
</div>
<<script>
document.addEventListener("DOMContentLoaded", function() {
    let dropArea = document.getElementById('drop-area');
    let input = document.getElementById('image');

    // クリックでファイル選択
    dropArea.addEventListener('click', function() {
        input.click();
    });

    // ファイルが選択された時にファイル名を表示
    input.addEventListener('change', function(e) {
        let fileNameContainer = document.getElementById('file-name');
        if (input.files.length > 0) {
            let fileName = input.files[0].name;
            fileNameContainer.textContent = "選択されたファイル: " + fileName;
        } else {
            fileNameContainer.textContent = "";
        }
    });

    // ドラッグオーバー時のスタイル変更
    dropArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropArea.classList.add('active');
    });

    // ドラッグがエリア外に出た時のスタイル戻し
    dropArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropArea.classList.remove('active');
    });

    // ドロップされたファイルをinputにセットし、ファイル名を表示
    dropArea.addEventListener('drop', function(e) {
        e.preventDefault();
        dropArea.classList.remove('active');
        input.files = e.dataTransfer.files;

        // ファイル名を表示
        let fileNameContainer = document.getElementById('file-name');
        if (input.files.length > 0) {
            let fileName = input.files[0].name;
            fileNameContainer.textContent = "選択されたファイル: " + fileName;
        } else {
            fileNameContainer.textContent = "";
        }
    });
});
</script>


<?php $date = date('Y年m月d日 H:i:s'); ?>
<?php echo $date; ?>
        </form>
        <!-- Main[End] -->
 <footer class="footer">
<?php include("inc/foot.html"); ?>
</footer>
</body>
</html>