<?php

class Model_User extends PhalApi_Model_NotORM 
{

    protected function getTableName($id) {
        return 'user';
    }

    /**
    * 手机号注册
    *
    */
    public function registerWithPhone($phone, $password) {

        $time = date('Y-m-d H:i:s',time());

        // 第一次注册用户名称也是手机号
        $data = array(
            'username' => $phone,
            'userPhone' => $phone, 
            'password' => md5($password),
            'createTime' => $time
        );

        $userORM = DI()->notorm->user;
        // 返回的结果是插入的该值
        $user = $userORM->insert($data);

        return $user;
    }

    /**
    * 登录
    *
    */
    public function login($username, $password) {
        $userORM = DI()->notorm->user;
    
        // 1. 手机号登录
        $isMobile = preg_match('/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/', $username);

        if ($isMobile) {
            $user = $userORM->where(array('user_phone' => $username, 'password' => md5($password)))->fetch();

            return $user;
        }

        // 2.邮箱登录
        $isEmail = preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i', $username);
        if ($isEmail) {
            $user = $userORM->where(array('userEmail' => $username, 'password' => md5($password)))->fetch();

            return $user;
        }

        // 3.用户名登录：不能以数字开头
        if (!$isMobile && !$isEmail) {
            $user = $userORM->where(array('username' => $username, 'password' => md5($password)))->fetch();

            return $user;
        }

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
            $data['userTruthName'] = $userTruthName;
        }
        if (!empty($userAge)) {
            $data['userAge'] = $userAge;
        }
        if (!empty($userEmail)) {
            $data['userEmail'] = $userEmail;
        }
        if (!empty($userSex)) {
            $data['userSex'] = $userSex;
        }
        if (!empty($userQQ)) {
            $data['userQQ'] = $userQQ;
        }
        if (!empty($userhoto)) {
            $data['userPhoto'] = $userPhoto;
        }

        $userORM = DI()->notorm->user;
        $user = $userORM->where('userId', $userId)->update($data);

        // int(1) //正常影响的行数
        // int(0) //无更新，或者数据没变化
        // boolean(false) //更新异常、失败
        return $user;

    }

    /**
    * 上传用户头像
    *
    */
    public function uploadUserPhoto($userId, $userPhoto)
    {
        $data = array('userPhoto' => $userPhoto);

        $userORM = DI()->notorm->user;
        $user = $userORM->where('userId', $userId)->update($data);

        return $user;
    }
}
