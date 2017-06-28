<?php
/**
 * 请在下面放置任何您需要的应用配置
 */

return array(

    /**
     * 应用接口层的统一参数
     */
    'apiCommonRules' => array(
        //'sign' => array('name' => 'sign', 'require' => true),
    ),

    /**
     * 云上传引擎,支持local,oss,upyun
     */
    'UCloudEngine' => 'local',

    /**
     * 本地存储相关配置（UCloudEngine为local时的配置）
     * 跟主机配置的不一样:可以专门用一个主机存图片
     */
    'UCloud' => array(
        //对应的文件路径,调用时：http://xxxx/项目名/文件目录/文件名.jpg
        'host' => 'http://localhost/QuanMin/Public/upload',

    ),

    /**
     * 七牛相关配置
     */
    'Qiniu' =>  array(
        //统一的key
        'accessKey' => 'cq4aXQPXylh_9UPqwiU291YH5AJ-MYZWf1ClydOZ',
        'secretKey' => 'gw5_bXMnPf8KtaBIrEzHtEtAO7kUbElNU3XzeoSf',
        //自定义配置的空间
        'space_bucket' => 'quanmin',
        'space_host' => 'http://orscb75tu.bkt.clouddn.com',
    ),

);
