<?php
//0. SESSION開始！！
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);
//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();


//２．データ登録SQL作成
$pdo = db_conn();
$sql = "SELECT * FROM P_event_table";
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
<title>交流会一覧</title>
<link href="css/style.css" rel="stylesheet">

</head>
<header class="header">
 <?php include("inc/head.html"); ?>
</header>

<body>



<div class="events-container">
    <?php
    // データベースからイベント情報を取得する想定のコード
    $events = $pdo->query("SELECT title, year, month, day, time, jikan, naiyou, img_path FROM P_event_table ORDER BY year DESC, month DESC, day DESC, time DESC")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($events as $event) {
        // 開催日時のフォーマット
        $date = htmlspecialchars($event['year']) . '年' . htmlspecialchars($event['month']) . '月' . htmlspecialchars($event['day']) . '日 ' . htmlspecialchars($event['time']);

        // イベントカードのHTML
        echo '<div class="event-card">';
        echo '<img src="' . htmlspecialchars($event['img_path']) . '" alt="イベント画像" class="event-image">';
        echo '<div class="event-info">';
        echo '<h3>' . htmlspecialchars($event['title']) . '</h3>';
        echo '<p>開催日時: ' . $date . '</p>';
        echo '<p>所要時間: ' . htmlspecialchars($event['jikan']) . '分</p>';
        echo '<p>' . htmlspecialchars($event['naiyou']) . '</p>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>

        <!-- <?php
        $dir = 'upload/'; // 画像が保存されているディレクトリ
        $files = glob($dir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE); // 対応する画像形式を指定

        foreach ($files as $file) {
            echo '<img src="' . htmlspecialchars($file) . '" alt="画像" style="width: 200px; height: auto; margin: 10px;" />';
        }
        ?> -->
 
    </div>




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
