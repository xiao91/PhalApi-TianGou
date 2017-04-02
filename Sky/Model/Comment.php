<?php

/**
* 评论
* 
* xiao
*
* 2017-01-04
*
*/
class Model_Comment extends PhalApi_Model_NotORM
{
	/**
	* 添加评论:有用户评论可能是匿名
	*
	*/
	public function addComment($contentId, $commentDetail, $userId)
	{	

		// 时间：24小时制
		$time = date('Y-m-d H:i:s', time());

		// 返回的数据加上data
		$data = array(
			'content_id' => $contentId,
			'comment_detail' => $commentDetail,
			'user_id' => $userId,
			'create_time' => $time
		);

		// 插入数据:只是返回要入的数据，不是表中插入行的全部数据
		$commentORM = DI()->notorm->comment;
		$comment = $commentORM->insert($data);

		$comment_id = $commentORM->insert_id();
		$data['comment_id'] = $comment_id;
		
		$userORM = DI()->notorm->user;
		$user = $userORM->select('username', 'user_photo')->where('user_id', $userId)->fetch();

		$data['username'] = $user['username'];
		$data['user_photo'] = $user['user_photo'];

		// 为了与返回评论值一样，加一个
		$data['user_good_count'] = '0';

		return $data;
	}

	/**
	* +1操作
	*
	*/
	public function updateCommentGoodCount($commentId) {
		$data = array(
		 	'user_good_count' => new NotORM_Literal("user_good_count + 1")
		 );
		 
		 $commentsORM = DI()->notorm->comment;
		 $row = $commentsORM->where('comment_id', $commentId)->update($data);

		 return $row;
	}

	/**
	* 获取最热和最新评论数据：前3个为最热（goodCount值最大算起），取时间最接近的10个
	*
	*/
	public function getHotAndNewComment($contentId, $userId) {
		$res = array('totalComment' => 0, 'userContentsCount' => 0, 'userFollowersCount' => 0, 'hotComments' => array(), 'newComments' => array());

		$commentsORM = DI()->notorm->comment;

		// 该条内容下的评论：查点赞数量排名前3个
		$sql = 'SELECT u.user_photo, u.username, c.* FROM sky_user AS u LEFT JOIN sky_comment AS c ON u.user_id = c.user_id where c.content_id = :content_id ORDER BY c.user_good_count DESC LIMIT 3';
		$params = array(':content_id' => $contentId);
		$res['hotComments']= $commentsORM->queryAll($sql, $params);

		// 该条内容下的评论：根据时间排序，取前10
		$sql = 'SELECT u.user_photo, u.username, c.* FROM sky_user AS u LEFT JOIN sky_comment AS c ON u.user_id = c.user_id where c.content_id = :content_id ORDER BY c.create_time DESC LIMIT 10';
		$params = array(':content_id' => $contentId);
		$res['newComments']= $commentsORM->queryAll($sql, $params);

		// 该条内容被评论的次数
		$res['totalComment'] = $commentsORM->count($contentId);

		// 查询对应用户userId的发布作品数量
		$contentsORM = DI()->notorm->contents;
		$sql = 'SELECT user_id, count(1) AS counts FROM sky_content WHERE user_id = :user_id';
		$params = array(':user_id' => $userId);
		$res['userContentsCount'] = $commentsORM->queryAll($sql, $params)[0]['counts'];

		// 查询关注该用户的粉丝个数
		$followersORM = DI()->notorm->followers;
		$sql = 'SELECT user_id, count(1) AS counts FROM sky_follower WHERE user_id = :user_id';
		$params = array(':user_id' => $userId);
		$res['userFollowersCount'] = $commentsORM->queryAll($sql, $params)[0]['counts'];

		return $res;
	}

	/**
	* 仅获取最新的评论数据：每次10个
	*
	*/
	public function getNewComment($contentId, $createTime) {
		$commentsORM = DI()->notorm->comment;

		// 该条内容下的评论：根据时间排序，比传入的时间小，取前10
		$sql = 'SELECT u.user_photo, u.username, c.* FROM sky_user AS u LEFT JOIN sky_comment AS c ON u.user_id = c.user_id WHERE c.content_id = :content_id AND c.create_time < :create_time ORDER BY c.create_time DESC LIMIT 10';
		$params = array(':content_id' => $contentId, ':create_time' => $createTime);
		$res = $commentsORM->queryAll($sql, $params);

		return $res;
	}
	

}