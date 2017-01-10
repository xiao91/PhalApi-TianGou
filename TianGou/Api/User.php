<?php

class Api_User extends PhalApi_Api {

    public function getRules() {
        return array(
            'registerWithPhone' => array(
                'phone' =>array('name' => 'phone', 'require' => true, 'desc' => '用户手机号'),
                'password' =>array('name' => 'password', 'require' => true, 'desc' => '用户密码'),
            ),

            'login' => array(
                'username' =>array('name' => 'username', 'require' => true, 'desc' => '用户名'),
                'password' =>array('name' => 'password', 'require' => true, 'desc' => '用户密码'),
            ),

            'uploadUserPhoto' => array(
                'file' => array('name' => 'file', 'type' => 'file', 'min' => 0, 'max' => 1024 * 1024, 'range' => array('image/jpg', 'image/jpeg', 'image/png'), 'ext' => array('jpg', 'jpeg', 'png')
                )
            ),

            'updateUserInfo' =>array(
                'userId' => array('name' => 'userId', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
                'userName' => array('name' => 'userName', 'default' => '', 'require' => false, 'desc' => '用户名称'),
                'userTruthName' => array('name' => 'userTruthName', 'default' => '', 'require' => false, 'desc' => '用户真实名字'),
                'userAge' => array('name' => 'userAge', 'default' => '', 'require' => false, 'desc' => '用户年龄'),
                'userEmail' => array('name' => 'userEmail', 'default' => '', 'require' => false, 'desc' => '用户邮箱'),
                'userSex' => array('name' => 'userSex', 'default' => '', 'require' => false, 'desc' => '用户性别'),
                'userQQ' => array('name' => 'userQQ', 'default' => '', 'require' => false, 'desc' => '用户QQ'),
                'userPhoto' => array('name' => 'userPhoto', 'default' => '', 'require' => false, 'desc' => '用户头像'),
            ),
        );
        
    }

    /**
    * 手机号注册 
    *
    *
    */
    public function registerWithPhone()
    {
        $rs = array('code' => 0, 'info' => '');

        $domain = new Domain_User();
        $ret = $domain->registerWithPhone($this->phone, $this->password);

        if (empty($ret)) {
            $rs['code'] = 10001;
            $rs['info'] = '注册失败';
            return $rs;
        }else {
            $rs['code'] = 10000;
            $rs['info'] = '注册成功';
            return $rs;
        }

    }

    /**
    * 登录：手机号+邮箱+用户名
    *
    */
    public function login()
    {
        $rs = array('code' => 0, 'info' => '', 'userId' => 0);

        $domain = new Domain_User();
        $user = $domain->login($this->username, $this->password);
       
        DI()->logger->debug('上传图片的信息=', $user);

        if (empty($user)) {
            $rs['code'] = 10001;
            $rs['info'] = '登录失败，用户名错误或密码错误';
            return $rs;
        }else {
            $rs['userId'] = $user['user_id'];
            $rs['code'] = 10000;
            $rs['info'] = '登录成功';
            return $rs;
        }
    }

    /**
     * 上传用户头像
     * @return string $url 绝对路径
     * @return string $file 相对路径，用于保存至数据库
     * @return int $code code
     * @return string 说明
     */
    public function uploadUserPhoto()
    {
        //设置上传路径:年/月/日
        DI()->ucloud->set('save_path', date('Ymd'));
        //新增修改文件名设置上传的文件名称
        // DI()->ucloud->set('file_name', 'avatar');
        //上传表单名
        $res = DI()->ucloud->upfile($this->file);

        // 更新用户信息：只有用户头像改变
        $userId = $_POST['userId'];
        $domain = new Domain_User();
        $user = $domain->uploadUserPhoto($userId, $res['file']);

        if ($user > 0) {
            $res['code'] = 10000;
            $res['info'] = '上传成功';
        }else{
            $res['code'] = 10001;
            $res['info'] = '上传失败';

        }

        return $res;
    }

     /**
     * 更新用户信息
     * @return string $url 绝对路径
     * @return string $file 相对路径，用于保存至数据库
     */
    public function updateUserInfo()
    {
        $domain = new Domain_User();
        $user = $domain->updateUserInfo($this->userId, $this->userName, $this->userTruthName, $this->userAge, $this->userEmail, $this->userSex, $this->userQQ, $this->userPhoto);

        // int(1) //正常影响的行数
        // int(0) //无更新，或者数据没变化
        // boolean(false) //更新异常、失败
        return $user;
    }
}
