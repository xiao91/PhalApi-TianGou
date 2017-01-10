<?php


class Model_UserLoginHistory extends PhalApi_Model_NotORM
{
	protected function getTableName($id) {
        return 'user_login_history';
    }

	public function saveUserLoginInfo($userId, $loginCity)
	{
		$data = array(
			'userId' => $userId,
			'loginCity' => $loginCity
		);

		$userLoginHistoryORM = DI()->notorm->user_login_history;
		$userLoginHistory = $userLoginHistoryORM->insert($data);
		// 获取新增的id
		$loginId = $userLoginLogORM->insert_id();

		return $loginId;
	}
}