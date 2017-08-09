<?php

class AdminUserIdentity extends CUserIdentity {

    public $user;
    private $_id;

    public function authenticate() {
        $admin = Admin::model()->find('LOWER(username)=:username', array(':username' => strtolower($this->username)));
        if ($admin == NULL) { // username error
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if (!$admin->checkPassword($this->password)) { // password error
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            //更新最后登录时间
            $admin->last_login_time = date('Y-m-d H:i:s');
            $admin->save();

            // 设置缓存
            $this->setUser($admin);
            $this->setState('id', $admin->id);
            $this->_id = $admin->id;
            $this->username = $admin->username;
            $this->errorCode = self::ERROR_NONE;
        }
        return $this->errorCode == self::ERROR_NONE;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser(CActiveRecord $user) {
        $this->user = $user->attributes;
    }

    //必须返回id，不能返回usrName  
    public function getId() {
        return $this->_id;
    }

}
