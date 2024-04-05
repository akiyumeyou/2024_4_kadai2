<?php
// 開発中エラー確認
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("funcs.php");
$pdo = db_conn(); // DB接続関数の呼び出し

if(isset($_POST["year"])) { // フォームが送信されたかをチェック
    $user_name = $_POST['user_name']; // イベントのタイトル
   
    $title = $_POST['title']; // イベントのタイトル

echo '<pre>';
var_dump($_POST);
echo '</pre>';

    $year = $_POST['year']; // 開催年
    $month = $_POST['month']; // 開催月
    $day = $_POST['day']; // 開催日
    $time = $_POST['time']; // 開始時刻
    $jikan = $_POST['jikan']; // 所要時間
    $naiyou = $_POST['naiyou']; // イベント内容

    $onlin_url = urlencode('https://zoom.us/j/XXXXXXXXXX'); // 実際のZoom URLを使用

    $img_path = urlencode('upload/event.png'); // デフォルト値

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = 'upload/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
    
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $img_path = $uploadFile; // 成功時にパスを更新
        } else {
            echo "ファイルのアップロードに失敗しました。";
        }
    }
    var_dump($_FILES);
    // データベース保存処理...
    
    
    // データ登録SQL作成
    $stmt = $pdo->prepare("INSERT INTO P_event_table(user_name,title, year, month, day, time, jikan, naiyou, img_path, onlin_url, created_at, updated_at) VALUES (:user_name, :title, :year, :month, :day, :time, :jikan, :naiyou, :img_path, :onlin_url, sysdate(), sysdate())");
    $stmt->bindValue(':user_name', $title, PDO::PARAM_STR);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':year', $year, PDO::PARAM_INT);
    $stmt->bindValue(':month', $month, PDO::PARAM_INT);
    $stmt->bindValue(':day', $day, PDO::PARAM_INT);
    $stmt->bindValue(':time', $time, PDO::PARAM_STR);
    $stmt->bindValue(':jikan', $jikan, PDO::PARAM_INT);
    $stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);
    $stmt->bindValue(':img_path', $img_path, PDO::PARAM_STR);
    $stmt->bindValue(':onlin_url', $onlin_url, PDO::PARAM_STR);

    $status = $stmt->execute(); // SQL文を実行

  // データ登録処理後
  if($status == false) {
    sql_error($stmt); // SQLエラーの場合の処理
} else {
    redirect("index.php"); // 処理成功後にリダイレクト
}
} else {
    echo ("エラー");
// POSTデータが存在しない場合のエラー処理や処理
}

exit();
?>