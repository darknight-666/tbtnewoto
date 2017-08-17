<?php

/**
 * Customer-User类
 */
class UserController extends CustomerBaseController {

    /**
     * 用户注册
     */
    public function actionRegister() {
        $this->checkParams(array('empty' => array('phonenumber', 'password', 'code')));
        $model = new CustomerUser('register');
        $model->attributes = $this->params;
        $model->salt = CustomerUser::makeSalt();
        $model->password = $model->makePassword($model->password);
        if ($model->save()) {
            $this->actionLogin();
        } else {
            $this->output('', ApiStatusCode::$registerFailed, My::getModelErrors($model->errors));
        }
    }

    /**
     * 登录
     */
    public function actionLogin() {
        $this->checkParams(array('empty' => array('phonenumber', 'password')));
        $this->params['username'] = $this->params['phonenumber'];
        $model = new FormCustomerUserLogin();
        $model->attributes = $this->params;
        if ($model->validate() && $model->login()) {
            $this->params['id'] = Yii::app()->user->id;
            $this->actionInfo();
        } else {
            $this->output('', ApiStatusCode::$loginFailed, My::getModelErrors($model->errors));
        }
    }

    /**
     * 用户详情
     */
    public function actionInfo() {
        $this->checkLogin();
        $this->checkParams(array('empty' => array('id')));
        $model = CustomerUser::model()->findByPk($this->params['id']);
        $data = array(
            'id' => $model->id,
            'username' => $model->username,
            'phonenumber' => $model->phonenumber,
            'reg_time' => $model->reg_time,
            'last_login_time' => $model->last_login_time,
            'session_id' => Yii::app()->session->SESSIONID,
        );
        $this->output($data);
    }

}
