<?php
ini_set('display_errors','off');
$watch_id = $_GET["watch_id"];
$html = 'https://k.y.qq.com/cgi-bin/BlackKey.fcg?data={%22comm%22:{%22ct%22:1,%22cv%22:0,%22authst%22:%22%22},%22video%22:{%22module%22:%22moo.mooDetailPage.MooMvDetailSvr%22,%22method%22:%22QueryMvDetail%22,%22param%22:{%22watch_id%22:'.$watch_id.',%22watch_type%22:0}}}';
shell_exec("aria2c '$html' -o $watch_id.001html  > /dev/null 2>&1"); 
$html = file_get_contents($watch_id.".001html");

$mvid =  preg_replace('/[\s\S]*\"mv\_vid\"\:\"(.+?)\"[\s\S]*/', '$1', $html); 
//echo $file_id;
$file_id =  preg_replace('/.+?\"file\_id\"\:\"(.+?)\"[\s\S]*/', '$1', $html); 
//echo $file_id;
$singer_ids =   preg_replace('/.+?\"singer\_ids\"\:\[(.+?)\][\s\S]*/', '$1', $html); 
//echo $singer_ids;
$mid =   preg_replace('/[\s\S]*\"mid\":\"(.+?)\"[\s\S]*/', '$1', $html); 
//echo $mid;
$title = preg_replace('/.+?\"title\"\:\"(.+?)\"[\s\S]*/', '$1', $html); 
//echo $title;
$name = preg_replace('/.+?\"name\"\:\"(.+?)\"[\s\S]*/', '$1', $html); 
//echo $name;



$html1 = 'https://u.y.qq.com/cgi-bin/musicu.fcg?data={"comm":{"ct":6,"cv":0,"g_tk":5381,"uin":0,"format":"json","platform":"yqq"},"mvInfo":{"module":"video.VideoDataServer","method":"get_video_info_batch","param":{"vidlist":["'.$mvid.'"],"required":["vid","type","sid","singers","name","pubdate","","fileid","filesize"]}}}';

shell_exec("aria2c '$html1' -o $watch_id.002html > /dev/null 2>&1");
$html1 = file_get_contents($watch_id.".002html");
$fileid = preg_replace('/.+?\"fileid\"\: \"(.+?)\"[\s\S]*/', '$1', $html1); 
if (strlen($fileid) > 75) {$fileid = "";}
//echo $fileid;

$qmmv = preg_replace('/.+?\"fileid\"\: \"(.+?)\"[\s\S]*/', '$1', $html1); 
//echo $qmmv;
$singers = preg_replace('/.+?\"name\"\: \"(.+?)\"\, \"pubdate\".+?\"singers\".+?\"name\"\: \"(.+?)\"[\s\S]*/', '$2', $html1); 
//echo $singers;
$song = preg_replace('/.+?\"name\"\: \"(.+?)\"\, \"pubdate\".+?\"singers\".+?\"name\"\: \"(.+?)\"[\s\S]*/', '$1', $html1); 
//echo $song;
$sid = preg_replace('/.+?\"sid\"\: (.+?)\,[\s\S]*/', '$1', $html1); 
$sid = str_pad($sid,8,"0",STR_PAD_LEFT);
//echo $sid;


$html1 = preg_replace('/[\s\S]*( \"singers\".* \"name\"\: \".+?\"\,)[\s\S]*/', '$1', $html1);  //获取艺人名字
//echo $html;

$date=date("Y-m-d H");
if (preg_match_all('/\"name\"\: \"(.+?)\"/', $html1, $links) ) {
    $size = count($links[0]);
    for ($i = 0;$i < $size;$i++) {
        $link = preg_replace('/\"name\"\: \"(.+?)\"/','$1', $links[0][$i]);
        $artist.= $link.', ';

    }
//echo $artist;
   
}


$filename = $artist.' - '.$song.' '.$year.'_'.$sid;
$filename = str_replace(array('0000000', '\\/', ',  - '), array('11111', '／', ' - '), $filename);
//echo $filename;


unlink ($watch_id.".001html");

unlink ($watch_id.".002html");




$qqpage2 = file_get_contents('https://vv.video.qq.com/getinfo?otype=ojson&vids='.$mvid);
$pubdate = preg_replace('/.*\"uptime\"\:(.+?)\,\"[\s\S]*/', '$1', $qqpage2);
date_default_timezone_set('PRC');
$pubdate = date("Y-m-d H:i",$pubdate);
$year =  preg_replace('/([0-9]{4})[\s\S]*/', '$1', $pubdate); 
//cho $year;


$filename = $artist.' - '.$song.' '.$year.'_'.$sid;
$filename = str_replace(array('|' ,'\\"' ,'?' ,':', '\\/', ',  - ', '广场舞 - '), array('-' ,'\'' ,'？', '：', '／', ' - ', '凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件凑字数造大文件'), $filename);
$filename =  preg_replace('/.+?(\,.+? \- [\s\S]*)/', ($name.'$1'), $filename);  //多艺人

