<?php

/**
* 评论
* 
* xiao
*
* 2017-01-04
*
*/
class Model_Comments extends PhalApi_Model_NotORM
{
	/**
	* 添加评论
	*
	*/
	public function addComment($contentsId, $commentDetail, $userId)
	{	
		// 时间
		$time = date('y-m-d h:i:s', time());

		$data = array(
			'contentsId' => $contentsId,
			'commentDetail' => $commentDetail,
			'userId' => $userId,
			'createTime' => $time
		);

		// 插入数据
		$commentORM = DI()->notorm->comments;
		$commentORM->insert($data);
		$commentId = $commentORM->insert_id();

		return $commentId;
	}


	/**
	* +1操作
	*
	*/
	public function updateCommentGoodCount($commentId) {
		$data = array(
		 	'goodCount' => new NotORM_Literal("goodCount + 1")
		 );
		 
		 $commentsORM = DI()->notorm->comments;
		 $row = $commentsORM->where('commentId', $commentId)->update($data);

		 return $row;
	}

	/**
	* 获取最热和最新评论数据：前3个为最热（goodCount值最大算起），取时间最接近的10个
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

	

}