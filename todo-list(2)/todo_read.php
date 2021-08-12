<?php



// DB接続情報
$dbn = 'mysql:dbname=gsacf_l05_01;charset=utf8;port=3306;host=localhost';
$user = 'root';//初期設定
$pwd = '';;// (空文字)初期設定

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();// 「db　Error:...」が表示されたらdb接続でエラーが発生していることがわかる.
}

// exit('ok');

// 参照はSELECT文!
$sql = 'SELECT * FROM todo_table';

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();//実行を忘れずに!
// $statusにSQLの実行結果が入る(取得したデータではない点に注意)true false


// データを表示しやすいようにまとめる
if ($status == false) {
  $error = $stmt->errorInfo();
  // データ登録失敗次にエラーを表示 
  exit('sqlError:' . $error[2]);
} else {
  // 登録ページへ移動
  // var_dump($status); trueが帰ってくる
  // exit('ok2');
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetchAll()で全部取れる! あとは配列􏰁処理!!
 
  $output = "";// (空文字)push用
  // var_dump($result);
  // exit('ok2');
  foreach ($result as $record) {
    $output .= "<tr><td>{$record['deadline']}</td><td>{$record['todo']}</td><tr>";
  }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>DB連携型todoリスト（一覧画面）</legend>
    <a href="todo_input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th>deadline</th>
          <th>todo</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>