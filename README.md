#PhalAPI框架PHP后端API接口开发实践#

最近正好有空，此应用正在开发当中，主要是为了学习和加强PHP开发，搭建PHP后端；因为PHP后端和Android端都是自己一个人在开发，可能比较慢，但会持续更新。

PhalAPI轻量级开源接口框架：[PhalAPI官网](http://www.phalapi.net)。

Android端App显示：[Android-TianGou](https://github.com/xiao91/Android-TianGou)。

> 数据库：tg.sql，存放目录：/Data/tg.sql。

###数据库模式###

**粗体是主键，***斜体***是外键**

发帖内容：<br/>
Contents(**contentsId**, *userId*, imgUrlOrContent, contentDesc, type, goodCount, badCount, commentCount, shareCount, createTime)

用户信息：<br/>
User(**userId**, username, userTruthName, password, userAge, userPhone, userEmail, userSex, userPhoto, createTime)

评论：只评论不回复<br>
Comments(**commentId**, *contentsId*, *userId*, commentDetail, userGoodCount, createTime)

粉丝：关注的用户<br/>
Followers(**followerId**, *userId*, *uid*)

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

**4.根据contentsId查询评论信息、用户信息:并按照时间排序、获取最新和最热门评论**

核心代码：<br/>
    	
		/**
		* 查询了3张表:内容发布表，用户表，粉丝表
		* 
		* @return totalComment 该条内容总评论次数
		* @return userContentsCount 该用户发布内容个数
		* @return userFollowersCount 该用户粉丝数
		* @return hot 热门评论，只取3个
		* @return new 最新评论，只取10个
		*
		*/
		public function getHotAndNewComment($contentsId, $userId) {
    		$res = array('totalComment' => 0, 'userContentsCount' => 0, 'userFollowersCount' => 0, 'hot' => array(), 'new' => array());
    
    		$commentsORM = DI()->notorm->comments;
    
    		// 该条内容下的评论：查点赞数量排名前3个
    		$sql = 'SELECT u.userPhoto, u.username, c.* FROM tg_user AS u LEFT JOIN tg_comments AS c ON u.userId = c.userId where c.contentsId = :contentsId ORDER BY c.goodCount DESC LIMIT 3';
    		$params = array(':contentsId' => $contentsId);
    		$res['hot']= $commentsORM->queryAll($sql, $params);
    
    		// 该条内容下的评论：根据时间排序，取前10
    		$sql = 'SELECT u.userPhoto, u.username, c.* FROM tg_user AS u LEFT JOIN tg_comments AS c ON u.userId = c.userId where c.contentsId = :contentsId ORDER BY c.createTime DESC LIMIT 10';
    		$params = array(':contentsId' => $contentsId);
    		$res['new']= $commentsORM->queryAll($sql, $params);
    
    		// 该条内容被评论的次数
    		$res['totalComment'] = $commentsORM->count($contentsId);
    
    		// 查询对应用户userId的发布作品数量
    		$contentsORM = DI()->notorm->contents;
    		$sql = 'SELECT userId, count(1) AS counts FROM tg_contents WHERE userId = :userId';
    		$params = array(':userId' => $userId);
    		$res['userContentsCount'] = $commentsORM->queryAll($sql, $params)[0]['counts'];
    
    		// 查询关注该用户的粉丝个数
    		$followersORM = DI()->notorm->followers;
    		$sql = 'SELECT userId, count(1) AS counts FROM tg_followers WHERE userId = :userId';
    		$params = array(':userId' => $userId);
    		$res['userFollowersCount'] = $commentsORM->queryAll($sql, $params)[0]['counts'];
    
    		return $res;
    	}
  



> http://localhost/TianGou/Public/?service=Comments.GetHotAndNewComment&contentsId=1&userId=1

json数据结果：
<p><img src="https://github.com/xiao91/PhalAPI-TianGou/raw/master/Data/comments.json.png" alt="该条内容对应的所有查询json数据" /></p>


我的QQ：1693538112
