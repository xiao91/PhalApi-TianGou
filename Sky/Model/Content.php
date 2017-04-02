<?php

class Model_Content extends PhalApi_Model_NotORM {
	
	/**
	*
	* 内容
	*
	*/
	public function content($type) {

		if ($type == 0) {
        	$contentsORM = DI()->notorm->content;
        	// 查询10条数据：按时间顺序；不分类
			$sql = 'SELECT u.user_photo, u.username, c.* FROM sky_user AS u LEFT JOIN sky_content AS c ON u.user_id = c.user_id ORDER BY c.create_time DESC LIMIT 10';
			$res = $contentsORM->queryAll($sql, array());

			return $res;
		}else {
			// 分类查询
			$contentsORM = DI()->notorm->content;
        	// 查询10条数据：按时间顺序；分类
			$sql = 'SELECT u.user_photo, u.username, c.* FROM sky_user AS u LEFT JOIN sky_content AS c ON u.user_id = c.user_id WHERE c.type = :type ORDER BY c.create_time DESC LIMIT 10';
			$params = array(':type' => $type);
			$res = $contentsORM->queryAll($sql, $params);

			return $res;
		}
		
	}

	/**
	* 获取更多数据，每次查询5条
	*
	*
	*/
	public function getMore($type, $currentCount) {
		if ($type == 0) {
			$contentsORM = DI()->notorm->content;
        	// 查询5条数据：按时间顺序；不分类
			$sql = 'SELECT u.user_photo, u.username, c.* FROM sky_user AS u LEFT JOIN sky_content AS c ON u.user_id = c.user_id ORDER BY c.create_time DESC LIMIT :start,:num';
			$params = array(':start' => $currentCount, ':num' => 5);
			$res = $contentsORM->queryAll($sql, $params);

			return $res;
		}else {
			$contentsORM = DI()->notorm->content;
        	// 查询5条数据：按时间顺序；分类
			$sql = 'SELECT u.user_photo, u.username, c.* FROM sky_user AS u LEFT JOIN sky_content AS c ON u.user_id = c.user_id WHERE c.type = :type ORDER BY c.create_time DESC LIMIT :start,:num';
			$params = array(':type' => $type, ':start' => $currentCount, ':num' => 5);
			$res = $contentsORM->queryAll($sql, $params);

			return $res;
		}
	}

	/**
	* 点赞：更新+1操作
	*
	*
	*/
	public function updateGoodCount($contentId) {
		 $data = array(
		 	'good_count' => new NotORM_Literal("good_count + 1")
		 );
		 
		 $contentsORM = DI()->notorm->content;
		 $row = $contentsORM->where('content_id', $contentId)->update($data);

		 return $row;
	}

	/**
	* 被踩：更新+1操作
	*
	*
	*/
	public function updateBadCount($contentId) {
		 $data = array(
		 	'bad_count' => new NotORM_Literal("bad_count + 1")
		 );
		 
		 $contentsORM = DI()->notorm->content;
		 $row = $contentsORM->where('content_id', $contentId)->update($data);

		 return $row;
	}

}