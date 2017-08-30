<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'organization-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'smart-form'),
        ));
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">创建增值服务</h3>
    </div>
    <div class="panel-body">
        <!-- 增值服务名称 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div class="input">
                        <?php echo $form->textField($model, 'name', array('autocomplete' => 'off', 'maxlength' => 10)); ?>
                        <?php echo $form->error($model, 'name'); ?>
                    </div>
                    <div class="sep"></div>
                    <span class="tip">最大可输入10个字</span>
                </div>
            </div>
        </div>
        <!-- 图标 -->
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
                            <span class="tip">仅支持jpg、png、jpeg格式，最大不超过200KB</span>
                        </div>
                        <div class="errorMessage ValueAddedService_image_path_errormessage"></div>
                        <div class="file-show"></div>
                    </div>
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

        //图片回显
        showImage();

    });

    /**
     *  上传异步回调
     */
    function iframeUpload(status, data, message) {
        var jsonData = jQuery.parseJSON(data);
        if (status != 10000) {
            $("#" + jsonData.field + "").parents(".file-upload").find(".errorMessage").html('');
            $("." + jsonData.field + "_errormessage").html(message);
            return false;
        }
        $("#" + jsonData.field + "").parents(".file-upload").find(".errorMessage").html('');
        $("." + jsonData.field + "_errormessage").html('');

        $("#" + jsonData.field).val(jsonData.fileField);
        if ($("#" + jsonData.field).hasClass("fileInput_image")) {
            showImage();
        }

    }

    /**
     *  图片回显
     */
    function showImage() {
        $(".fileInput_image").each(function () {
            if (jQuery.trim($(this).val()) != '') {
                $(this).parents(".file-upload").find(".file-show").html('<img src="' + $(this).val() + '"  width="300">');
            }
        });
    }
</script>