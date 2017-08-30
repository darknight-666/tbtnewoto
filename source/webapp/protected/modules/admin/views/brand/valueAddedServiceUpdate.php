<?php

$this->pageTitle = Yii::app()->name . ' -  增值服务编辑';
$this->module->params = array('title' => ' 增值服务编辑', 'title_img' => 'fa-th', 'icon' => '');
$this->renderPartial('_formValueAddedService', array('model' => $model));
?>
