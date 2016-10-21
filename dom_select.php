<?php
$html = file_get_contents("http://www.nicovideo.jp/video_top");


$dom = new DOMDocument();
@$dom->loadHTML($html);
$xml = simplexml_import_dom($dom);




$ret = $xml->xpath('//ol[@class="list"]//li[@class="item"]//div[@class="itemContent"]//a');


echo "<pre>";
var_dump($ret);
echo "</pre>";


?>