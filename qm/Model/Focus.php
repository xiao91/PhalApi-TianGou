<?php

/**
 * 关注
 * Created by PhpStorm.
 * User: xiao
 * Date: 2017/6/19
 * Time: 10:46
 */
class Model_Focus extends PhalApi_Model_NotORM
{

    /**
     * 添加关注
     *
     */
    public function addFocus($user_id, $uid)
    {
        $res = array('code' => 0, 'info' => '', 'focus_id' => '');
        $data = array(
            'user_id' => $user_id,
            'uid' => $uid,
        );

        $focusORM = DI()->notorm->focus;
        $focus = $focusORM->insert($data);

        $row = $focusORM->insert_id();
        if ($row == 0) {
            $res['code'] = 0;
            $res['info'] = '没有更新';
        } elseif ($row > 0) {
            $res['code'] = 1;
            $res['info'] = '添加关注成功';
        } elseif ($row === false) {
            $res['code'] = -1;
            $res['info'] = '添加关注失败';
        }
        $res['focus_id'] = $focus['focus_id'];
        return $res;
    }

    /**
     * 取消关注
     *
     */
    public function cancelFocus($focus_id)
    {
        $res = array('code'=> 0, 'info'=> '');

        $focusORM = DI()->notorm->focus;
        $focus = $focusORM->where('focus_id', $focus_id)->delete();

        if ($focus > 0) {
            $res['code'] = 1;
            $res['info'] = '取消关注成功';
        } else {
            $res['code'] = -1;
            $res['info'] = '取消关注失败';
        }

        return $res;
    }

    /**
     * 查询有没有关注
     *
     */
    public function readFocus($user_id, $uid)
    {
        $res = array('code'=> 0, 'info'=> '', 'focus_id' => '');

        $focusORM = DI()->notorm->focus;
        $sql = 'SELECT focus_id FROM qm_focus WHERE user_id = :user_id AND uid = :uid';
        // 返回的是数组，可能有重复的关注数据
        $focus = $focusORM->queryAll($sql, array(':user_id' => $user_id, ':uid' => $uid));

        if (empty($focus)) {
            $res['code'] = -1;
            $res['info'] = '未关注';
        } else {
            $res['focus_id'] = $focus[0]['focus_id'];
            $res['code'] = 1;
            $res['info'] = '有关注';
        }

        return $res;
    }
}