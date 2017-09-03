<?php

/**
 * 系统类
 */
class SystemController extends CustomerBaseController {

    /**
     * 发送短信验证码
     */
    public function actionSendMessageCode() {
        $this->checkParams(array('empty' => array('phonenumber', 'codeType')));
        $messageServer = new ShortMessageService();
        if ($this->params['codeType'] == MessageCodeType::$register) { // 注册
            $user = CustomerUser::model()->find('phonenumber = :phonenumber AND status=' . ShopUser::STATUS_CONFIRMED, array(':phonenumber' => $this->params['phonenumber']));
            if (!empty($user)) {
                $this->outPut('', ApiStatusCode::$error, '该手机号已被注册');
            }
        }
        if ($this->params['codeType'] == MessageCodeType::$forgetPassword || $this->params['codeType'] == MessageCodeType::$updatePassword) { // 忘记密码
            $user = ShopUser::model()->find('phonenumber = :phonenumber AND status=' . ShopUser::STATUS_CONFIRMED, array(':phonenumber' => $this->params['phonenumber']));
            if (empty($user)) {
                $this->outPut('', ApiStatusCode::$error, '暂无此手机号');
            }
        }
        $messageServer->sendMessageCode($this->params['phonenumber'], $this->params['codeType']);
        $this->outPut(array('session_id' => Yii::app()->session->SESSIONID), ApiStatusCode::$ok, '发送成功');
    }

    /**
     * 验证短信验证码
     */
    public function actionCheckMessageCode() {
        $this->checkParams(array('empty' => array('phonenumber', 'code', 'codeType')));
        $messageServer = new ShortMessageService();
        $checkCodeResult = $messageServer->checkMessageCode($this->params['phonenumber'], $this->params['code'], $this->params['codeType']);
        if ($checkCodeResult == ShortMessageService::ERROR_NONE) {
            $this->output('ok', ApiStatusCode::$ok);
        }
        if ($checkCodeResult == ShortMessageService::ERROR_CODE_INVALID) {
            $this->output('', ApiStatusCode::$error, '短信验证码错误');
        }
        if ($checkCodeResult == ShortMessageService::ERROR_CODE_TIMEOUT) {
            $this->output('', ApiStatusCode::$error, '短信验证码过期，请重新获取');
        }
    }

}
