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
  $sql = 'insert into core_data(pro_name,site_name,pro_url,pro_img,reg_date) values(:pro_name,:site_name,:pro_url,:pro_img,:reg_date)';

  $stt = $db->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
  $stt->execute(array(
    ':pro_name' => 'test_name',
    ':site_name' => 'http://test.com',
    ':pro_url' => 'http://test.com/test',
    ':pro_img' => 'http://test.com/test.jpg',
    ':reg_date' => date("Y-m-d H:i:s",time())
    ));
  echo "登録完了";
  $db=NULL;

}catch(PDOException $e){
  exit('データベース接続エラー：{$e->getMessage()}');
}


?>
