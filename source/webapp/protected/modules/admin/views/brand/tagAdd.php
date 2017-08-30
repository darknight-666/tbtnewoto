<?php

$this->pageTitle = Yii::app()->name . ' -  TAG添加';
$this->module->params = array('title' => ' TAG添加', 'title_img' => 'fa-th', 'icon' => '');
$this->renderPartial('_formTag', array('model' => $model));
?>
