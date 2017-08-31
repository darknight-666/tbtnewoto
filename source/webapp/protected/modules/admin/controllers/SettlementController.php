<?php

/**
 * 结算数据
 */
class SettlementController extends AdminBaseController {

    /**
     * 结算数据 - 列表
     */
    public function actionList() {
        $this->render('list');
    }

    /**
     * 结算数据 - 详情
     */
    public function actionDetail() {
        $this->render('detail');
    }

}