$artist1 = preg_replace('/.+?\,.+? \- .*/', '3622227', $filename);  //如果是多艺人，则$artist1=3622227
$artist2 = '3622227';
if ($artist1 !== $artist2) {$filename =  preg_replace('/.+?( \- [\s\S]*)/', ($name.'$1'), $filename);}  //如果不是多艺人（即单艺人），运行这个命令
//cho $filename.'<br>';

$qqurl1 = 'http://50069.gzc.svp.tencent-cloud.com/'.$qmmv.'.f0.mp4';
//echo $qqurl1;
$qqurl2 = 'http://50069.gzc.svp.tencent-cloud.com/'.$qmmv.'.f0.mov';
$qqurl3 = 'http://50069.gzc.svp.tencent-cloud.com/'.$qmmv.'.f0.m4v';
$qqurl4 = 'http://50069.gzc.svp.tencent-cloud.com/'.$qmmv.'.f0.mpg';
$qqurl5 = 'http://50069.gzc.svp.tencent-cloud.com/'.$qmmv.'.f0.m2p';
$qqurl6 = 'http://50069.gzc.svp.tencent-cloud.com/'.$qmmv.'.f0.ts';
$qqurl7 = 'http://50069.gzc.svp.tencent-cloud.com/'.$qmmv.'.f0.mkv';
$qqurl8 = 'http://50069.gzc.svp.tencent-cloud.com/'.$qmmv.'.f0.mpeg';
$qqurl9 = 'http://50069.gzc.svp.tencent-cloud.com/'.$qmmv.'.f0.mp4';
$qqurl10 = 'http://50069.gzc.svp.tencent-cloud.com/'.$qmmv.'.f0.mov';

// echo $response1;

//echo $response2;


//echo $qmmv;
if(strlen($qmmv) < 65) {


if(preg_match('/200/', shell_exec("curl -I -m 10 -o /dev/null -s -w %{http_code} $qqurl1"))){ 
    $qqurl = $qqurl1;
  //  echo $qqurl;
} elseif (preg_match('/200/',shell_exec("curl -I -m 10 -o /dev/null -s -w %{http_code} $qqurl2"))) {
    $qqurl = $qqurl2;
  //  echo $qqurl;
} elseif (preg_match('/200/',shell_exec("curl -I -m 10 -o /dev/null -s -w %{http_code} $qqurl3"))) {
    $qqurl = $qqurl3;
 //   echo $qqurl;
} elseif (preg_match('/200/',shell_exec("curl -I -m 10 -o /dev/null -s -w %{http_code} $qqurl4"))) {
    $qqurl = $qqurl4;
  //  echo $qqurl;
} elseif (preg_match('/200/',shell_exec("curl -I -m 10 -o /dev/null -s -w %{http_code} $qqurl5"))) {
    $qqurl = $qqurl5;
  //  echo $qqurl;
} elseif (preg_match('/200/',shell_exec("curl -I -m 10 -o /dev/null -s -w %{http_code} $qqurl6"))) {
    $qqurl = $qqurl6;
   // echo $qqurl;
} elseif (preg_match('/200/',shell_exec("curl -I -m 10 -o /dev/null -s -w %{http_code} $qqurl7"))) {
    $qqurl = $qqurl7;
  //  echo $qqurl;
} elseif (preg_match('/200/',shell_exec("curl -I -m 10 -o /dev/null -s -w %{http_code} $qqurl8"))) {
    $qqurl = $qqurl8;
  //  echo $qqurl;
} elseif (preg_match('/200/',shell_exec("curl -I -m 10 -o /dev/null -s -w %{http_code} $qqurl9"))) {
    $qqurl = $qqurl9;
  //  echo $qqurl;
} elseif (preg_match('/200/',shell_exec("curl -I -m 10 -o /dev/null -s -w %{http_code} $qqurl10"))) {
    $qqurl = $qqurl10;
}else {
    $qqurl =  "无法获取地址";
}

//echo $qqurl.'<br>';

$format = preg_replace('/[\s\S]*(\..*)/', '$1', $qqurl);  //获取视频格式mov、mp4等等
//echo $format;   
    
    
//获取文件大小
function readableBytes($size0) {
    $i1 = floor(log($size0) / log(1024));
    $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

    return sprintf('%.02F', $size0 / pow(1024, $i1)) * 1 . ' ' . $sizes[$i1];
}

$filesize = shell_exec("curl -sI $qqurl | grep -i Content-Length | awk '{print \$2}'");
$filesize = readableBytes($filesize); 

}


//echo $filesize;


$id = 'TX'.str_pad($watch_id,8,"0",STR_PAD_LEFT); 


echo $id.' 丨 '.$watch_id.' 丨 '.$mvid.' 丨 '.$title.' 丨 '.$name.' 丨 '.$file_id.' 丨 '.$fileid.' 丨 '.$pubdate.' 丨 '.$singer_ids.' 丨 '.$mid.' 丨 '.$qqurl.' 丨 '.$filesize.'丨 '.$filename.' 
';
