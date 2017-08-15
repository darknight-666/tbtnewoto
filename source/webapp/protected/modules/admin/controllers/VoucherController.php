<?php

/**
 * 代金券类
 */
class VoucherController extends AdminBaseController {

    /**
     * 代金券 - 添加
     */
    public function actionAdd() {
        $model = new Voucher();
        $menu = Yii::app()->request->getParam('menu');
        if (isset($_POST['Voucher'])) {
            $model->attributes = $_POST['Voucher'];
            if ($model->save()) {
                $this->redirect('/admin/voucher/addShop/menu/' . $menu . '/voucher_id/' . $model->voucher_id);
            }
        }
        $this->render('add', array('model' => $model));
    }

    /**
     * 代金券 - 编辑
     */
    public function actionUpdate() {
        $id = Yii::app()->request->getParam('id');
        $model = Voucher::model()->findByPk($id);
        if (isset($_POST['Voucher'])) {
            $model->attributes = $_POST['Voucher'];
            if ($model->save()) {
                $this->redirect('/admin/voucher/list');
            }
        }
        $this->render('update', array('model' => $model));
    }

    /**
     * 代金券 - 详情
     */
    public function actionDetail() {
        $this->render('detail');
    }

    /**
     * 代金券 - 关联门店
     */
    public function actionAddShop() {
        $voucherId = Yii::app()->request->getParam('voucher_id');
        $model = new VoucherShopRelation();
        $model->voucher_id = $voucherId;
        $model->shopIds = VoucherShopRelation::getAllByVoucherIdByArray($model->voucher_id);
        $modelVoucher = Voucher::model()->findByPk($voucherId);
        if (isset($_POST['VoucherShopRelation'])) {
            $model->attributes = $_POST['VoucherShopRelation'];
            if ($model->validate()) {
                $model->deleteAll('voucher_id=:voucher_id', array(':voucher_id' => $model->voucher_id));
                foreach ($model->shopIds as $shopId) {
                    $model->isNewRecord = TRUE;
                    $model->shop_id = $shopId;
                    $model->save();
                }
                $this->redirect('/admin/voucher/list');
            }
        }
        $this->render('addShop', array('model' => $model, 'modelVoucher' => $modelVoucher));
    }

    /**
     * 代金券 - 删除 - Ajax
     */
    public function actionDelete() {
        $this->render('delete');
    }

    /**
     * 代金券 - 列表
     */
    public function actionList() {
        $model = new Voucher('search');
        if (isset($_GET['Voucher'])) {
            $model->attributes = $_GET['Voucher'];
        }
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        $pager = $dataProvider->pagination;
        $this->render('list', array('model' => $model, 'pager' => $pager, 'list' => $list));
    }

    /**
     * 代金券 - 上线/下线 - Ajax
     */
    public function actionUpdateStatus() {
        $this->render('updateStatus');
    }

}
