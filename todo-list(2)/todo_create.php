<?php
 // データ受け取りのときにまずやること
// var_dump($_POST);
// exit();

  if ( // 入力チェック(未入力の場合は弾く，commentのみ任意)
    !isset($_POST['todo']) || $_POST['todo']=='' ||
  !isset($_POST['deadline']) || $_POST['deadline']=='' ){
    exit('Param Error');
  } // 解説
// 「ParamError」が表示されたら，必須データが送られていないことがわかる

 // 送られてきたデータを変数に格納
$todo = $_POST['todo'];
$deadline = $_POST['deadline'];

// exit('ok');

// 「dbname」「port」「host」「username」「password」を設定
// DB接続情報　　　　↓ここだけ自分のデータベース名に変更！
$dbn = 'mysql:dbname=gsacf_l05_01;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';



// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}// 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる

// exit('ok2');

// SQL作成&実行
$sql = 'INSERT INTO todo_table(id, todo, deadline, created_at, updated_at) VALUES(NULL, :todo, :deadline, sysdate(), sysdate())';


$stmt = $pdo->prepare($sql);
// 変数をバインド変数(:todo)に格納!!
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR); 
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$status = $stmt->execute(); // SQLを実行


if ($status==false) {
  $error = $stmt->errorInfo(); 
  // データ登録失敗次にエラーを表示 
  exit('sqlError:'.$error[2]);
  } else {
  // 登録ページへ移動
    header('Location:todo_input.php');
  }