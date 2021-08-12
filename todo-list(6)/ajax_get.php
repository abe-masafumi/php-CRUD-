<?php
include("functions.php");
var_dump($_GET);
exit();
// session_start();

$search_world = $_GET['searchword'];


$pdo = connect_to_db();
// 関数ファイル読み込み処理を記述(認証関連は省略でOK)
// DB接続の処理を記述
$sql = "SELECT * FROM todo_table WHERE todo LIKE :search_word}"; 
$stmt->bindValue(':search_word', "%{$search_word}%", PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
// エラー処理を記述
$error = $stmt->errorinfo();
echo json_encode(["error_msg" => "{$error[2]}"]);
exit();
} else {
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result); // JSON形式にして出力 
exit();
}