<?php

class DefaultController extends CustomerBaseController {

    /**
     * 错误页面
     */
    public function actionError() {
        $error = Yii::app()->errorHandler->error;
        $this->output($error['code']);
    }

}
