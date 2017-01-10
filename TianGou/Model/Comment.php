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
		$commentORM = DI()->notorm->comment;
		$commentORM->insert($data);
		$commentId = $commentORM->insert_id();

		return $commentId;
	}

	

}