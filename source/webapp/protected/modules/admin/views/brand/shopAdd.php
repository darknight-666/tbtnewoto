<?php

$this->pageTitle = Yii::app()->name . ' - 门店添加';
$this->module->params = array('title' => '门店添加', 'title_img' => 'fa-th', 'icon' => '');
$this->renderPartial('_formShop', array('model' => $model));
?>
