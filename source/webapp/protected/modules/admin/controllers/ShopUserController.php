<?php

/**
 * 商户用户管理
 */
class ShopUserController extends AdminBaseController {

    /**
     * 商户用户管理 - 列表
     */
    public function actionList() {
        $this->render('list');
    }

    /**
     * 商户用户管理 - 新增
     */
    public function actionAdd() {
        $this->render('add');
    }

    /**
     * 商户用户管理 - 编辑
     */
    public function actionUpdate() {
        $this->render('update');
    }
    
    /**
     * 商户用户管理 - 注销
     */
    public function actionDelete(){
        
    }
}
