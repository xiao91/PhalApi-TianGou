<?php

/**
*
* 记录登录日志，以便找回密码回答问题进行验证
*
* 
*/
class Api_UserLoginHistory extends PhalApi_Api 
{

	public function getRules()
	{
		return array(
			'saveUserLoginInfo' => array(
                'userId' =>array('name' => 'userId', 'require' => true, 'desc' => '用户Id'),
                'loginCity' =>array('name' => 'loginCity', 'require' => true, 'desc' => '登录地址'),
            ),

		);
	}

	/**
     * 
     * 保存用户登录信息
     * 
     */
	public function saveUserLoginInfo()
	{
		$rs = array('code' => 0, 'info' => '');

		$domain = new Domain_UserLoginHistory();
		$loginId = $domain->saveUserLoginInfo($this->userId, $this->loginCity);

		DI()->logger->debug('插入的信息=', $loginId);

		if ($loginId > 0) {
			$rs['code'] = 10000;
			$rs['info'] = '保存成功';
		}else {
			$rs['code'] = 10001;
			$rs['info'] = '保存失败';
		}

		return $rs;
	}
}
