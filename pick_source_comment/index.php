<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="コメヌキ。ソースコードからコメントを取得して抜き出すWEBツール。ソースコードのコメントを抽出してそれを設計書にコピペしてしまえばいいじゃないか！">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>コメヌキ｜ソースコードからコメントを抽出して抜き出すWEBツール</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>

  <nav class="navbar navbar-dark bg-primary">
    <a class="navbar-brand" href="#">
        <span class="logo-mark">コメヌキ</span>　<small>コメントをソースコードから抜き出そう</small>
    </a>
  </nav>

<div style="border-top: 5px #007bff dashed;"></div>

<div class="container">

    <h1 class="midashi">
    <span class="css-file"></span>ソースコードからコメントを抽出して抜き出すWEBツール
    </h1>

    <p style="font-weight: bold;">
        設計書を書く時間がない！javadocで自動生成してもエクセルにコピペできない！<br>
        それならば、ソースコードのコメントを取得してそれを設計書にコピペしてしまえばいいじゃないか！<br>
        ぜひうまく使ってください。<br>
        下記コメント形式をソースコードから抜き出します。（試しに貼り付けて見てください）
    </p>
    <p style="background-color: #abcdff; border-radius: 5px; padding: 20px;">
        if(xxxxxxxxxxxxxx){<br>
            /*<br>
            * コメント１<br>
            */<br>
            $get_url = "http://xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"<br>
            /*<br>
            コメント２<br>
            */<br>
            $html = print(xxxxxxxxxxxxx);<br>
            //抽出しないコメント<br>
        }<br>
    </p>

    <form action="./" method="post" enctype="application/x-www-form-urlencoded">
        <div class="form-group">
            <label for="exampleFormControlTextarea1"  class="midashi"><span class="css-file"></span>ソースを入力してください　（※サーバーには保存されません）</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name='code'><?= trim($_POST["code"]) ?></textarea>
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-primary" name='action' value='nomal'>抜き出す</button>
        <button type="submit" class="btn btn-secondary" name='action' value='custom'>抜き出す（ソースの行数も表示）</button>
        </div>
    </form>

</div>

<div class="container">

    <p class="midashi">
    <span class="css-file"></span>コメント抽出結果
    </p>

<img src="./setting.png" alt="" class="backimg">

<?php

if($_SERVER["REQUEST_METHOD"] === "GET"){

?>
    <p>
    ここにコメント抽出結果が表示されます
    </p>

<?php

}elseif($_SERVER["REQUEST_METHOD"] === "POST"){

    /*
    * POST値の取得
    */
    $input_str = htmlspecialchars(trim($_POST["code"]));

    /*
    * 改行の変換
    */
    $input_str = str_replace(array("\r\n","\r","\n"), "\n", $input_str);

    /*
    * 改行でスプリット
    */
    $array = explode("\n", $input_str);

    /*
    * コメントを出力したいファイルパスを指定
    */
    $file_path = './demo.php';

    /*
    * ファイルをを一行ずつ配列化
    */
    $content = $array;

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
              * 通常出力と行数出力  
              */
              if ($_POST["action"] === 'custom') {
                $row_num = $k + 1;
                echo '<td>' . $v . '　　(ソースコード' . $row_num . '行目)' . '</td>';
              }else{
                echo '<td>' . $v . '</td>';
              }

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

}

?>



  <p style="margin: 50px 0;font-weight:bold;">&copy; ずぼらツールズ <?php echo date('Y'); ?></p>

</div>

        <style>
        html{
          font-family: 'Hiragino Kaku Gothic Pro', 'ヒラギノ角ゴ Pro W3', Meiryo, メイリオ, Osaka, 'MS PGothic', arial, helvetica, sans-serif;
        }
        .backimg{
          opacity: 0.1;
          position: absolute;
          top:-50px;
          left:-100px;
          z-index: -100;
        }
        .midashi {
        margin: 50px 0px 20px;
        font-size: 1.5em;
        font-weight:bold;
        color: #007bff;/*文字色*/
        border: solid 5px #007bff;/*線色*/
        padding: 0.5em;/*文字周りの余白*/
        border-radius: 0.5em;/*角丸*/
        }
        .css-file{
          display: inline-block;
          position: relative;
          top: 50%;
          width: 16px;
          height: 20px;
          margin: 0 10px 0 0;
          padding: 0;
          background: #007bff;
        }
        .css-file:before, .css-file:after{
          display: block;
          content: "";
          position: absolute;
          top: 0;
          right: 0;
        }
        .css-file:before{
          width: 7px;
          height: 7px;
          background: #eee;
        }
        .css-file:after{
          width: 0;
          height: 0;
          border: 3px solid #eee;
          border-bottom-color: #007bff;
          border-left-color: #007bff;
        }
        .logo-mark{
          padding: 2px 5px;
          font-weight:bold;
          border: solid 5px #fff;
          border-radius: 5px;
        }
        </style>


</body>
</html>

