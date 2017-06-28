<?php
/**
 * $APP_NAME 统一入口
 */

require_once dirname(__FILE__) . '/init.php';

// 装载你的接口
DI()->loader->addDirs('qm');

// 云存储
DI()->ucloud = new UCloud_Lite();

/** ---------------- 响应接口请求 ---------------- **/

/**
 * 全部采用post方式请求数据
 */
//DI()->request = new PhalApi_Request($_POST);

$api = new PhalApi();
$rs = $api->response();
$rs->output();

