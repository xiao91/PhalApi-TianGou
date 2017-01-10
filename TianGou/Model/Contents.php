<?php

class Model_Contents extends PhalApi_Model_NotORM {
	
	/**
	*
	* 内容
	*
	*/
	public function content($type) {

		if ($type == 0) {
			// $sql = 'select userId, username, userPhoto from tg_user as u left join tg_contents a on u.userId = a.userId where userId=';

        	$contentsORM = DI()->notorm->contents;
        	$contents = $contentsORM->select('*')->limit(10)->fetchAll();

			// 查询用户信息
			$userIds = array();
			$userORM = DI()->notorm->user;
			foreach ($contents as $key => $value) {
				$userIds[] = $value['userId'];
			}
			// 去掉重复值
			$newUserIds = array_unique($userIds); 

			$users = $userORM->select('userId, username, userPhoto')->where('userId', $newUserIds)->fetchAll();

			$contentCount = count($contents);
			$userCount = count($users);
			for ($i=0; $i < $contentCount; $i++) { 
				for ($j=0; $j < $userCount; $j++) { 
					if ($contents[$i]['userId'] == $users[$j]['userId']) {
						$contents[$i]['username'] = $users[$j]['username'];
						$contents[$i]['userPhoto'] = $users[$j]['userPhoto'];
					}
				}
			}

			return $contents;
		}else {
			// 分类查询
			$contentsORM = DI()->notorm->contents;
			// 默认6条
			$contents = $contentsORM->where('type', $type)->limit(10)->fetchAll();

			// 查询用户信息
			$userIds = array();
			$userORM = DI()->notorm->user;
			foreach ($contents as $key => $value) {
				$userIds[] = $value['userId'];
			}
			// 去掉重复值
			$new_userIds = array_unique($userIds); 

			$users = $userORM->select('userId, userName, userPhoto')->where('userId', $new_userIds)->fetchAll();

			$contentCount = count($contents);
			$userCount = count($users);
			for ($i=0; $i < $contentCount; $i++) { 
				for ($j=0; $j < $userCount; $j++) { 
					if ($contents[$i]['userId'] == $users[$j]['userId']) {
						$contents[$i]['userName'] = $users[$j]['userName'];
						$contents[$i]['userPhoto'] = $users[$j]['userPhoto'];
					}
				}
			}

			return $contents;
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
        	$contents = $contentsORM->select('*')->limit($currentCount, 10)->fetchAll();

			// 查询用户信息
			$userIds = array();
			$userORM = DI()->notorm->user;
			foreach ($contents as $key => $value) {
				$userIds[] = $value['userId'];
			}
			// 去掉重复值
			$newUserIds = array_unique($userIds); 

			$users = $userORM->select('userId, username, userPhoto')->where('userId', $newUserIds)->fetchAll();

			$contentCount = count($contents);
			$userCount = count($users);
			for ($i=0; $i < $contentCount; $i++) { 
				for ($j=0; $j < $userCount; $j++) { 
					if ($contents[$i]['userId'] == $users[$j]['userId']) {
						$contents[$i]['username'] = $users[$j]['username'];
						$contents[$i]['userPhoto'] = $users[$j]['userPhoto'];
					}
				}
			}

			return $contents;
		}else {
			// 分类查询
			$contentsORM = DI()->notorm->contents;
			// 默认6条
			$contents = $contentsORM->where('type', $type)->limit($currentCount, 10)->fetchAll();

			// 查询用户信息
			$userIds = array();
			$userORM = DI()->notorm->user;
			foreach ($contents as $key => $value) {
				$userIds[] = $value['userId'];
			}
			// 去掉重复值
			$new_userIds = array_unique($userIds); 

			$users = $userORM->select('userId, userName, userPhoto')->where('userId', $new_userIds)->fetchAll();

			$contentCount = count($contents);
			$userCount = count($users);
			for ($i=0; $i < $contentCount; $i++) { 
				for ($j=0; $j < $userCount; $j++) { 
					if ($contents[$i]['userId'] == $users[$j]['userId']) {
						$contents[$i]['userName'] = $users[$j]['userName'];
						$contents[$i]['userPhoto'] = $users[$j]['userPhoto'];
					}
				}
			}

			return $contents;
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