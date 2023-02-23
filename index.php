<?php

$box = $_GET['box'] ?? null;
$url = $_GET['url'] ?? null;
if (empty($box)) {
    $arr = array('msg' => "failed", 'data' => "empty value");
    echo json_encode($arr, 320);
    exit();
} else {
    echo file_get_contents('./head.txt');
    $requesturl = "http://xiaoya的docker:5678/search?box=$box&url=$url";
    $header = array(
        'upgrade-insecure-requests: 1',
        'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36',
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $requesturl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    $content = curl_exec($ch);
    curl_close($ch);
    $firstcontent = preg_replace('/<HTML>[\s\S]*<\/HEAD>/i','',$content);
    $secondcontent = preg_replace('/ACTION\=\/search/i','ACTION=/',$firstcontent);
    $thirdcontent = preg_replace('/<a href=\/><b><< 返回首页<\/b><\/a><p>/i','<a href=https://你的alist域名/><b><< 返回首页</b></a><p>',$secondcontent);
    $fourthcontent = preg_replace('/a href=\//i','a href=https://你的alist域名/xiaoya的docker以Alist-V3的方式挂载到你本地的路径/',$thirdcontent);
    echo $fourthcontent;
}