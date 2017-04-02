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
                'type' => array('name' => 'type', 'type' => 'int', 'min' => 0, 'require' => true, 'desc' => '类型，0：所有，1：文本笑话，2：图片笑话，3：美女图片，4：恐怖故事，5：漫画，6：搞笑视频'),
            ),

            'getMore' => array(
                'type' => array('name' => 'type', 'type' => 'int', 'require' => true, 'desc' => '类型'),

                'currentCount' => array('name' => 'current_count', 'type' => 'int', 'require' => true, 'desc' => '当前数据个数'),
            ),

            'updateGoodCount' => array(
                'contentId' => array('name' => 'content_id', 'type' => 'int', 'require' => true, 'desc' => '内容id'),
            ),

            'updateBadCount' => array(
                'contentId' => array('name' => 'content_id', 'type' => 'int', 'require' => true, 'desc' => '内容id'),
            ),


        );
    }

    /**
     * 获取内容
     * @desc 指第一次获取到的数据，默认10条
     * @return int currentCount 当前返回的数据个数
     * @return object contents 内容信息和对应的用户信息列表
     * @return string contents.user_photo 用户头像
     * @return string contents.username 用户名字
     * @return string contents.content_id 内容id
     * @return string contents.user_id 用户id
     * @return string contents.content 内容信息
     * @return string contents.content_describe 描述
     * @return string contents.title 标题
     * @return string contents.type 类型，1表示文本笑话，2表示图片笑话，3表示美女图片，4表示恐怖故事，5表示漫画，6表示搞笑视频
     * @return string contents.good_count 点赞次数
     * @return string contents.bad_count 被踩次数
     * @return string contents.comment_count 评论次数
     * @return string contents.share_count 分享次数
     * @return string contents.create_time 创建时间
     *
     * http://localhost/Sky/Public/?service=Content.GetContent&type=0
     *
     */
    public function getContent()
    {
        $res = array('currentCount' => 0, 'contents' => array());
        $domain = new Domain_Content();
        $arr = $domain->content($this->type);
        $res['currentCount'] = count($arr);
        $res['contents'] = $arr;

        return $res;
    }

    /**
     * 获取更多数据：分页
     * @desc 更多数据，把每次获取的数据currentCount传入
     * @return int current_count 当前返回的数据个数
     * @return object contents 内容信息和对应的用户信息列表
     * @return string contents.user_photo 用户头像
     * @return string contents.username 用户名字
     * @return string contents.content_id 内容id
     * @return string contents.user_id 用户id
     * @return string contents.content 内容信息
     * @return string contents.content_describe 描述
     * @return string contents.title 标题
     * @return string contents.type 类型，1表示文本笑话，2表示图片笑话，3表示美女图片，4表示恐怖故事，5表示漫画，6表示搞笑视频
     * @return string contents.good_count 点赞次数
     * @return string contents.bad_count 被踩次数
     * @return string contents.comment_count 评论次数
     * @return string contents.share_count 分享次数
     * @return string contents.create_time 创建时间
     *
     * http://localhost/Sky/Public/?service=Content.GetMore&type=0&current_count=10
     *
     */
    public function getMore()
    {
        $res = array('currentCount' => 0, 'contents' => array());

        $domain = new Domain_Content();
        $contents = $domain->getMore($this->type, $this->currentCount);

        $res['currentCount'] = count($contents);
        $res['contents'] = $contents;

        return $res;
    }

    /**
     * 更新点赞次数
     * @desc 点赞次数+1
     * @return int code 提示码，0:没有更新，1：更新成功，-1：更新失败
     * @return string info 提示信息
     *
     * http://localhost/Sky/Public/?service=Content.UpdateGoodCount&contentId=1
     *
     */
    public function updateGoodCount()
    {
        $res = array('code' => 0, 'info' => '');

        $domain = new Domain_Content();
        $row = $domain->updateGoodCount($this->contentId);

        $res['code'] = $row;

        if ($row == 0) {
            $res['code'] = 0;
            $res['info'] = '没有更新';
        } elseif ($row > 0) {
            $res['info'] = '更新成功';
        } elseif ($row === false) {
            $res['info'] = '更新失败';
        }

        return $res;
    }

    /**
     * 更新被踩次数
     * @desc 被踩次数+1
     * @return int code 提示码，0:没有更新，1：更新成功，-1：更新失败
     * @return string info 提示信息
     *
     * http://localhost/Sky/Public/?service=Content.UpdateGoodCount&content_id=1
     *
     */
    public function updateBadCount()
    {
        $res = array('code' => 0, 'info' => '');

        $domain = new Domain_Content();
        $row = $domain->updateBadCount($this->contentId);

        $res['code'] = $row;

        if ($row == 0) {
            $res['info'] = '没有更新';
        } elseif ($row > 0) {
            $res['info'] = '更新成功';
        } elseif ($row === false) {
            $res['info'] = '更新失败';
        }

        return $res;
    }

}