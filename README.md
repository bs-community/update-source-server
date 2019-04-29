# 更新源服务端

这是个轻量级的 PHP 程序，可以快速搭建一个适用于 Blessing Skin Server v4 "Tamias"的更新源。

## 说明

当用户查询更新时，这个程序会从官方更新源获取版本信息，并与本地存储的版本信息比较。若官方更新源的版本号与本地存储的不一致，则会从官方更新源拉取完整更新包并存储到本地。

每当有新版本时，这个程序会对第一个查询更新的皮肤站返回官方更新源的更新信息（因为此时本地没有拉取更新包，不能直接从本地源获取更新信息），并自动下载更新包。从第二个查询更新的皮肤站开始，若更新包已经下载完成，则会直接返回本地源的更新信息；若更新包尚未下载完成，则仍然返回官方源的更新信息。

## 使用方法

1. 将这个仓库 Clone 或下载到你的网站目录；
2. 使用浏览器访问或在终端中执行 `init.php`；
3. 将 `update.php` 的完整 URL 填入 Blessing Skin Server 的 `.env` 文件中的 `UPDATE_SOURCE` 项中即可。

## 版权

Copyright (c) 2019 The Blessing Skin Community

这个程序以 MIT 协议开源，你可以在不违反 MIT 协议的条件下对这个程序做任何你想做的事