<?php

/**
 * User用户接口服务
 *
 * xiao
 *
 * 2017-01-04
 */
class Api_User extends PhalApi_Api
{

    public function getRules()
    {
        return array(
            'registerWithPhone' => array(
                'phone' => array('name' => 'phone', 'require' => true, 'desc' => '用户手机号'),
                'password' => array('name' => 'password', 'require' => true, 'desc' => '用户密码'),
            ),

            'login' => array(
                'username' => array('name' => 'username', 'require' => true, 'desc' => '用户名'),
                'password' => array('name' => 'password', 'require' => true, 'desc' => '用户密码'),
            ),

            'uploadUserPhoto' => array(
                'user_photo' => array('name' => 'user_photo', 'type' => 'file', 'min' => 0, 'require' => true, 'max' => 2 * 1024 * 1024,
                    'range' => array('image/jpg', 'image/jpeg', 'image/png'), 'ext' => array('jpg', 'jpeg', 'png')
                )
                // 为什么这里不行？
                // 'user_id' => array('name' => 'user_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID');
            ),

            'updateUserInfo' => array(
                'userId' => array('name' => 'user_id', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
                'userName' => array('name' => 'username', 'default' => '', 'require' => false, 'desc' => '用户名称'),
                'userTruthName' => array('name' => 'user_truth_name', 'default' => '', 'require' => false, 'desc' => '用户真实名字'),
                'userAge' => array('name' => 'user_age', 'default' => '', 'require' => false, 'desc' => '用户年龄'),
                'userEmail' => array('name' => 'user_email', 'default' => '', 'require' => false, 'desc' => '用户邮箱'),
                'userSex' => array('name' => 'user_sex', 'default' => '', 'require' => false, 'desc' => '用户性别'),
                'userQQ' => array('name' => 'user_qq', 'default' => '', 'require' => false, 'desc' => '用户QQ'),
                'userPhoto' => array('name' => 'user_photo', 'default' => '', 'require' => false, 'desc' => '用户头像'),
            ),
        );

    }

    /**
     * 用户注册
     * @desc 只能使用手机号注册
     * @return int code 提示码，10001:注册失败，10000注册成功
     * @return string info 提示
     * @return string phone 手机号
     * @return string password 密码
     * @return string create_time 注册时间
     * @return int userId 用户id
     *
     * http://localhost/Sky/Public/?service=User.RegisterWithPhone&phone=15XXXXXXXXX&password=123456
     *
     */
    public function registerWithPhone()
    {
        $domain = new Domain_User();
        // 返回的是一个数组
        $res = $domain->registerWithPhone($this->phone, $this->password);

        if (empty($res)) {
            $res['code'] = 10001;
            $res['info'] = '注册失败';
        } else {
            $res['code'] = 10000;
            $res['info'] = '注册成功';
        }

        return $res;

    }

    /**
     * 登录接口
     * @desc 可以用手机号、邮箱、用户名登录
     * @return int code 10001:登录失败,10000:登录成功
     * @return string info 提示信息
     * @return int userId 用户id
     *
     * http://localhost/Sky/Public/?service=User.Login&username=15XXXXXXXXX&password=123456
     *
     */
    public function login()
    {
        $rs = array('code' => 0, 'info' => '', 'user' => '');

        $domain = new Domain_User();
        $user = $domain->login($this->username, $this->password);

        if ($user === false) {
            $rs['code'] = 10001;
            $rs['info'] = '登录失败，用户名错误或密码错误';
            $rs['user'] = '';
            return $rs;
        } else {
            $rs['code'] = 0;
            $rs['info'] = '登录成功';
            $rs['user'] = $user;
            return $rs;
        }
    }

    /**
     * 用户头像上传接口
     * @desc上传用户头像图片
     * @return int code 0:数据无更新，10001：更新成功，10002：更新失败
     * @return string imgUrl 图片地址
     * @return string info 提示信息
     *
     * http://localhost/Sky/Public/?service=User.UploadUserPhoto
     *
     */
    public function uploadUserPhoto()
    {
        $res = array('code' => 0, 'info' => '', 'imgUrl' => '');

        //设置上传路径:年/月/日
        DI()->ucloud->set('save_path', 'image/'.date('Ymd'));
        //新增修改文件名设置上传的文件名称
//         DI()->ucloud->set('file_name', 'avatar');
        //上传表单名：返回文件信息
        $file = DI()->ucloud->upfile($this->user_photo);

        $res['imgUrl'] = $file['file'];

        // 更新用户信息：只有用户头像改变
        $userId = $_POST['user_id'];
        $domain = new Domain_User();
        $row = $domain->uploadUserPhoto($userId, $file['file']);

        // $user_id = $this->user_id;
        // DI()->logger->debug('表单中获取的user_id=', $user_id);

        if ($row > 0) {
            $res['code'] = 0;
            $res['info'] = '上传成功';
        } elseif ($row == 0) {
            $res['code'] = 10001;
            $res['info'] = '上传无更新';
        } elseif ($row === false) {
            $res['code'] = 10002;
            $res['code'] = -1;
            $res['info'] = '上传失败';
        }

        return $res;
    }

    /**
     * 更新用户信息
     * @desc 更新用户信息:需要重写接口
     * @return int code 0:数据无更新，1：更新成功，-1：更新失败
     * @return string info 提示信息
     */
    public function updateUserInfo()
    {
        $res = array('code' => 0, 'info' => '');
        $domain = new Domain_User();
        $row = $domain->updateUserInfo($this->userId, $this->userName, $this->userTruthName, $this->userAge, $this->userEmail, $this->userSex, $this->userQQ, $this->userPhoto);

        $res['code'] = $row;
        if ($row > 0) {
            $res['info'] = '更新成功';
        } elseif ($row == 0) {
            $res['info'] = '数据无更新';
        } elseif ($row === flase) {
            $res['code'] = -1;
            $res['info'] = '更新失败';
        }

        return $res;
    }
}
