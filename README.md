#PhalAPI框架PHP后端API接口开发实践#

最近正好有空，此应用正在开发当中，主要是为了学习和加强PHP开发，搭建PHP后端；因为PHP后端和Android端都是自己一个人在开发，可能比较慢，但会持续更新。

PhalAPI轻量级开源接口框架：[PhalAPI官网](http://www.phalapi.net)。

Android端App显示：[Android-TianGou](https://github.com/xiao91/Android-TianGou)。

> 数据库：sky.sql，存放目录：/Data/sky.zip。



> 测试的账号：tiangou，密码：123

###数据库模式###

**粗体是主键，***斜体***是外键**

内容：<br/>
Content(**content_id**, *user_id*, content, content_describe, title, type, good_count, bad_count, comment_count, share_count, create_time)

用户信息：<br/>
User(**user_id**, username, user_truth_name, password, user_age, user_phone, user_email, user_sex, user_qq, user_photo, user_type, user_interest, user_address, create_time)

评论：只评论不回复<br>
Comment(**comment_id**, *content_id*, *user_id*, comment_detail, user_good_count, create_time)

粉丝：关注的用户<br/>
Follower(**follower_id**, *user_id*, *uid*)

**1.接口列表**

<p><img src="https://github.com/xiao91/PhalAPI-TianGou/raw/master/Example/listapis.jpg" alt="接口列表" /></p>

**2.内容接口**

<p><img src="https://github.com/xiao91/PhalAPI-TianGou/raw/master/Example/content_api.jpg" alt="接口列表" /></p>


我的QQ：1693538112
