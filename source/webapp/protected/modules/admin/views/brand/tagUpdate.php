<?php

$this->pageTitle = Yii::app()->name . ' -  TA编辑';
$this->module->params = array('title' => ' TA编辑', 'title_img' => 'fa-th', 'icon' => '');
$this->renderPartial('_formTag', array('model' => $model));
?>
