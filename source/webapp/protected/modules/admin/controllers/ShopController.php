<?php

/**
 * 门店类
 */
class ShopController extends AdminBaseController {

    /**
     * ********************* 门店 *********************
     * 门店 - 添加
     */
    public function actionAdd() {
        $this->render('add');
    }

    /**
     * 门店 - 编辑
     */
    public function actionUpdate() {
        $this->render('update');
    }

    /**
     * 门店 - 删除
     */
    public function actionDelete() {
        
    }

    /**
     * 门店 - 列表
     */
    public function actionList() {
        $this->render('list');
    }

}
