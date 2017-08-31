<?php
$this->pageTitle = Yii::app()->name . ' - 代金券设置门店';
$this->module->params = array('title' => '代金券设置门店', 'title_img' => 'fa-th', 'icon' => '');
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'organization-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'smart-form'),
        ));
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">适用门店</h3>
    </div>
    <div class="panel-body">

        <!-- 全部 -->
        <div class="section">
            <div class="from-group">
                <div class="from-control col-lg">
                    <div>
                        <?php
                        echo $form->checkBoxList($model, 'shopIds', Shop::getAllByBrandIdbyListData($modelVoucher->brand_id), array(
                            'class' => 'proxyList',
                            'separator' => '',
                            'checkAll' => '全部',
                            'container' => 'ul class="role-list"',
                            'template' => '<li class ="item">{input}{label}</li>',
                            'labelOptions' => array('style' => 'display:inline;', 'class' => 'pointname')));
                        ?>
                        <?php echo $form->error($model, 'shopIds'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="btn-panel">
    <div class="btn-wrap">
        <?php echo CHtml::submitButton('发布代金券', array('class' => 'btn btn-primary submitForm')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>

