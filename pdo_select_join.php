<?php
//pdo
date_default_timezone_set('Asia/Tokyo');

function connect(){
  $dsn = 'mysql:dbname=board_data; host=localhost; charset=utf8';
  $usr = 'root';
  $passwd = '';

  try {
    $db =new PDO($dsn,$usr,$passwd);
  }catch(PDOException $e){
    exit('データベース接続エラー：{$e->getMessage()}');
  }
  return $db;
}

try {

  $db = connect();
  $sql = 'SELECT * FROM board_usr,board_group WHERE board_usr.gid=board_group.gid AND dpid=3';

  $stt = $db->prepare($sql);
  $stt->execute();


  echo "<pre>";
  while ($row = $stt->fetch(PDO::FETCH_ASSOC)) {
    var_dump($row);
  }
  echo "</pre>";



  echo "取得完了";
  $db=NULL;

}catch(PDOException $e){
  exit('データベース接続エラー：{$e->getMessage()}');
}


?>
