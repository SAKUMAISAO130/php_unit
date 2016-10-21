<?php
//pdo
date_default_timezone_set('Asia/Tokyo');

function connect(){
  $dsn = 'mysql:dbname=essential_data; host=localhost; charset=utf8';
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
  $sql = 'select * from core_data order by id';

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
