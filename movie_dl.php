<?php

  $header = get_headers($url, 1);

  header('Content-Type:  audio/mp4');
  header('Content-Length: '.$header['Content-Length']);
  header('Content-disposition: attachment; filename="' . $html_parse[1] . '"');

  $fp = fopen($url, 'rb');
  while(!feof($fp)) {
      $buf = fread($fp, 1048576);
      echo $buf;
      ob_flush();
      flush();
  }
  fclose($fp);


?>