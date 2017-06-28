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
                'from_uid' => array('name' => 'from_uid', 'type' => 'int', 'default' => 0, 'require' => true, 'desc' => '评论用户id'),
                'to_uid' => array('name' => 'to_uid', 'type' => 'int', 'default' => 0, 'require' => false, 'desc' => '回复评论人用户的id')
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
     * @desc 同时根据use_id查询对应的用户信息
     * @return string works_count 该用户发布内容数量
     * @return string followers_count 该用户的粉丝数量
     * @return array hot_comment 热门评论列表
     * @return string hot_comment.user_head 用户头像url，有可能是评论人或回复人的头像
     * @return string hot_comment.username 用户名，有可能是评论人或回复人的名称
     * @return string hot_comment.comment_id 评论id
     * @return string hot_comment.content_id 内容id
     * @return string hot_comment.user_id 用户id
     * @return string hot_comment.comment_detail 评论内容
     * @return string hot_comment.from_uid 用户评论id
     * @return string hot_comment.to_uid 回复该用户的id，如果没有回复该id返回0
     * @return string hot_comment.good_count 该条评论被点赞的次数
     * @return array new_comment 最新评论列表
     * @return string new_comment.user_head 用户头像url，有可能是评论人或回复人的头像
     * @return string new_comment.username 用户名，有可能是评论人或回复人的名称
     * @return string new_comment.comment_id 评论id
     * @return string new_comment.content_id 内容id
     * @return string new_comment.user_id 用户id
     * @return string new_comment.comment_detail 评论内容
     * @return string new_comment.from_uid 用户评论id
     * @return string new_comment.to_uid 回复该用户的id，如果没有回复该id返回0
     * @return string new_comment.good_count 该条评论被点赞的次数
     *
     * http://localhost/QuanMin/Public/?service=Comment.GetHotAndNewComment&content_id=1&user_id=1
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
     * @desc 添加评论，只能登陆后才能评论，同时返回该评论的用户信息
     * @return int code 提示码，0:没有更新，1：添加成功，-1：添加失败
     * @return string info 提示信息
     * @return string username 评论人的名称
     * @return string user_head 评论人的头像url
     *
     * http://localhost/QuanMin/Public/?service=Comment.AddComment&content_id=4&comment_detail=我评价的是第4条333！&from_uid=1
     *
     */
    public function addComment()
    {
        $domain = new Domain_Comment();
        $res = $domain->addComment($this->content_id, $this->comment_detail, $this->from_uid, $this->to_uid);

        return $res;
    }

    /**
     * 用户评论被点赞次数
     * @desc 用户的评论被点赞次数+1
     * @return int code 提示码，0:没有更新，1：更新成功，-1：更新失败
     * @return string info 提示信息
     *
     * http://localhost/QuanMin/Public/?service=Comment.UpdateCommentGoodCount&comment_id=1
     *
     */
    public function updateCommentGoodCount()
    {
        $domain = new Domain_Comment();
        $res = $domain->updateCommentGoodCount($this->comment_id);
        return $res;
    }

    /**
     * 获取更多最新评论
     * @desc 更多的最新评论create_time是上一次最新的时间，没有就是系统时间
     * @return array new_comment 最新评论列表
     * @return string new_comment.user_head 用户头像url，有可能是评论人或回复人的头像
     * @return string new_comment.username 用户名，有可能是评论人或回复人的名称
     * @return string new_comment.comment_id 评论id
     * @return string new_comment.content_id 内容id
     * @return string new_comment.user_id 用户id
     * @return string new_comment.comment_detail 评论内容
     * @return string new_comment.from_uid 用户评论id
     * @return string new_comment.to_uid 回复该用户的id，如果没有回复该id返回0
     * @return string new_comment.good_count 该条评论被点赞的次数
     *
     * http://localhost/QuanMin/Public/?service=Comment.getMoreNewComment&content_id=4&create_time=2017-06-21 14:18:17
     *
     */
    public function getMoreNewComment()
    {
        $domain = new Domain_Comment();
        $res = $domain->getMoreNewComment($this->content_id, $this->create_time);
        return $res;
    }


}