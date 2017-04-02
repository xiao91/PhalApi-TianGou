<?php

class Model_Android extends PhalApi_Model_NotORM
{
	public function getApkInfo()
	{
		$apkInfoORM = DI()->notorm->android;
		$apkVersionCode = $apkInfoORM->max('version_code');
		$apkInfo = $apkInfoORM->where('version_code', $apkVersionCode);

		return $apkInfo;
	}
}