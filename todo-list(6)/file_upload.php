<?php
// ファイルが追加されていない or エラー発生の場合を分ける.
// 送信されたファイルは$_FILES['...'];で受け取る!
// コード
if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {
  // 送信が正常に行われたときの処理(この後記述)...

  // アップロードしたファイル名を取得.
  // 一時保管しているtmpフォルダの場所の取得.
  // アップロード先のパスの設定(サンプルではuploadフォルダ <- 作成!)
  // コード
  $uploaded_file_name = $_FILES['upfile']['name']; //ファイル名の取得 
  $temp_path = $_FILES['upfile']['tmp_name']; //tmpフォルダの場所 
  $directory_path = 'upload/'; //アップロード先ォルダ(↑自分で決める)

  // ファイルの拡張子の種類を取得.
  // ファイルごとにユニークな名前を作成.(最後に拡張子を追加) 
  // ファイルの保存場所をファイル名に追加.

  $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
  $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
  $filename_to_save = $directory_path . $unique_name;
  // 最終的に「upload/hogehoge.png」のような形になる
  if (is_uploaded_file($temp_path)) {
    // ↓ここでtmpファイルを移動する
    if (move_uploaded_file($temp_path, $filename_to_save)) {
      chmod($filename_to_save, 0644); // 権限の変更
      $img = '<img src="' . $filename_to_save . '" >'; // imgタグを設定 
    } else {
      exit('Error:アップロードできませんでした'); // 画像の保存に失敗 
    }
  } else {
    exit('Error:画像がありません'); // tmpフォルダにデータがない
  }
} else {
  // 送られていない，エラーが発生，などの場合
  exit('Error:画像が送信されていません');
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>file_upload</title>
</head>

<body>

</body>

</html>