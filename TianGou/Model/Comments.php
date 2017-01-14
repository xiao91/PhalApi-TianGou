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
		// 时间：24小时制
		$time = date('Y-m-d H:i:s', time());

		// 返回的数据加上data
		$data = array(
			'contentsId' => $contentsId,
			'commentDetail' => $commentDetail,
			'userId' => $userId,
			'createTime' => $time
		);

		// 插入数据:只是返回要入的数据，不是表中插入行的全部数据
		$commentORM = DI()->notorm->comments;
		$comment = $commentORM->insert($data);
		
		$userORM = DI()->notorm->user;
		$user = $userORM->select('username', 'userPhoto')->where('userId', $userId)->fetch();

		$comment['username'] = $user['username'];
		$comment['userPhoto'] = $user['userPhoto'];

		// 为了与返回评论值一样，加一个
		$comment['userGoodCount'] = '0';

		return $comment;
	}

	//对emoji表情转义
	function emoji_encode($str){
	    $strEncode = '';

	    $length = mb_strlen($str,'utf-8');

	    for ($i=0; $i < $length; $i++) {
	        $_tmpStr = mb_substr($str,$i,1,'utf-8');    
	        if(strlen($_tmpStr) >= 4){
	            $strEncode .= '[[EMOJI:'.rawurlencode($_tmpStr).']]';
	        }else{
	            $strEncode .= $_tmpStr;
	        }
	    }

	    return $strEncode;
	}
	//对emoji表情转反义
	function emoji_decode($str){
	    $strDecode = preg_replace_callback('|\[\[EMOJI:(.*?)\]\]|', function($matches){  
	        return rawurldecode($matches[1]);
	    }, $str);

	    return $strDecode;
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
		$res = array('totalComment' => 0, 'userContentsCount' => 0, 'userFollowersCount' => 0, 'hotComments' => array(), 'newComments' => array());

		$commentsORM = DI()->notorm->comments;

		// 该条内容下的评论：查点赞数量排名前3个
		$sql = 'SELECT u.userPhoto, u.username, c.* FROM tg_user AS u LEFT JOIN tg_comments AS c ON u.userId = c.userId where c.contentsId = :contentsId ORDER BY c.userGoodCount DESC LIMIT 3';
		$params = array(':contentsId' => $contentsId);
		$res['hotComments']= $commentsORM->queryAll($sql, $params);

		// 该条内容下的评论：根据时间排序，取前10
		$sql = 'SELECT u.userPhoto, u.username, c.* FROM tg_user AS u LEFT JOIN tg_comments AS c ON u.userId = c.userId where c.contentsId = :contentsId ORDER BY c.createTime DESC LIMIT 10';
		$params = array(':contentsId' => $contentsId);
		$res['newComments']= $commentsORM->queryAll($sql, $params);

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

	/**
	* 仅获取最新的评论数据：每次10个
	*
	*/
	public function getNewComment($contentsId, $createTime) {
		$commentsORM = DI()->notorm->comments;

		// 该条内容下的评论：根据时间排序，比传入的时间小，取前10
		$sql = 'SELECT u.userPhoto, u.username, c.* FROM tg_user AS u LEFT JOIN tg_comments AS c ON u.userId = c.userId WHERE c.contentsId = :contentsId AND c.createTime < :createTime ORDER BY c.createTime DESC LIMIT 10';
		$params = array(':contentsId' => $contentsId, ':createTime' => $createTime);
		$res = $commentsORM->queryAll($sql, $params);

		return $res;
	}
	

}