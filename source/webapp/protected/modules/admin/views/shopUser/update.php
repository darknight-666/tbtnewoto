<?php

$this->pageTitle = Yii::app()->name . ' - 商户账户编辑账号';
$this->module->params = array('title' => '商户账户编辑账号', 'title_img' => 'fa-th', 'icon' => '');
$this->renderPartial('_form', array('model' => $model));
?>