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
	* 主体评论
	*
	*/
	public function fromComment($topical_id, $comment_detail, $from_uid)
	{
		// 查询主体评论用户名
		$from_username = '';
		$userORM = DI()->notorm->user;
		// 只获取2个字段
		$from_user = $userORM->select('username', 'userPhone')->where('userId', $from_uid)->fetchOne();
		$from_username = $from_user['username'];
		if (empty($from_username)) {
			$from_username = empty($from_user['userPhone']) ? '未知用户' : $from_user['userPhone'];
		}
		
		// 时间
		$time = date('y-m-d h:i:s', time());

		$data = array(
			'commentId' => $topical_id,
			'commentDetail' => $comment_detail,
			'uid' => $from_uid,
			'createTime' => $time
		);

		// 插入数据
		$commentORM = DI()->notorm->comment;
		$commentORM->insert($data);
		$comment_id = $commentORM->insert_id();

		return $comment_id;

	}

}