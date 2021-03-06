<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class ShopUserIdentity extends CUserIdentity {

    public $user;
    private $_id;

    public function authenticate() {
        $user = ShopUser::model()->find('(LOWER(username)=:username OR phonenumber=:username) AND status=' . ShopUser::STATUS_CONFIRMED, array(':username' => strtolower($this->username)));
        if ($user == NULL) { // username error
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if (!$user->checkPassword($this->password)) { // password error
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            //更新最后登录时间
            $user->last_login_time = date('Y-m-d H:i:s');
            $user->save();

            // 设置缓存
            $this->setUser($user);
            $this->setState('id', $user->id);
            $this->setState('phonenumber', $user->phonenumber);
            $this->_id = $user->id;
            $this->username = $user->username;
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
