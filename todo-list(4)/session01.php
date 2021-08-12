<?php
// session変数を定義して値を入れよう
session_start();// session変数を使用する場合も必須!

$_SESSION['hoge'] = "G's ACADEMY";// session変数の宣言

echo $_SESSION['hoge'] . "FUMKUOKA";// session変数の宣言
