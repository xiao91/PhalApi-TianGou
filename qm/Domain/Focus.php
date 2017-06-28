<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/27
 * Time: 14:31
 */
class Domain_Focus
{
    public function addFocus($user_id, $uid)
    {
        $focus = new Model_Focus();
        $res = $focus->addFocus($user_id, $uid);
        return $res;
    }

    public function cancelFocus($focus_id)
    {
        $focus = new Model_Focus();
        $res = $focus->cancelFocus($focus_id);
        return $res;
    }

    public function readFocus($user_id, $uid)
    {
        $focus = new Model_Focus();
        $res = $focus->readFocus($user_id, $uid);
        return $res;
    }
}