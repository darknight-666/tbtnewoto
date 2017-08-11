<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'organization-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'smart-form'),
));
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">创建品牌</h3>
    </div>
    <div class="panel-body">
        <!-- 品牌名称 -->
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
                                    'update' => '#Brand_brand_type_id',
                                ),
                            ));
                            ?>
                            <div class="mb20"></div>
                        </div>
                        <div class="select-wrap ">
                            <?php
                            echo $form->dropDownList($model, 'brand_type_id', BrandType::getSonTypeByListData($model->parent_id), array('empty' => '请选择'));
                            ?>
                        </div>
                        <?php echo $form->error($model, 'brand_type_id'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- 标签 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'tag', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="input">
                        <?php echo $form->textField($model, 'tag', array('autocomplete' => 'off', 'maxlength' => 20)); ?>
                        <?php echo $form->error($model, 'tag'); ?>
                    </div>
                    <div class="sep"></div>
                    <span class="tip">最大可输入10个字</span>
                </div>
            </div>
        </div>
        <!-- 银行补贴详情 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'allowance_detail', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="textarea">
                        <?php echo $form->textArea($model, 'allowance_detail', array('cols' => '30', 'rows' => '10', 'maxlength' => 40)) ?>
                        <?php echo $form->error($model, 'allowance_detail'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- 推荐理由 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'recommend_reason', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="textarea">
                        <?php echo $form->textArea($model, 'recommend_reason', array('cols' => '30', 'rows' => '10', 'maxlength' => 40)) ?>
                        <?php echo $form->error($model, 'recommend_reason'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- 推荐理由详情 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'recommend_detail', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="textarea">
                        <?php echo $form->textArea($model, 'recommend_detail', array('cols' => '30', 'rows' => '10', 'maxlength' => 40)) ?>
                        <?php echo $form->error($model, 'recommend_detail'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- 提供增值服务 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'value_added_service', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div>
                        <?php
                        echo $form->checkBoxList($model, 'value_added_service', Brand::getValueAddedServiceItems(), array(
                            'class' => 'proxyList',
                            'separator' => '',
                            'checkAll' => '全部',
                            'container' => 'ul class="role-list"',
                            'template' => '<li class ="item">{input}{label}</li>',
                            'labelOptions' => array('style' => 'display:inline;', 'class' => 'pointname')));
                        ?>
                        <?php echo $form->error($model, 'value_added_service'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- 品牌主图 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'image_path', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="file-upload">
                        <div class="file">
                            <div class="input">
                                <?php echo $form->textField($model, 'image_path', array('autocomplete' => 'off', 'class' => 'fileInput fileInput_image')); ?>
                                <?php echo $form->error($model, 'image_path'); ?>
                            </div>
                            <?php echo CHtml::Button('上传', array('class' => 'btn btn-primary btn-file activeFileSubmit')); ?>
                            <div class="sep"></div>
                            <span class="tip">仅支持PDF格式文件,最大不超过200KB。仅支持jpg、png、jpeg格式</span>
                        </div>
                        <div class="errorMessage TrainingCourse_image_path_errormessage"></div>
                        <div class="file-show"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 上传商家资质 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'qualification_path', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="file-upload">
                        <div class="file">
                            <div class="input readonly">
                                <?php echo $form->textField($model, 'qualification_path_tmp', array('autocomplete' => 'off', 'class' => 'fileInput fileInput_image')); ?>
                                <?php echo $form->error($model, 'qualification_path'); ?>
                            </div>
                            <?php echo CHtml::Button('上传', array('class' => 'btn btn-primary btn-file activeFileSubmita')); ?>
                            <div class="sep"></div>
                            <span class="tip">仅支持PDF格式文件,最大不超过200KB。仅支持jpg、png、jpeg格式</span>
                        </div>
                        <div class="errorMessage TrainingCourse_file_path_errormessage"></div>
                        <div class="file-show"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--上传路径放到此字段 多个数据 ','隔开-->
        <?php echo $form->hiddenField($model, 'qualification_path', array('autocomplete' => 'off')); ?>
    </div>
</div>
<div class="btn-panel">
    <div class="btn-wrap">
        <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存', array('class' => 'btn btn-primary submitForm')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<script>
    $(function () {
        $(".activeFileSubmit").each(function () {
            uploadBtn = $(this);
            new AjaxUpload(uploadBtn, {
                action: "/admin/default/uploadImage/FormIframeUpload[field]/" + uploadBtn.parent('.file').find('.fileInput').attr('id'),
                name: "FormIframeUpload[fileField]",
                data: {YII_CSRF_TOKEN: "<?php echo Yii::app()->request->csrfToken; ?>"},
                onComplete: function (file, response) {
                    uploadBtn.disabled = "";
                    uploadBtn.value = "上传";
                }
            });
        });
    })
    $(function () {
        $(".activeFileSubmita").each(function () {
            uploadBtn = $(this);
            new AjaxUpload(uploadBtn, {
                action: "/admin/default/uploadImage/FormIframeUpload[field]/" + uploadBtn.parent('.file').find('.fileInput').attr('id'),
                name: "FormIframeUpload[fileField]",
                data: {YII_CSRF_TOKEN: "<?php echo Yii::app()->request->csrfToken; ?>"},
                onComplete: function (file, response) {
                    uploadBtn.disabled = "";
                    uploadBtn.value = "上传";
                }
            });
        });
    })
    /**
     *  上传异步回调
     */
    function iframeUpload(status, data, message) {
        var jsonData = jQuery.parseJSON(data);
        if (status != 10000) {
            $("#"+ jsonData.field +"").parents(".file-upload").find(".errorMessage").html('');
            $("." + jsonData.field + "_errormessage").html(message);
            return false;
        }
        $("#"+ jsonData.field +"").parents(".file-upload").find(".errorMessage").html('');
//        $("." + jsonData.field + "_errormessage").html('');
        $("#" + jsonData.field).val(jsonData.fileField);
        if ($("#" + jsonData.field).hasClass("fileInput_image")) {
            showImage();
        };
    }
    ;
    /**
     *  图片回显
     */
    function showImage() {
        $(".fileInput_image").each(function () {
            if (jQuery.trim($(this).val()) != '') {
                $(this).parents(".file-upload").find(".file-show").html('<img src="' + $(this).val() + '"  width="300">');
            };
        });
    };

</script>