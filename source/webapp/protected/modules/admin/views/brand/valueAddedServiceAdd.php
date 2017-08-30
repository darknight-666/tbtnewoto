<?php

$this->pageTitle = Yii::app()->name . ' -  增值服务添加';
$this->module->params = array('title' => ' 增值服务添加', 'title_img' => 'fa-th', 'icon' => '');
$this->renderPartial('_formValueAddedService', array('model' => $model));
?>
