#PhalAPI框架PHP后端API接口开发实践#

最近正好有空，此应用正在开发当中，主要是为了学习和加强PHP开发，搭建PHP后端；因为PHP后端和Android端都是自己一个人在开发，可能比较慢，但会持续更新。

PhalAPI轻量级开源接口框架：[PhalAPI官网](http://www.phalapi.net)。

Android端App显示：[Android-TianGou](https://github.com/xiao91/Android-TianGou)。

> 数据库：tg.sql，存放目录：/Data/tg.sql。

**1.查看默认首页API接口数据**

> http://localhost/TianGou/Public

<p><img src="https://github.com/xiao91/PhalAPI-TianGou/raw/master/Data/default_home.json.png" alt="json数据" /></p>



**2.上传单张图片**

> http://localhost/TianGou/Example/upload_photo.html

如图：
<p><img src="https://github.com/xiao91/PhalAPI-TianGou/raw/master/Data/upload_photo.html.png" alt="html文件"></p>

json数据结果：
<p><img src="https://github.com/xiao91/PhalAPI-TianGou/raw/master/Data/upload_photo.json.png" alt="上传图片json数据" /></p>

**3.点赞**

> http://localhost/TianGou/Public/?service=Contents.UpdateGoodCount&contentsId=1

json数据结果：

<p><img src="https://github.com/xiao91/PhalAPI-TianGou/raw/master/Data/update_good_count.json.png" alt="更新点赞次数json数据" /></p>


我的QQ：1693538112
