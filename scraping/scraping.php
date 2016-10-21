<?php
require_once('./simple_html_dom.php');

/////////////////////////////////////////////////////////////////////全ページURL取得

$url = "http://news.yahoo.co.jp/";

// HTMLファイルの取得
$html = file_get_html($url);


echo "<pre>";

foreach($html->find('a') as $element){
    echo $element . '<br>';
}

echo "</pre>";



?>