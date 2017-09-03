<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'organization-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'smart-form'),
        ));
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">商户账号管理 </h3>
    </div>
    <div class="panel-body">
        <!--品牌-->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'brand_id', array('class' => 'control-label')); ?>
                <div class="from-control">
                    <div class="select">
                        <div class="select-wrap">
                            <?php
                            echo $form->dropDownList($model, 'brand_id', Brand::getAllByListData(), array('empty' => '请选择',
                                'ajax' => array(
                                    'url' => Yii::app()->createUrl($this->module->getId() . '/brand/getShopListByBrandId'),
                                    'data' => array('brand_id' => 'js:this.value'),
                                    'update' => '#ShopUser_shop_id',
                                ),
                            ));
                            ?>
                        </div>
                        <?php echo $form->error($model, 'brand_id'); ?>
                    </div>
                </div>
            </div>
            <!--门店-->
            <div class="section">
                <div class="from-group">
                    <?php echo $form->labelEx($model, 'shop_id', array('class' => 'control-label')); ?>
                    <div class="from-control">
                        <div class="select">
                            <div class="select-wrap">
                                <?php
                                echo $form->dropDownList($model, 'shop_id', Shop::getAllByBrandIdbyListData($model->brand_id), array('empty' => '请选择'));
                                ?>
                            </div>
                            <?php echo $form->error($model, 'shop_id'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--账号(手机号)：-->
            <div class="section">
                <div class="from-group">
                    <?php echo $form->labelEx($model, 'phonenumber', array('class' => 'control-label', 'label' => '账号(手机号)')); ?>
                    <div class="from-control">
                        <div class="input">
                            <?php echo $form->textField($model, 'phonenumber', array('maxlength' => 11)) ?>
                            <?php echo $form->error($model, 'phonenumber'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="btn-panel">
    <div class="btn-wrap">
        <input class="btn btn-primary" id="submit_form" name="yt0" value="添加" type="submit"></div>
</div>
<?php $this->endWidget(); ?>