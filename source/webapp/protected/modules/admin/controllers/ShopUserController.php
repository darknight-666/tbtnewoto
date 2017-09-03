<?php

/**
 * 商户用户管理
 */
class ShopUserController extends AdminBaseController {

    /**
     * 商户用户管理 - 列表
     */
    public function actionList() {
        $model = new ShopUser('search');
        if (isset($_GET['ShopUser'])) {
            $model->attributes = $_GET['ShopUser'];
        }
        $model->status = ShopUser::STATUS_CONFIRMED;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        $pager = $dataProvider->pagination;
        $this->render('list', array('model' => $model, 'pager' => $pager, 'list' => $list));
    }

    /**
     * 商户用户管理 - 新增
     */
    public function actionAdd() {
        $model = new ShopUser();
        if (isset($_POST['ShopUser'])) {
            $model->attributes = $_POST['ShopUser'];
            $modelOne = ShopUser::model()->find('phonenumber=:phonenumber', array(':phonenumber' => $model->phonenumber));
            if (!empty($modelOne)) {
                $model = $modelOne;
                $model->attributes = $_POST['ShopUser'];
                $model->status = ShopUser::STATUS_CONFIRMED;
                $model->reg_time = date('Y-m-d H:i:s');
            }
            $model->salt = CustomerUser::makeSalt();
            $randomPassword = substr(uniqid(rand()), -6);
            $model->password = $model->makePassword($randomPassword);
            if ($model->save()) {
                //GOTO sendMessage
                $message = new ShortMessageService;
//                $message->send($model->phonenumber, '');
                $this->redirect('/admin/shopUser/list');
            }
        }
        $this->render('add', array('model' => $model));
    }

    /**
     * 商户用户管理 - 编辑
     */
    public function actionUpdate() {
        $id = Yii::app()->request->getParam('id');
        $model = ShopUser::model()->findByPk($id);
        $model->brand_id = $model->shop->brand_id;
        if (isset($_POST['ShopUser'])) {
            $model->attributes = $_POST['ShopUser'];
            if ($model->save()) {
                $this->redirect('/admin/shopUser/list');
            }
        }
        $this->render('update', array('model' => $model));
    }

    /**
     * 商户用户管理 - 注销
     */
    public function actionDelete() {
        
    }

}
