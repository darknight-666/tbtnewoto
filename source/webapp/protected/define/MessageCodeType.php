<?php

class MessageCodeType {

    public static $register = 1;
    public static $forgetPassword = 2;
    public static $updatePassword = 3;

    /**
     * 验证码分类对照
     * @return type
     */
    public static function items() {
        return array(
            self::$register => "用户注册",
            self::$forgetPassword => "忘记密码",
            self::$updatePassword => "修改密码",
        );
    }

    /**
     * 获取验证码分类名
     * @param type $state
     * @return type
     */
    public static function getTitle($state) {
        $item = self::items();
        return isset($item[$state]) ? $item[$state] : '';
    }

    /**
     * 验证码session中的名称对照
     * @return type 
     */
    public static function itemsSession() {
        return array(
            self::$forgetPassword => "registerCode",
            self::$forgetPassword => "forgetPasswordCode",
            self::$updatePassword => "updatePasswordCode",
        );
    }

    /**
     * 获取session中验证码的名称
     * @param type $state
     * @return type
     */
    public static function getSessionTitle($state) {
        $itemsSession = self::itemsSession();
        return isset($itemsSession[$state]) ? $itemsSession[$state] : '';
    }

}
