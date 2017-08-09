<?php
$this->pageTitle = Yii::app()->name . ' - 我的信息';
$this->module->params = array('title' => '我的信息', 'title_img' => 'fa-th', 'icon' => '');
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">机构信息</h3>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.CDetailView', array(
                'data' => $model,
                'cssFile' => false,
                'htmlOptions' => array('class' => 'table-view table-striped'),
                'attributes' => array(
                        array('name' => 'id', 'value' => $model->id),
                        array('name' => 'username', 'value' => $model->username),
                        array('name' => 'realname', 'value' => $model->realname),
                        array('name' => 'phonenumber', 'value' => $model->phonenumber),
                        array('name' => 'password', 'type' => 'raw', 'value' => '<a href="/'. $this->module->getId().'/' . 'default/updatePassword" class="btn-link">密码重置</a>'),


                ),
        )); ?>
    </div>
</div>