<?php

$html = file_get_contents('test.html');
$tags = "<br>";
//$test = strip_tags($page,$html);
$breaks = array("<br />","<br>","<br/>");
$text = str_ireplace($breaks, "\r\n", $html);
$text = iconv('UTF-8', 'ASCII//TRANSLIT',$text);
$handle = fopen("newdoc.doc", "w+");
fwrite($handle, $text);
fclose($handle);






?>