<?php

/**
 * Good点赞、点踩、评论、分享更新次数接口
 * User: xiao
 * Date: 2017/6/19
 * Time: 10:41
 */
class Api_Good extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'updateGoodCount' => array(
                'count_id' => array('name' => 'count_id', 'type' => 'int', 'require' => true, 'desc' => '点赞主键id'),
                'user_id' => array('name' => 'user_id', 'type' => 'int', 'require' => false, 'desc' => '用户id'),
                'device_code' => array('name' => 'device_code', 'require' => false, 'desc' => '手机id')
            ),

            'updateBadCount' => array(
                'count_id' => array('name' => 'count_id', 'type' => 'int', 'require' => true, 'desc' => '点踩主键id'),
                'user_id' => array('name' => 'user_id', 'type' => 'int', 'require' => false, 'desc' => '用户id'),
                'device_code' => array('name' => 'device_code', 'require' => false, 'desc' => '手机id')
            ),

            'updateCommentCount' => array(
                'content_id' => array('name' => 'content_id', 'type' => 'int', 'require' => true, 'desc' => '内容id')
            ),

            'updateShareCount' => array(
                'content_id' => array('name' => 'content_id', 'type' => 'int', 'require' => true, 'desc' => '内容id')
            ),

        );
    }

    /**
     * 更新点赞次数
     * @desc 点赞次数+1
     * @return int code 提示码，0:没有更新，1：更新成功，-1：更新失败
     * @return string info 提示信息
     *
     * http://localhost/QuanMin/Public/?service=Good.UpdateGoodCount&count_id=1&user_id=1
     *
     */
    public function updateGoodCount()
    {
        $domain = new Domain_Good();
        $res = $domain->updateGoodCount($this->count_id, $this->user_id, $this->device_code);
        return $res;
    }

    /**
     * 更新被踩次数
     * @desc 被踩次数+1
     * @return int code 提示码，0:没有更新，1：更新成功，-1：更新失败
     * @return string info 提示信息
     *
     * http://localhost/QuanMin/Public/?service=Good.UpdateBadCount&count_id=1&user_id=1
     *
     */
    public function updateBadCount()
    {
        $domain = new Domain_Good();
        $res = $domain->updateBadCount($this->count_id, $this->user_id, $this->device_code);
        return $res;
    }

    /**
     * 更新评论次数
     * @desc 被评论次数+1
     * @return int code 提示码，0:没有更新，1：更新成功，-1：更新失败
     * @return string info 提示信息
     *
     * http://localhost/QuanMin/Public/?service=Good.UpdateCommentCount&count_id=1&user_id=1
     *
     */
    public function updateCommentCount()
    {
        $domain = new Domain_Good();
        $res = $domain->updateCommentCount($this->count_id);
        return $res;
    }

    /**
     * 更新分享次数
     * @desc 被分享次数+1
     * @return int code 提示码，0:没有更新，1：更新成功，-1：更新失败
     * @return string info 提示信息
     *
     * http://localhost/QuanMin/Public/?service=Good.UpdateShareCount&count_id=1&user_id=1
     *
     */
    public function updateShareCount()
    {
        $domain = new Domain_Good();
        $res = $domain->updateShareCount($this->count_id);
        return $res;
    }

}