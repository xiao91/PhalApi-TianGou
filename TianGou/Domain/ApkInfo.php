<?php

class Domain_AndroidApk
{
	public function getApkInfo()
	{
		$model = new Model_AndroidApk();
		$apkInfo = $model->getApkInfo();

		return $apkInfo;
	}
}