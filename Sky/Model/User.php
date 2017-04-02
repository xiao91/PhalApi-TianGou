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

        $time = date('Y-m-d H:i:s', time());

        // 第一次注册用户名称也是手机号
        $data = array(
            'user_phone' => $phone,
            'password' => md5($password),
            'create_time' => $time
        );

        $userORM = DI()->notorm->user;
        // 返回的结果是插入的该值和该用户的id
        $user = $userORM->insert($data);

        return $user;
    }

    /**
     * 登录
     *
     */
    public function login($username, $password)
    {
        $userORM = DI()->notorm->user;
        // 查询不匹配返回false
        $user = $userORM->where(array('user_phone' => $username, 'password' => md5($password)))->fetch();
        return $user;

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
