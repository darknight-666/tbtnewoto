<?php

/**
 * 代金券类
 */
class VoucherController extends AdminBaseController {

    /**
     * 代金券 - 添加
     */
    public function actionAdd() {
        $this->render('add');
    }

    /**
     * 代金券 - 编辑
     */
    public function actionUpdate() {
        $this->render('update');
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
        $this->render('addShop');
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
        $this->render('list');
    }

    /**
     * 代金券 - 上线/下线 - Ajax
     */
    public function actionUpdateStatus() {
        $this->render('updateStatus');
    }

}
