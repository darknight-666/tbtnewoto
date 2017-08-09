<?php

class DefaultController extends AdminBaseController {

    /**
     * 后台登陆
     */
    public function actionLogin() {
        $this->layout = FALSE;
        $model = new FormAdminLogin();
        if (isset($_REQUEST['FormAdminLogin'])) {
            $model->attributes = $_REQUEST['FormAdminLogin'];
            if ($model->validate() && $model->login()) {
                $this->redirect('/admin/default/index');
            }
        }
        $this->render('login', array('model' => $model));
    }

    /**
     * 后台首页
     */
    public function actionIndex() {
        if (Yii::app()->user->isGuest) {
            $this->redirect('/admin/default/login');
        }
        $model = Admin::model()->findByPk(Yii::app()->user->id);
        $this->render('index', array('model' => $model));
    }

    /**
     * 退出登录
     */
    public function actionLogout() {
        if (Yii::app()->user->isGuest) {
            $this->redirect('/admin/default/login');
        }
        Yii::app()->user->logout(FALSE);
        $this->redirect('/admin/default/login');
    }

    /**
     * 错误页面
     */
    public function actionError() {
        $error = Yii::app()->errorHandler->error;
        $this->render('error', array('code' => $error['code']));
    }

}
