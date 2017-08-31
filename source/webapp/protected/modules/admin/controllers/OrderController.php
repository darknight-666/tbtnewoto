<?php

/**
 * 订单类
 */
class OrderController extends AdminBaseController {

    /**
     * 代金券订单 - 列表
     */
    public function actionList() {
        $this->render('list');
    }

    /**
     * 代金券订单 - 详情
     */
    public function actionDetail() {
        $this->render('detail');
    }

}
