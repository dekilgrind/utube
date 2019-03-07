<?php

if(file_exists('error_log')){
unlink('error_log');
}
function ngegrab($url){
$ch = curl_init(); curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch,CURLOPT_ENCODING,'gzip');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
$header[] = "Accept-Language: en";
$header[] = "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; de; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3";
$header[] = "Pragma: no-cache";
$header[] = "Cache-Control: no-cache";
$header[] = "Accept-Encoding: gzip,deflate";
$header[] = "Content-Encoding: gzip";
$header[] = "Content-Encoding: deflate";
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$load = curl_exec($ch);
curl_close($ch);
return $load;}
function potong($content,$start,$end){
if($content && $start && $end) {
$r = explode($start, $content);
if (isset($r[1])){
$r = explode($end, $r[1]);
return $r[0];}
return '';}}
function dateyt($date){$date=substr($date,0,10); $date=explode('-',$date);
$mn=date('F',mktime(0,0,0,$date[1])); $dates=''.$date[2].' '.$mn.' '.$date[0].''; return $dates;}

/// API YOUTUBE ARRAY
$NewKeyArray = array(
'AIzaSyBYJxhwLtFJQOVHjOTHVV4Sj93TP56tgYg', 
'AIzaSyAIrjetbqKwqjw4XMyb2L_YP0O1Rmdo4Go',
'AIzaSyAa5ybNTNNp6irT4uNw_QUtGB2X4PIUusw');

$SetArray = count($NewKeyArray)-1;
$Key = $NewKeyArray[rand(0, $SetArray)];

function single($id, $key){
$grab= json_decode(ngegrab('https://www.googleapis.com/youtube/v3/videos?alt=json&part=id,snippet,contentDetails&id='.$id.'&type=videos&key='.$key.''), true);
return $grab;
}


?>