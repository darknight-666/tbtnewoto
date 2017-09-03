<?php

/**
 * 订单类
 */
class OrderController extends AdminBaseController {

    /**
     * 代金券订单 - 列表
     */
    public function actionList() {
        $model = new Order('search');
        if (isset($_GET['Order'])) {
            $model->attributes = $_GET['Order'];
        }
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        $pager = $dataProvider->getPagination();
        $this->render('list', array('model' => $model, 'list' => $list, 'pager' => $pager));
    }

    /**
     * 代金券订单 - 详情
     */
    public function actionDetail() {
        $this->render('detail');
    }

}
