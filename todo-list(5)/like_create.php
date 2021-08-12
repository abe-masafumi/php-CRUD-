<?php
include("functions.php");
// var_dump($_GET);
// exit('ok');

$user_id = $_GET['user_id'];
$todo_id = $_GET['todo_id'];

$pdo = connect_to_db();
// exit('ok');

// いいね状態のチェック(COUNTで件数を取得できる!) 
$sql = 'SELECT COUNT(*) FROM like_table WHERE user_id=:user_id AND todo_id=:todo_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':todo_id', $todo_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  // エラー処理
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $like_count = $stmt->fetch();
  // var_dump($like_count[0]);
  // exit();
}
// exit('ok');

// いいねしていれば削除，していなければ追加のSQLを作成 
if ($like_count[0] != 0) {
  $sql = 'DELETE FROM like_table
            WHERE user_id=:user_id AND todo_id=:todo_id';
} else {
  $sql = 'INSERT INTO like_table(id, user_id, todo_id, created_at)
  VALUES(NULL, :user_id, :todo_id, sysdate())';

}
// INSERTのSQLは前項で使用したものと同じ!
// 以降(SQL実行部分と一覧画面への移動)は変更なし!
// SQL文は1行にまとめる


$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':todo_id', $todo_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:todo_read.php");
  exit();
}
