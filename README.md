# PhalAPI框架PHP后端API接口开发实践 #

努力学习PHP开发ing...

PhalAPI轻量级开源接口框架：[PhalAPI官网](http://www.phalapi.net)。

Android端App项目地址：[Android-TianGou](https://github.com/xiao91/Android-TianGou)。

> 数据库：存放目录：/Data/quanmin.zip。

> 测试的账号：15000000000（测试用的，请不要尝试去打电话）

> 密码：123456

### 数据库模式 ###

**粗体是主键，***斜体***是外键**

<p>1. 内容：Content(**content_id**, *user_id*, content_detail, content_desc, content_source_url, content_title, content_type, create_time)</p>

<p>2. 用户信息：User(**user_id**, username, password, user_age, user_phone, user_email, user_sex, user_qq, user_head, user_type, user_interest, user_address, user_register_time)</p>

<p>3. 评论：Comment(**comment_id**, content_id, comment_detail, from_uid, to_uid, username,  user_head, good_count, create_time)</p>

<p>4. 关注：Follower(**focus_id**, user_id, uid)</p>

<p>5. 点赞、点踩、评论、分享次数统计：Good(**count_id**, content_id, guids, gdids, good_count, buids, bdids, bood_count, comment_count, share_count)</p>

<p>6. token标识：Token(**token_id**, token, device_code, mobile_type)</p>

<p>7. Android版本：Android(**and_id**, and_version_code, and_version_name, and_download_url, and_version_desc)</p>

**1.接口列表**

<p><img src="https://github.com/xiao91/PhalAPI-TianGou/raw/master/Example/listapis.png" alt="接口列表" /></p>

**2.内容接口**

<p><img src="https://github.com/xiao91/PhalAPI-TianGou/raw/master/Example/content_api.png" alt="接口列表" /></p>

### 联系我 ###

我的QQ：1693538112
