<?php

$this->pageTitle = Yii::app()->name . ' - 创建品牌';
$this->module->params = array('title' => '创建品牌', 'title_img' => 'fa-th', 'icon' => '');
$this->renderPartial('_form', array('model' => $model));
?>