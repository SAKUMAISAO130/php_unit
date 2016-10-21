<html>
<head><title>PHP TEST</title></head>
<body>


<?php

function h($str){
    echo htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

if ($_GET) {
  $get_data = $_GET; 
  if($get_data['text1']){
    $input_data = $get_data['text1'];
    print('入力成功<br>');
    h($input_data);
  }else{
    print('GETリクエストエラー');
  }
}else{
echo <<< DOM_obj_01
<a href="./get.php?text1=300">GETリクエストする</a>
DOM_obj_01;
}
?>

</body>
</html>

