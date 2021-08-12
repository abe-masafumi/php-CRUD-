<?php
// 関数ファイル読み込み
include("functions.php");

$id = $_GET['id'];

// 関数呼び出し
$pdo = connect_to_db();

$sql = 'SELECT * FROM todo_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


if ($status==false) {
  $error = $stmt->errorInfo();//errorInfo()後で調べる
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $record = $stmt->fetch(PDO::FETCH_ASSOC);//PDO::FETCH_ASSOCここの種類調べる
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（編集画面）</title>
</head>

<body>
  <form action="todo_update.php" method="POST">
    <fieldset>
      <legend>DB連携型todoリスト（編集画面）</legend>
      <a href="todo_read.php">一覧画面</a>
      <div>
        todo: <input type="text" name="todo" value="<?= $record['todo'];?>">
      </div>
      <div>
        deadline: <input type="date" name="deadline" value="<?= $record['deadline']; ?>">
      </div>
      <input type="hidden" name="id" value="<?= $record['id']; ?>">
      <div>
        <button>submit</button>
      </div>

    </fieldset>
  </form>

</body>

</html>