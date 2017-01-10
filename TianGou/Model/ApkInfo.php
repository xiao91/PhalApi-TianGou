<?php

class Model_AndroidApk extends PhalApi_Model_NotORM 
{
	public function getApkInfo()
	{
		$apkInfoORM = DI()->notorm->android_apk;
		$apkVersionCode = $apkInfoORM->max('versionCode');
		$apkInfo = $apkInfoORM->where('$versionCode', $apkVersionCode);

		return $apkInfo;
	}
}