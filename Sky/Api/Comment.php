<?php

/**
 * Comment评论接口服务
 *
 * xiao
 *
 * 2017-01-04
 *
 */
class Api_Comment extends PhalApi_Api
{

    public function getRules()
    {
        return array(
            'getHotAndNewComment' => array(
                'content_id' => array('name' => 'content_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '内容id'),
                'user_id' => array('name' => 'user_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '该条内容对应的用户id'),
            ),

            'addComment' => array(
                'content_id' => array('name' => 'content_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '内容id'),

                'comment_detail' => array('name' => 'comment_detail', 'require' => true, 'desc' => '评论内容'),

                'user_id' => array('name' => 'user_id', 'type' => 'int', 'require' => true, 'desc' => '评论用户id'),
            ),

            'updateCommentGoodCount' => array(
                'comment_id' => array('name' => 'comment_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '评论id'),
            ),

            'getMoreNewComment' => array(
                'content_id' => array('name' => 'content_id', 'type' => 'int', 'require' => true, 'desc' => '内容id'),

                'create_time' => array('name' => 'create_time', 'require' => true, 'desc' => '评论时间'),
            ),

        );
    }

    /**
     * 获取最热和新的评论数据
     * @desc 同时根据useId查询对应的用户信息
     * @return string total_comment 评论总数
     * @return string user_contents_count 该用户发布内容数量
     * @return string user_followers_count 该用户的粉丝数量
     * @return object hot_comments 热门评论列表
     * @return string hot_comments.user_photo 用户头像url
     * @return string hot_comments.username 用户名
     * @return string hot_comments.comment_id 评论id
     * @return string hot_comments.content_id 内容id
     * @return string hot_comments.user_id 用户id
     * @return string hot_comments.comment_detail 评论内容
     * @return string hot_comments.user_good_count 该用户评论被点赞次数
     * @return string hot_comments.create_time 评论时间
     * @return object new_comments 最新评论列表
     * @return string new_comments.user_photo 用户头像url
     * @return string new_comments.username 用户名
     * @return string new_comments.comment_id 评论id
     * @return string new_comments.content_id 内容id
     * @return string new_comments.user_id 用户id
     * @return string new_comments.comment_detail 评论内容
     * @return string new_comments.user_good_count 该用户评论被点赞次数
     * @return string new_comments.create_time 评论时间
     *
     * http://localhost/Sky/Public/?service=Comment.GetHotAndNewComment&content_id=1&user_id=1
     *
     */
    public function getHotAndNewComment()
    {

        $domain = new Domain_Comment();
        $res = $domain->getHotAndNewComment($this->content_id, $this->user_id);

        return $res;
    }

    /**
     * 添加评论
     * @desc 添加评论，同时返回该评论的用户信息
     * @return int content_id 内容id
     * @return string comment_detail 评论内容
     * @return int user_id 用户id
     * @return string create_time 评论时间
     * @return string comment_id 评论id
     * @return string username 用户名
     * @return string user_photo 用户头像url
     * @return string user_good_count 用户点赞次数，没什么用，只是为了返回评论值一样的增加的固定值
     *
     * http://localhost/Sky/Public/?service=Comment.AddComment&content_id=1&comment_detail=我评价的是第1条！&user_id=1
     *
     */
    public function addComment()
    {
        $domain = new Domain_Comment();
        $res = $domain->addComment($this->content_id, $this->comment_detail, $this->user_id);

        return $res;
    }

    /**
     * 用户评论被点赞次数
     * @desc 用户的评论被点赞次数+1
     * @return int code 提示码，0:没有更新，1：更新成功，-1：更新失败
     * @return string info 提示信息
     *
     * http://localhost/Sky/Public/?service=Comment.UpdateCommentGoodCount&comment_id=1
     *
     */
    public function updateCommentGoodCount()
    {
        $rs = array('code' => 0, 'info' => '');

        $domain = new Domain_Comment();
        $row = $domain->updateCommentGoodCount($this->comment_id);

        $rs['code'] = $row;

        if ($row > 0) {
            $rs['info'] = '更新成功';
        } else if ($row == 0) {
            $rs['info'] = '数据未变化';
        } elseif ($row === false) {
            $rs['info'] = '更新失败';
        }

        return $rs;
    }

    /**
     * 获取更多最新评论
     * @desc 更多的最新评论create_time是上一次最新的时间，没有就是系统时间
     * @return object comments 评论列表
     * @return string comments.user_photo 用户头像url
     * @return string comments.username 用户名
     * @return string comments.comment_id 评论id
     * @return string comments.content_id 内容id
     * @return string comments.user_id 用户id
     * @return string comments.comment_detail 评论内容
     * @return string comments.user_good_count 该用户评论被点赞次数
     * @return string comments.create_time 评论时间
     *
     * http://localhost/Sky/Public/?service=Comment.getMoreNewComment&content_id=1&create_time=2017-01-13 13:38:36
     *
     */
    public function getMoreNewComment()
    {
        $res = array();
        $domain = new Domain_Comment();
        $res['comments'] = $domain->getNewComment($this->content_id, $this->create_time);

        return $res;
    }


}