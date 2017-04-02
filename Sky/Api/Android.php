<?php

/**
 * Android接口服务
 *
 * xiao
 *
 * 2017-01-04
 *
 */
class Api_Android extends PhalApi_Api
{

	public function getRules()
	{
		return array(
			'getApkInfo' => array(),
		);
	}

    /**
     * 获取Android端的apk信息
     * @desc 用于获取Android端apk信息
     * @return string apk_id 版本id
     * @return string version_code 版本号
     * @return string version_name 版本名
     * @return string download_url 下载地址
     * @return string version_desc 版本描述
     *
     * http://localhost/Sky/Public/?service=Android.GetApkInfo
     *
     */
	public function getApkInfo()
	{
		$domain = new Domain_Android();
		$apkInfo = $domain->getApkInfo();

		return $apkInfo;
	}


}
