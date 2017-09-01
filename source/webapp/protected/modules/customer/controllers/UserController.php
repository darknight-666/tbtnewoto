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
     * 退出登录
     */
    public function actionLogout() {
        Yii::app()->user->logout(FALSE);
        $this->output('ok');
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

    /**
     * 忘记密码 - 修改密码
     */
    public function actionForgetPassword() {
        $this->checkParams(array('empty' => array('phonenumber', 'code', 'password')));
        $model = CustomerUser::model()->find('phonenumber = :phonenumber', array(':phonenumber' => $this->params['phonenumber']));
        if (is_null($model)) {
            $this->output('', ApiStatusCode::$error, '该手机号不存在');
        }
        $model->setScenario('forgetPassword');
        $model->attributes = $this->params;
        $model->salt = CustomerUser::makeSalt();
        $model->password = $model->makePassword($model->password);
        if ($model->save()) {
            $this->output('ok');
        }
        $this->output('', ApiStatusCode::$error, My::getModelErrors($model->errors));
    }

    /**
     * 修改密码
     */
    public function actionChangePassword() {
        $this->checkLogin();
        $this->checkParams(array('empty' => array('oldPassword', 'newPassword')));
        $model = CustomerUser::model()->findByPk(Yii::app()->user->id);
        if (is_null($model)) {
            $this->output('', ApiStatusCode::$error, '该用户不存在');
        }
        $model->setScenario('changePassword');
        $model->attributes = $this->params;
        if ($model->validate()) {
            $model->salt = CustomerUser::makeSalt();
            $model->password = $model->makePassword($model->newPassword);
            $model->update(); // 此处用update 是为了不再作validate 验证
            $this->output('ok');
        }
        $this->output('', ApiStatusCode::$error, My::getModelErrors($model->errors));
    }

}
