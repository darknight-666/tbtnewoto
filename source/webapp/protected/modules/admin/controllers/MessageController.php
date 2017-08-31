<?php

/**
 * 消息管理
 */
class MessageController extends AdminBaseController {

    /**
     * 消息管理 - 列表
     */
    public function actionList() {
        $this->render('list');
    }

    /**
     * 消息管理 - 新增
     */
    public function actionAdd() {
        $this->render('add');
    }

    /**
     * 消息管理 - 删除
     */
    public function actionDelete() {
        
    }

}
