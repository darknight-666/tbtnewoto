<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'organization-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'smart-form'),
        ));
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">创建门店</h3>
    </div>
    <div class="panel-body">

        <!-- 门店名称 -->
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

        <!-- 门店电话 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'phonenumber', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="input">
                        <?php echo $form->textField($model, 'phonenumber', array('autocomplete' => 'off', 'maxlength' => 20)); ?>
                        <?php echo $form->error($model, 'phonenumber'); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- 所在地区 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_course_type_id">所在地区<span class="required">*</span></label>
                <div class="from-control col-lg">
                    <div class="select">
                        <div class="select-wrap">
                            <?php
                            echo $form->dropDownList($model, 'province_adcode', Map::getAllProvinceByListData(), array('empty' => '请选择',
                                'ajax' => array(
                                    'url' => Yii::app()->createUrl($this->module->getId() . '/map/GetCityListByProvinceId'),
                                    'data' => array('adcode' => 'js:this.value'),
                                    'update' => '#Shop_city_adcode',
                                )
                            ))
                            ?>
                        </div>
                        <?php echo $form->error($model, 'province_adcode'); ?>
                    </div>
                    <div class="sep"></div>
                    <div class="select">
                        <div class="select-wrap">
                            <?php
                            echo $form->dropDownList($model, 'city_adcode', Map::getAllCityByProvinceIdByListData($model->province_adcode), array('empty' => '请选择',
                                'ajax' => array(
                                    'url' => Yii::app()->createUrl($this->module->getId() . '/map/GetDistrictListByCityId'),
                                    'data' => array('adcode' => 'js:this.value'),
                                    'update' => '#Shop_district_adcode',
                                )
                            ))
                            ?>
                        </div>
                        <?php echo $form->error($model, 'city_adcode'); ?>
                    </div>
                    <div class="sep"></div>
                    <div class="select">
                        <div class="select-wrap">
                            <?php
                            echo $form->dropDownList($model, 'district_adcode', Map::getAllDistrictByCityIdByListData($model->city_adcode), array('empty' => '请选择',
                                'ajax' => array(
                                    'url' => Yii::app()->createUrl($this->module->getId() . '/map/GetBusinessCenterListByDistrictId'),
                                    'data' => array('adcode' => 'js:this.value'),
                                    'update' => '#Shop_business_center_id',
                                )
                            ))
                            ?>
                        </div>
                        <?php echo $form->error($model, 'district_adcode'); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- 商圈 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'business_center_id', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="select">
                        <div class="select-wrap">
                            <?php echo $form->dropDownList($model, 'business_center_id', BusinessCenter::getAllByDistrictIdByListData($model->district_adcode), array('empty' => '请选择')) ?>
                        </div>
                        <?php echo $form->error($model, 'business_center_id'); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- 具体地址 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'address', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="input">
                        <?php echo $form->textField($model, 'address', array('autocomplete' => 'off', 'maxlength' => 200)); ?>
                        <?php echo $form->error($model, 'address'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!--精度-->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'location_x', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="input">
                        <?php echo $form->textField($model, 'location_x', array('autocomplete' => 'off', 'maxlength' => 200)); ?>
                        <?php echo $form->error($model, 'location_x'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- 维度 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'location_y', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="input">
                        <?php echo $form->textField($model, 'location_y', array('autocomplete' => 'off', 'maxlength' => 200)); ?>
                        <?php echo $form->error($model, 'location_y'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- 地图 -->
        <div class="section">
            <div class="from-group">
                <div class="file-show">
                    <div class="uploadlogo" ><img src="#"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="btn-panel">
    <div class="btn-wrap">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存', array('class' => 'btn btn-primary submitForm')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>