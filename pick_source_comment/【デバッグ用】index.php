<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>



<?php

/**************************************
 **************************************
 * コメントを出力したいファイルパスを指定
 **************************************
**************************************/
$file_path = './demo.php';


/*
* ファイルをを一行ずつ配列化
*/
$content = file($file_path);

echo '<table class="table table-bordered">';

/*
* ファイル配列を一行ずつ処理
*/
foreach ($content as $k => $v) {

  echo '<tr>';

    /*
    * PHPタグがあるかどうか判定、あればその行は処理しない
    */
    if(strpos($v,'<?php') === false){

      echo '<td>' . sprintf('%02d',$k+1) . '行目' . '</td>';


      /*
        * コメントタグ判定フラグがなければ定義する
        */
        if (!isset($flag_comment_part)) {
          $flag_comment_part = false; 
        }

                /*
        * フラグ操作
        * 終了タグ（/*）の場合false
        */
        if(strpos($v,'*/') !== false){
          $flag_comment_part = false; 
        }

        /*
        * 出力
        */
        if($flag_comment_part){

          /*
          * 出力  
          */
          print_r('<td>' . $flag_comment_part . '</td>');
          print_r('<td>' . '■出力したい■' . '</td>');
          echo '<td>' . $v . '</td>';

        }else{

          print_r('<td>' . $flag_comment_part . '</td>');
          print_r('<td>' . '■出力しない■' . '</td>');

        } 






        /*
        * フラグ操作
        * 開始タグ（/*）の場合true
        */
        if(strpos($v,'/*') !== false){
          $flag_comment_part = true; 
        }
        


      echo '</tr>';
  
    };

}

echo '</table>';

?>




</body>
</html>

