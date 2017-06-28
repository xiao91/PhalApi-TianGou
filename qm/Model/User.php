<?php

class Model_User extends PhalApi_Model_NotORM
{

    protected function getTableName($id)
    {
        return 'user';
    }

    /**
     * 手机号注册
     *
     */
    public function registerWithPhone($phone, $password)
    {
        // -1为失败
        $res = array('code' => -1, 'info' => '');

        $userORM = DI()->notorm->user;
        // 查询不匹配返回false
        $user = $userORM->where(array('user_phone' => $phone))->fetch();
        if (empty($user)) {
            $time = date('Y-m-d H:i:s', time());

            $data = array(
                'user_phone' => $phone,
                'password' => md5($password),
                'user_register_time' => $time
            );

            // 返回的结果是插入的该值和该用户id的数组
            $user = $userORM->insert($data);

            if (empty($user)) {
                $res['code'] = -2;
                $res['info'] = '服务器出错，请重新注册';
            } else {
                $res['code'] = 0;
                $res['info'] = '注册成功';
            }

            return $res;
        } else {
            $res['code'] = -1;
            $res['info'] = '该手机号码已被注册，请直接登录或找回密码';
            return $res;
        }
    }

    /**
     * 登录
     *
     */
    public function login($username, $password, $device_id, $is_line = false, $mobile_type)
    {
        // -1为失败
        $res = array('code' => -1, 'info' => '', 'token' => '', 'user_id' => 0);

        $userORM = DI()->notorm->user;
        // 查询不匹配返回null
        $user_name = $userORM->where(array('user_phone' => $username))->fetch();
        if (empty($user_name)) {
            $res['code'] = -1;
            $res['info'] = "登录失败，该手机号未注册或不正确";
            return $res;
        }

        // 查询不匹配返回null
        $user_password = $userORM->where(array('password' => md5($password)))->fetch();
        if (empty($user_password)) {
            $res['code'] = -2;
            $res['info'] = "登录失败，密码不正确";
            return $res;
        }

        $tokenORM = DI()->notorm->token;
        // md5加密token
        $md5Token = md5($username . $password);
        // 如果没有返回false
        $tokenMD5 = $tokenORM->where(array('token' => $md5Token))->fetch();

        if (empty($tokenMD5)) {
            $data = array(
                'token' => $md5Token,
                'device_code' => $device_id,
                'mobile_type' => $mobile_type,
            );
            $token = $tokenORM->insert($data);
            $id = $tokenORM->insert_id();

            if ($id > 0) {
                $res['code'] = 0;
                $res['info'] = "登录成功";
                $res['token'] = $token['token'];
                $res['user_id'] = $user_name['user_id'];
            } else {
                $res['code'] = -4;
                $res['info'] = "登录失败，保存token失败，请重新登录";
            }
        }else {
            if ($device_id == $tokenMD5['device_code']) {
                $res['code'] = 0;
                $res['info'] = "登录成功";
                $res['token'] = $tokenMD5['token'];
                $res['user_id'] = $user_name['user_id'];
            }else {
                // 需要强制下线时，删除token对应的值
                if ($is_line) {
                    $t = $tokenMD5 -> where('token', $md5Token);
                    if (!empty($t)) {
                        $tokenMD5-> where('token', $md5Token) -> delete();
                    }
                }else {
                    $res['code'] = -3;
                    $res['info'] = '已在另一个'.$tokenMD5['mobile_type'].'移动设备上登录，请确认是否需要强制下线，如果需要，请重新登录，并加isLine标识';
                }
            }
        }

        return $res;
    }

    /**
     * 保存用户信息
     *
     */
    public function updateUserInfo($userId, $userName, $userTruthName, $userAge, $userEmail, $userSex, $userQQ, $userPhoto)
    {
        $data = array();

        if (!empty($userName)) {
            $data['username'] = $userName;
        }
        if (!empty($userTruthName)) {
            $data['user_truth_name'] = $userTruthName;
        }
        if (!empty($userAge)) {
            $data['user_age'] = $userAge;
        }
        if (!empty($userEmail)) {
            $data['user_email'] = $userEmail;
        }
        if (!empty($userSex)) {
            $data['user_sex'] = $userSex;
        }
        if (!empty($userQQ)) {
            $data['user_qq'] = $userQQ;
        }
        if (!empty($userhoto)) {
            $data['user_photo'] = $userPhoto;
        }

        $userORM = DI()->notorm->user;
        $row = $userORM->where('user_id', $userId)->update($data);

        // int(1) //正常影响的行数
        // int(0) //无更新，或者数据没变化
        // boolean(false) //更新异常、失败
        return $row;

    }

    /**
     * 上传用户头像
     *
     */
    public function uploadUserPhoto($userId, $userPhoto)
    {
        $data = array('user_photo' => $userPhoto);

        $userORM = DI()->notorm->user;
        $user = $userORM->where('user_id', $userId)->update($data);

        // 没有删除原来的图片

        return $user;
    }
}
