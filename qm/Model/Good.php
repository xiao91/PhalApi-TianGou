<?php

/**
 * Created by PhpStorm.
 * User: xiao
 * Date: 2017/6/19
 * Time: 10:46
 */
class Model_Good extends PhalApi_Model_NotORM
{

    /**
     * 点赞：更新+1操作
     *
     *
     */
    public function updateGoodCount($count_id, $user_id, $device_code)
    {
        $res = array('code' => 0, 'info' => '');

        $data = array(
            'good_count' => new NotORM_Literal("good_count + 1")
        );
        $goodORM = DI()->notorm->good;
        $row = $goodORM->where('count_id', $count_id)->update($data);

        // 加user_id，用分号分隔
        if (!empty($user_id)) {
            $sql = "UPDATE qm_good SET g_uids = CONCAT (g_uids, ';$user_id') WHERE count_id = $count_id";
            $goodORM->queryAll($sql, array());
        }

        // 加device_code，用分号分隔
        if (!empty($device_code)) {
            $sql = "UPDATE qm_good SET g_dids = CONCAT (g_dids, ';$device_code') WHERE count_id = $count_id";
            $goodORM->queryAll($sql, array());
        }

        if ($row == 0) {
            $res['code'] = 0;
            $res['info'] = '没有更新';
        } elseif ($row > 0) {
            $res['code'] = 1;
            $res['info'] = '更新成功';
        } elseif ($row === false) {
            $res['code'] = -1;
            $res['info'] = '更新失败';
        }

        return $res;
    }

    /**
     * 被踩：更新+1操作
     *
     *
     */
    public function updateBadCount($count_id, $user_id, $device_code)
    {
        $res = array('code' => 0, 'info' => '');

        $data = array(
            'bad_count' => new NotORM_Literal("bad_count + 1")
        );
        $goodORM = DI()->notorm->good;
        $row = $goodORM->where('count_id', $count_id)->update($data);

        // 加user_id，用分号分隔
        if (!empty($user_id)) {
            $sql = "UPDATE qm_good SET b_uids = CONCAT (b_uids, ';$user_id') WHERE count_id = $count_id";
            $goodORM->queryAll($sql, array());
        }

        // 加device_code，用分号分隔
        if (!empty($device_code)) {
            $sql = "UPDATE qm_good SET b_dids = CONCAT (b_dids, ';$device_code') WHERE count_id = $count_id";
            $goodORM->queryAll($sql, array());
        }

        if ($row == 0) {
            $res['code'] = 0;
            $res['info'] = '没有更新';
        } elseif ($row > 0) {
            $res['code'] = 1;
            $res['info'] = '更新成功';
        } elseif ($row === false) {
            $res['code'] = -1;
            $res['info'] = '更新失败';
        }

        return $res;
    }

    /**
     * 评论：更新+1操作
     *
     *
     */
    public function updateCommentCount($count_id)
    {
        $res = array('code' => 0, 'info' => '');

        $data = array(
            'comment_count' => new NotORM_Literal("comment_count + 1")
        );
        $goodORM = DI()->notorm->good;
        $row = $goodORM->where('count_id', $count_id)->update($data);

        if ($row == 0) {
            $res['code'] = 0;
            $res['info'] = '没有更新';
        } elseif ($row > 0) {
            $res['code'] = 1;
            $res['info'] = '更新成功';
        } elseif ($row === false) {
            $res['code'] = -1;
            $res['info'] = '更新失败';
        }

        return $res;
    }

    /**
     * 分享：更新+1操作
     *
     *
     */
    public function updateShareCount($count_id)
    {
        $res = array('code' => 0, 'info' => '');

        $data = array(
            'share_count' => new NotORM_Literal("share_count + 1")
        );
        $goodORM = DI()->notorm->good;
        $row = $goodORM->where('count_id', $count_id)->update($data);

        if ($row == 0) {
            $res['code'] = 0;
            $res['info'] = '没有更新';
        } elseif ($row > 0) {
            $res['code'] = 1;
            $res['info'] = '更新成功';
        } elseif ($row === false) {
            $res['code'] = -1;
            $res['info'] = '更新失败';
        }

        return $res;
    }
}