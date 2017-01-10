<?php

class Api_AndroidApk extends PhalApi_Api
{

	public function getRules()
	{
		return array(
			'getVersionCode' => array(
				'versionCode' => array('name' => 'versionCode', 'type' => 'int', 'min' => 1, 'require' => false, 'desc' => 'APK版本号'),
			),
		);
	}

	public function getApkInfo()
	{
		$rs = array('versionCode' => 0, 'versionName' => '', 'downloadUrl' => '', 'versionDesc' => '');

		$domain = new Domain_AndroidApk();
		$apkInfo = $domain->getApkInfo();

		DI()->logger->debug('apk的信息:', $apkInfo);

		$path = $_SERVER['DOCUMENT_ROOT'];
		DI()->logger->debug('apk的目录11:', $path);

		DI()->logger->debug('apk的目录22:', dirname(__FILE__));

		DI()->logger->debug('apk的目录33:', $path.'/../');
		DI()->logger->debug('apk的目录44:', API_ROOT);

		DI()->logger->debug('apk的目录55:', API_ROOT.'/upload');
 
			$rs['versionName'] = $apkInfo['version_name'];
			$rs['downloadUrl'] = $apkInfo['download_url'];
			$rs['versionDesc'] = $apkInfo['version_desc'];

			return $rs;
		}

		return $rs;
	}


}
