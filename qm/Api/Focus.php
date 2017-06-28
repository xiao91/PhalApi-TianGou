<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/27
 * Time: 14:33
 */
class Api_Focus extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'addFocus' => array(
                'user_id' => array('name' => 'user_id', 'type' => 'int', 'require' => false, 'desc' => '用户id，第一人'),
                'uid' => array('name' => 'uid', 'type' => 'int', 'require' => true, 'desc' => '用户id,第二人')
            ),

            'cancelFocus' => array(
                'focus_id' => array('name' => 'focus_id', 'type' => 'int', 'require' => false, 'desc' => '关注的id')
            ),

            'readFocus' => array(
                'user_id' => array('name' => 'user_id', 'type' => 'int', 'require' => false, 'desc' => '用户id，第一人'),
                'uid' => array('name' => 'uid', 'type' => 'int', 'require' => true, 'desc' => '用户id,第二人')
            )
        );
    }

    /**
    * 添加关注
    * @desc 添加关注,登录后才能添加
    * @return int code 提示码，0:没有更新，1：添加关注成功，-1：添加关注失败
    * @return string focus_id 关注的id
    * @return string info 提示信息
    *
    * http://localhost/QuanMin/Public/?service=Focus.AddFocus&user_id=1&uid=8
    *
    */
    public function addFocus()
    {
        $focus = new Domain_Focus();
        $res = $focus->addFocus($this->user_id, $this->uid);
        return $res;
    }

    /**
     * 取消关注
     * @desc 取消关注，需要登录
     * @return int code 提示码，1：取消关注成功，-1：取消关注失败
     * @return string info 提示信息
     *
     * http://localhost/QuanMin/Public/?service=Focus.CancelFocus&focus_id=2
     *
     */
    public function cancelFocus()
    {
        $focus = new Domain_Focus();
        $res = $focus->cancelFocus($this->focus_id);
        return $res;
    }

    /**
     * 判断有没有关注
     * @desc 判断有没有关注，需要登录
     * @return int code 提示码，1：有关注，-1：未关注
     * @return string info 提示信息
     *
     * http://localhost/QuanMin/Public/?service=Focus.ReadFocus&user_id=1&uid=8
     *
     */
    public function readFocus()
    {
        $focus = new Domain_Focus();
        $res = $focus->readFocus($this->user_id, $this->uid);
        return $res;
    }
}