<?php

/**
 * 品牌类
 */
class BrandController extends AdminBaseController {

    /**
     * ********************* 品牌分类 *********************
     * 品牌分类 - 添加
     */
    public function actionTypeAdd() {
        
    }

    /**
     * 品牌分类 - 编辑
     */
    public function actionTypeUpdate() {
        
    }

    /**
     * 品牌分类 - 删除 - Ajax
     */
    public function actionTypeDelete() {
        
    }

    /**
     * 品牌分类 - 列表
     */
    public function actionTypeList() {
        $this->render('typeList');
    }

    /**
     * ********************* 品牌 *********************
     * 品牌 - 添加
     */
    public function actionAdd() {
        $this->render('add');
    }

    /**
     * 品牌 - 编辑
     */
    public function actionUpdate() {
        $this->render('update');
    }

    /**
     * 品牌 - 删除 - Ajax
     */
    public function actionDelete() {
        
    }

    /**
     * 品牌 - 列表
     */
    public function actionList() {
        $this->render('list');
    }

    /**
     * 品牌 - 详情
     */
    public function actionDetail() {
        $this->render('detail');
    }

}
