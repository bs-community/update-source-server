<?php

// 忽略用户退出并解除运行时间限制
ignore_user_abort(true);
set_time_limit(0);

// 从官方源获取最新版本和下载链接
$official = json_decode(file_get_contents('https://dev.azure.com/blessing-skin/51010f6d-9f99-40f1-a262-0a67f788df32/_apis/git/repositories/a9ff8df7-6dc3-4ff8-bb22-4871d3a43936/Items?path=%2Fupdate.json'), true);

// 下载更新包前先标记下载状态
file_put_contents('status.txt', 'downloading', LOCK_EX);

// 下载更新包
file_put_contents(__DIR__ . '/update-packs/' . $official['latest'] . '.zip', file_get_contents($official['url']), LOCK_EX);

// 修改本地存储的最新版本信息并更新下载状态
file_put_contents('version.txt', $official['latest'], LOCK_EX);
file_put_contents('status.txt', 'done', LOCK_EX);

?>