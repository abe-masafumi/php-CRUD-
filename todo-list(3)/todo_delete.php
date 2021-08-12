<?php
// var_dump($_GET);
// exit();

$id = $_GET['id'];
// 関数ファイル読み込み
include('functions.php');
// 関数呼び出し
$pdo = connect_to_db();

// idを指定して更新するSQLを作成(UPDATE文)論理削除
$sql = "UPDATE todo_table SET deleted=1 WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
// $stmt->bindValue(':deleted', 1, PDO::PARAM_INT);
$status = $stmt->execute();

 // 各値をpostで受け取る
 if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する 
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
  } else {
  // 正常に実行された場合は一覧ページファイルに移動し，処理を実行する 
  header("Location:todo_read.php");
  exit();
  }