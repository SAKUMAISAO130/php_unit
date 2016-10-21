<html>
<head><title>PHP TEST</title></head>
<body>


<?php

function h($str){
    echo htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
//var_dump($_POST['text1']);

if ($_POST) {
  $post_data = $_POST; 
  if($post_data['text1']){
    $input_data = $post_data['text1'];
    print('入力成功<br>');
    h($input_data);
  }else{
    print('入力エラー');
  }
}else{
print('入力してください');
echo <<< DOM_obj_01
<form method="POST" action="./post.php">
<input type="text" name="text1">
<input type="submit" name="btn1" value="確認">
</form>
DOM_obj_01;
}
?>

</body>
</html>

