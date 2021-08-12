<?php
// sessionに保存されている変数を取り出し，計算して表示しよう
session_start();

echo $_SESSION['hoge'];// session変数の確認