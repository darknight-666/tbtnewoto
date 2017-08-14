<?php
$this->pageTitle = Yii::app()->name . ' - 编辑代金券';
$this->module->params = array('title' => '编辑代金券', 'title_img' => 'fa-th', 'icon' => '');
$this->renderPartial('_form', array('model' => $model));
?>
