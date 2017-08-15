<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'organization-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'smart-form'),
        ));
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">发布</h3>
    </div>
    <div class="panel-body">
        <!-- 品牌类别 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'brand_type_id', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="select">
                        <div class="select-wrap">
                            <?php
                            echo $form->dropDownList($model, 'parent_id', BrandType::getAllTopTypeByListData(), array('empty' => '请选择',
                                'ajax' => array(
                                    'url' => Yii::app()->createUrl($this->module->getId() . '/brand/GetTypeListByParentId'),
                                    'data' => array('id' => 'js:this.value'),
                                    'update' => '#Voucher_brand_type_id',
                                ),
                            ));
                            ?>
                            <div class="mb20"></div>
                        </div>
                        <div class="select-wrap ">
                            <?php
                            echo $form->dropDownList($model, 'brand_type_id', BrandType::getSonTypeByListData($model->parent_id), array('empty' => '请选择',
                                'ajax' => array(
                                    'url' => Yii::app()->createUrl($this->module->getId() . '/brand/GetAllByBrandTypeId'),
                                    'data' => array('brand_type_id' => 'js:this.value'),
                                    'update' => '#Voucher_brand_id',
                                ),
                            ));
                            ?>
                        </div>
                        <?php echo $form->error($model, 'brand_type_id'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- 选择品牌 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'brand_id', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="select">
                        <div class="select-wrap">
                            <?php
                            echo $form->dropDownList($model, 'brand_id', Brand::getAllByBrandTypeIdByListData($model->brand_type_id), array('empty' => '请选择'));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 代金券名称 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="input">
                        <?php echo $form->textField($model, 'name', array('autocomplete' => 'off', 'maxlength' => 20)); ?>
                        <?php echo $form->error($model, 'name'); ?>
                    </div>
                    <div class="sep"></div>
                    <span class="tip">最大可输入20个字</span>
                </div>
            </div>
        </div>
        <!-- 有效期至 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'overdue_time', array('class' => 'control-label', 'label' => '有效期至')); ?>
                <div class="from-control col-lg">
                    <div class="input">
                        <?php echo $form->textField($model, 'overdue_time', array('autocomplete' => 'off', 'maxlength' => 20)); ?>
                        <?php echo $form->error($model, 'overdue_time'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- 数量 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'quantity', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="input">
                        <?php echo $form->textField($model, 'quantity', array('autocomplete' => 'off', 'maxlength' => 11)); ?>
                        <?php echo $form->error($model, 'quantity'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- 优惠卷面值 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'face_value', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="input">
                        <?php echo $form->textField($model, 'face_value', array('autocomplete' => 'off', 'maxlength' => 12)); ?>
                        <?php echo $form->error($model, 'face_value'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- 价格 -->
        <!-- 优惠卷面值 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'price', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="input">
                        <?php echo $form->textField($model, 'price', array('autocomplete' => 'off', 'maxlength' => 12)); ?>
                        <?php echo $form->error($model, 'price'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- 是否为周三五折劵 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'discount_status', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="select">
                        <div class="select-wrap">
                            <?php
                            echo $form->dropDownList($model, 'discount_status', Voucher::getDiscountStatusItems(), array('empty' => '请选择'));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 使用提示 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'tips', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="textarea">
                        <?php
                        echo $form->textArea($model, 'tips', Voucher::getDiscountStatusItems(), array('cols' => 30, 'rows' => 10, 'maxlength' => 100,));
                        ?>
                    </div>
                    <div class="sep"></div>
                    <span class="tip">最大可输入300个字</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="btn-panel">
    <div class="btn-wrap">
        <?php echo CHtml::submitButton($model->isNewRecord ? '下一步' : '保存', array('class' => 'btn btn-primary submitForm')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>