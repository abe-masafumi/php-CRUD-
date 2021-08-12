<?php

function omi() {

  $number = rand(1,5);

  if ($number == 1) {
    $result = "ゴムゴムの実をゲット";
  } elseif ($number == 2) {
    $result = "スケスケの実をゲット";
  } elseif ($number == 3) {
    $result = "ワンピースをゲット";
  } elseif ($number == 4) {
    $result = "覇王色の覇気をゲット";
  } elseif ($number == 5) {
    $result = "ウソップに敗れた";
  }
 echo $result;  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<style>
h1 {
  color: red;
}
</style>
<button id="btn">押して</button>
  <h1 id="h1"></h1>
  <script>
  const btn = document.getElementById('btn');
  const h1 = document.getElementById('h1');

  btn.addEventListener('click',() => {
    // h1.textContent = '';
    h1.textContent = "あなたは<?php    omi();     ?>";
  });


  </script>
</body>
</html>