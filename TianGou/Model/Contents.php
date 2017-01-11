<?php

class Model_Contents extends PhalApi_Model_NotORM {
	
	/**
	*
	* 内容
	*
	*/
	public function content($type) {

		if ($type == 0) {
        	$contentsORM = DI()->notorm->contents;
        	// 查询10条数据：按时间顺序；不分类
			$sql = 'SELECT u.userPhoto, u.username, c.* FROM tg_user AS u LEFT JOIN tg_contents AS c ON u.userId = c.userId ORDER BY c.createTime DESC LIMIT 10';
			$res = $contentsORM->queryAll($sql, array());

			return $res;
		}else {
			// 分类查询
			$contentsORM = DI()->notorm->contents;
        	// 查询10条数据：按时间顺序；不分类
			$sql = 'SELECT u.userPhoto, u.username, c.* FROM tg_user AS u LEFT JOIN tg_contents AS c ON u.userId = c.userId WHERE c.type = :type ORDER BY c.createTime DESC LIMIT 10';
			$params = array(':type' => $type);
			$res = $contentsORM->queryAll($sql, $params);

			return $res;
		}
		
	}

	/**
	* 获取更多数据，每次查询10条
	*
	*
	*/
	public function getMore($type, $currentCount) {
		if ($type == 0) {
			$contentsORM = DI()->notorm->contents;
        	// 查询5条数据：按时间顺序；不分类
			$sql = 'SELECT u.userPhoto, u.username, c.* FROM tg_user AS u LEFT JOIN tg_contents AS c ON u.userId = c.userId ORDER BY c.createTime DESC LIMIT :start,:num';
			$params = array(':start' => $currentCount, ':num' => 5);
			$res = $contentsORM->queryAll($sql, $params);

			return $res;
		}else {
			$contentsORM = DI()->notorm->contents;
        	// 查询5条数据：按时间顺序；不分类
			$sql = 'SELECT u.userPhoto, u.username, c.* FROM tg_user AS u LEFT JOIN tg_contents AS c ON u.userId = c.userId WHERE c.type = :type ORDER BY c.createTime DESC LIMIT :start,:num';
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
	public function updateGoodCount($contentsId) {
		 $data = array(
		 	'goodCount' => new NotORM_Literal("goodCount + 1")
		 );
		 
		 $contentsORM = DI()->notorm->contents;
		 $row = $contentsORM->where('contentsId', $contentsId)->update($data);

		 return $row;
	}

	/**
	* 被踩：更新+1操作
	*
	*
	*/
	public function updateBadCount($contentsId) {
		 $data = array(
		 	'badCount' => new NotORM_Literal("badCount + 1")
		 );
		 
		 $contentsORM = DI()->notorm->contents;
		 $row = $contentsORM->where('contentsId', $contentsId)->update($data);

		 return $row;
	}

}