<?php

function is_https() {
    return isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
}

// 从官方更新源抓取更新信息并解析
$official = json_decode(file_get_contents("https://dev.azure.com/blessing-skin/51010f6d-9f99-40f1-a262-0a67f788df32/_apis/git/repositories/a9ff8df7-6dc3-4ff8-bb22-4871d3a43936/Items?path=%2Fupdate.json"), true);
// 获取当前存储的版本信息
$currectVersion = file_get_contents("version.txt");
// 获取最新版本更新包的下载状态
$downloadStatus = file_get_contents("status.txt");

if($currectVersion != $official['latest']) {
    // 有新版本就先返回官方源的内容再拉取更新包
    header("Content-Type: application/json");
    echo(json_encode($official));
    // 避免重复操作，先查询下载状态
    if($downloadStatus != "downloading") {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, is_https() . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/download.php');
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 100);
        curl_exec($ch);
        curl_close($ch);
    }
} else {
    // 直接返回本地链接
    $official['url'] = is_https() . $_SERVER['HTTP_HOST'] . '/update-packs/' . $currectVersion . '.zip';
    header("Content-Type: application/json");
    echo(json_encode($official));
}
?>  