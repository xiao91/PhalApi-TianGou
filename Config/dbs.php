<?php
/**
 * 分库分表的自定义数据库路由配置
 * 
 * @author: dogstar <chanzonghuang@gmail.com> 2015-02-09
 */

return array(
    /**
     * DB数据库服务器集群
     */
    'servers' => array(
        'db_qm' => array(                         //服务器标记
            'host'      => 'localhost',             //数据库域名
            'name'      => 'quanmin',               //数据库名字
            'user'      => 'root',                  //数据库用户名
            'password'  => '',	                    //数据库密码
            'port'      => '3306',                  //数据库端口
            'charset'   => 'UTF8',                  //数据库字符集
        ),
    ),

    /**
     * 自定义路由表
     */
    'tables' => array(
        //通用路由
        '__default__' => array(
            'prefix' => 'tbl_',
            'key' => 'id',
            'map' => array(
                array('db' => 'db_sky'),
            ),
        ),

        /**
        'qm' => array(                                                //表名
        'prefix' => 'qm_',                                         //表名前缀
        'key' => 'id',                                              //表主键名
        'map' => array(                                             //表路由配置
        array('db' => 'db_demo'),                               //单表配置：array('db' => 服务器标记)
        array('start' => 0, 'end' => 2, 'db' => 'db_demo'),     //分表配置：array('start' => 开始下标, 'end' => 结束下标, 'db' => 服务器标记)
        ),
        ),
         */


        'android' => array(
            'prefix' => 'qm_',
            'key' => 'apkId',
            'map' => array(
                array('db' => 'db_qm'),
            ),
        ),

        'content' => array(
            'prefix' => 'qm_',
            'key' => 'content_id',
            'map' => array(
                array('db' => 'db_qm'),
            ),
        ),

        'follower' => array(
            'prefix' => 'qm_',
            'key' => 'followerId',
            'map' => array(
                array('db' => 'db_qm'),
            ),
        ),

        'user' => array(
            'prefix' => 'qm_',
            'key' => 'user_id',
            'map' => array(
                array('db' => 'db_qm'),
            ),
        ),

        'comment' => array(
            'prefix' => 'qm_',
            'key' => 'comment_id',
            'map' => array(
                array('db' => 'db_qm'),
            ),
        ),

        'good' => array(
            'prefix' => 'qm_',
            'key' => 'count_id',
            'map' => array(
                array('db' => 'db_qm'),
            ),
        ),

        'token' => array(
            'prefix' => 'qm_',
            'key' => 'token_id',
            'map' => array(
                array('db' => 'db_qm'),
            ),
        ),

        'focus' => array(
            'prefix' => 'qm_',
            'key' => 'focus_id',
            'map' => array(
                array('db' => 'db_qm'),
            ),
        ),

    ),
);
