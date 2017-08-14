<?php
$this->pageTitle = Yii::app()->name . ' - 代金券添加';
$this->module->params = array('title' => '代金券添加', 'title_img' => 'fa-th', 'icon' => '');
$this->renderPartial('_form', array('model' => $model));
?>