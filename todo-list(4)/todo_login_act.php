<?php
// var_dump($_POST);
// exit();

session_start();


include('functions.php');
$user_name = $_POST['username'];
$password = $_POST['password'];
// var_dump($user_name);
// var_dump($password);
// exit();
$_SESSION['email'] = $user_name;

$pdo = connect_to_db();
// exit('ok');

$sql = 'SELECT * FROM user_table WHERE user_name = :user_name AND password = :password AND is_deleted = 0';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();
$val = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($val);
// exit();

if (!$val) { // 該当データがないときはログインページへのリンクを表示
  echo "<p>ログイン情報に誤りがあります.</p>";
  echo '<a href="todo_login.php">login</a>';
  exit();
  } else {
    $_SESSION = array();
    $_SESSION["session_id"] = session_id();
    $_SESSION["is_admin"] = $val["is_admin"];
    $_SESSION["username"] = $val["user_name"];
    header("Location:todo_read.php"); // 一覧ページへ移動
    exit();
  }