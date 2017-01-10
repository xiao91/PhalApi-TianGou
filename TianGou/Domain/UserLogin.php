<?php

class Domain_UserLoginLog
{
	public function saveUserLoginInfo($userId, $loginCity)
	{
		$model = new Model_UserLoginHistory();
		$LoginId = $model->saveUserLoginInfo($userId, $loginLastCity);

		return $LoginId;
	}
}