<?php

/**
 * UploadFile文件上传接口服务
 * xiao
 * 2017-04-02
 *
 */
class Api_UploadFile extends PhalApi_Api {

    public function getRules() {
        return array(
            'uploadShortVideo' => array(
                'video' => array('name' => 'video', 'type' => 'file', 'min' => 0, 'require' => true, 'max' => 50 * 1024 * 1024,
                    'range' => array('video/mp4', 'video/x-msvideo'), 'ext' => array('mp4', 'avi'), 'desc' => '视频最大50M'
                )
            ),
        );
        
    }

     /**
     * 测试短视频上传接口
     * @desc上传短视频
     * @return int code 0:数据无更新，1：更新成功，-1：更新失败
     * @return string videoUrl 视频地址
     * @return string info 提示信息
     * http://192.168.1.101/Sky/Public/?service=Upload.UploadShortVideo
     */
    public function uploadShortVideo()
    {
        $res = array('code' => 0, 'info' => '上传成功', 'videoUrl' => '');

        //设置上传路径:年/月/日
        DI()->ucloud->set('save_path', date('Ymd'));
        //新增修改文件名设置上传的文件名称
        // DI()->ucloud->set('file_name', 'avatar');
        //上传表单名：返回文件信息
        $file = DI()->ucloud->upfile($this->video);

        $res['videoUrl'] = $file['file'];

        DI()->logger->debug('文件路径=', $file['file']);

        // ...数据库domain

        return $res;
    }

}