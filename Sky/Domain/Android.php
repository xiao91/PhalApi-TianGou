<?php

class Domain_Android
{
	public function getApkInfo()
	{
		$model = new Model_Android();
		$apkInfo = $model->getApkInfo();

		return $apkInfo;
	}
}