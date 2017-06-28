<?php

/**
 * Content内容接口服务
 *
 * xiao
 *
 * 2017-01-04
 *
 */
class Api_Content extends PhalApi_Api
{

    public function getRules()
    {
        return array(
            'getContent' => array(
                'content_type' => array('name' => 'content_type', 'type' => 'int', 'min' => 0, 'default' => '0', 'require' => true, 'desc' => '类型，0：所有，1：文本笑话，2：图片笑话，3：美女图片，4：恐怖故事，5：漫画，6：搞笑视频'),
            ),

            'getMore' => array(
                'content_type' => array('name' => 'content_type', 'type' => 'int', 'require' => true, 'desc' => '类型'),
                'current_count' => array('name' => 'current_count', 'type' => 'int', 'require' => true, 'desc' => '当前数据个数'),
            ),

            'deleteContent' => array(
                'content_id' => array('name' => 'content_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '内容id'),
            ),

            'addTxtContent' => array(
                'user_id' => array('name' => 'user_id', 'type' => 'int', 'require' => true, 'desc' => '用户id'),
                'content_detail' => array('name' => 'content_detail', 'require' => true, 'desc' => '笑话详情'),
                'content_title' => array('name' => 'content_title', 'require' => true, 'desc' => '笑话标题'),
                'source_url' => array('name' => 'source_url', 'require' => false, 'desc' => '来源网站'),
            ),

            'uploadPhotoFile' => array(
                'file' => array('name' => 'file', 'type' => 'file', 'min' => 0, 'require' => true, 'max' => 5 * 1024 * 1024,
                    'range' => array('image/jpg', 'image/jpeg', 'image/png'), 'ext' => array('jpg', 'jpeg', 'png')
                )
            )
        );
    }

    /**
     * 获取内容
     * @desc 指第一次获取到的数据，默认10条
     * @return string total 总数
     * @return int current_count 当前返回的个数
     * @return array content 内容信息和对应的用户信息列表
     * @return string content.content_id 内容id
     * @return string content.user_id 用户id
     * @return string content.content_detail 内容信息
     * @return string content.content_desc 描述
     * @return string content.content_source_url 来源站
     * @return string content.content_title 标题
     * @return string content.content_type 类型，1表示文本笑话，2表示图片笑话，3表示美女图片，4表示恐怖故事，5表示漫画，6表示搞笑视频
     * @return string content.count_id 点赞表的主键id
     * @return string content.g_uids 所有点过赞的用户id，以逗号分隔
     * @return string content.g_dids 所有未登录点过赞手机设备号id，以逗号分隔
     * @return string content.good_count 点赞次数
     * @return string content.b_uids 所有点过踩的用户id，以逗号分隔
     * @return string content.b_dids 所有未登录点过踩手机设备号id，以逗号分隔
     * @return string content.bad_count 被踩次数
     * @return string content.comment_count 评论次数
     * @return string content.share_count 分享次数
     * @return string content.create_time 创建时间
     * @return string content.user_head 用户头像
     * @return string content.username 用户名字
     *
     * http://localhost/QuanMin/Public/?service=Content.GetContent&content_type=0
     *
     */
    public function getContent()
    {
        $domain = new Domain_Content();
        $res = $domain->getContent($this->content_type);
        return $res;
    }

    /**
     * 获取更多数据，默认每次5条
     * @desc 更多数据，把每次获取的数据current_count传入
     * @return string total 总数
     * @return int current_count 当前返回的数据个数
     * @return array content 内容信息和对应的用户信息列表
     * @return string content.user_head 用户头像
     * @return string content.username 用户名字
     * @return string content.content_id 内容id
     * @return string content.user_id 用户id
     * @return string content.content_detail 内容信息
     * @return string content.content_desc 描述
     * @return string content.content_title 标题
     * @return string content.content_type 类型，1表示文本笑话，2表示图片笑话，3表示美女图片，4表示恐怖故事，5表示漫画，6表示搞笑视频
     * @return string content.g_uids 所有点过赞的用户id，以逗号分隔
     * @return string content.g_dids 所有未登录点过赞手机设备号id，以逗号分隔
     * @return string content.good_count 点赞次数
     * @return string content.b_uids 所有点过踩的用户id，以逗号分隔
     * @return string content.b_dids 所有未登录点过踩手机设备号id，以逗号分隔
     * @return string content.bad_count 被踩次数
     * @return string content.comment_count 评论次数
     * @return string content.share_count 分享次数
     * @return string content.create_time 创建时间
     *
     * http://localhost/QuanMin/Public/?service=Content.GetMore&content_type=0&current_count=10
     *
     */
    public function getMore()
    {
        $domain = new Domain_Content();
        $res = $domain->getMore($this->content_type, $this->current_count);
        return $res;
    }

    /**
     * 删除该条内容
     * @desc 根据content_id删除对应的数据
     * @return int code 提示码，0:删除成功，-1：删除失败
     * @return string info 提示信息
     *
     * http://localhost/QuanMin/Public/?service=Content.DeleteContent&content_id=6
     *
     */
    public function deleteContent()
    {
        $domain = new Domain_Content();
        $res = $domain->deleteContent($this->content_id);
        return $res;
    }

    /**
     * 上传文本笑话
     * @desc 上传笑话内容，只有登录之后才能上传
     * @return int code 提示码，0:删除成功，-1：删除失败
     * @return string info 提示信息
     *
     * http://localhost/QuanMin/Public/?service=Content.AddTxtContent&user_id=1&content_detail=文本笑话&content_title=笑话
     *
     */
    public function addTxtContent()
    {
        $domain = new Domain_Content();
        $res = $domain->addTxtContent($this->user_id, $this->content_detail, $this->content_title, $this->source_url);
        return $res;
    }

    /**
     * 上传图片
     * @desc 上传图片内容，只有登录之后才能上传
     * @return int code 提示码，0:删除成功，-1：删除失败
     * @return string info 提示信息
     *
     * http://localhost/QuanMin/Public/?service=Content.uploadPhotoFile
     *
     */
    public function uploadPhotoFile()
    {
        $res = DI()->qiniu->uploadFile($this->file);
        return $res;
    }

}