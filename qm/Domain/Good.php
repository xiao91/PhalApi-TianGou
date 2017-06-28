<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/19
 * Time: 10:45
 */
class Domain_Good
{
    public function updateGoodCount($count_id, $user_id, $device_code) {
        $model = new Model_Good();
        $res = $model->updateGoodCount($count_id, $user_id, $device_code);
        return $res;
    }

    public function updateBadCount($count_id, $user_id, $device_code) {
        $model = new Model_Good();
        $res = $model->updateBadCount($count_id, $user_id, $device_code);
        return $res;
    }

    public function updateCommentCount($count_id) {
        $model = new Model_Good();
        $res = $model->updateCommentCount($count_id);
        return $res;
    }

    public function updateShareCount($count_id) {
        $model = new Model_Good();
        $res = $model->updateShareCount($count_id);
        return $res;
    }
}