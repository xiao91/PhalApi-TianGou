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
        'host' => 'http://localhost/Sky/Public/upload',

    ),

);
