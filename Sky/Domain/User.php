<?php

class Domain_User {
    
    /**
    * 手机号注册
    *
    */
    public function registerWithPhone($phone, $password)
    {
        $model = new Model_User();
        $user = $model->registerWithPhone($phone, $password);
        return $user;
    }

    /**
    * 登录
    *
    */
    public function login($username, $password)
    {
        $model = new Model_User();
        $user = $model->login($username, $password);
        return $user;
    }

    /**
    * 更新用户信息
    *
    */
    public function updateUserInfo($userId, $userName, $userTruthName, $userAge, $tuserEmail, $userSex, $userQQ, $userPhoto)
    {
        $model = new Model_User();
        $user = $model->updateUserInfo($userId, $userName, $userTruthName, $userAge, $tuserEmail, $userSex, $userQQ, $userPhoto);
        return $user;
    }

    /**
    * 上传用户头像
    *
    */
    public function uploadUserPhoto($userId, $userPhoto)
    {
        $model = new Model_User();
        $user = $model->uploadUserPhoto($userId, $userPhoto);
        return $user;
    }
    
}
