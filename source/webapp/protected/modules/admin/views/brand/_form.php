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
        <!-- TAG -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'tag', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div>
                        <?php
                        echo $form->checkBoxList($model, 'tag', Tag::getAllByListData(), array(
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
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'expensive_status', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div>
                        <?php
                        echo $form->radioButtonList($model, 'expensive_status', Brand::getExpensiveStatusItems(), array(
                            'class' => 'proxyList',
                            'separator' => '',
                            'container' => 'ul class="role-list"',
                            'template' => '<li class ="item">{input}{label}</li>',
                            'labelOptions' => array('style' => 'display:inline;', 'class' => 'pointname')));
                        ?>
                        <?php echo $form->error($model, 'expensive_status'); ?>
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
        <!-- 提供增值服务 -->
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'value_added_service', array('class' => 'control-label')); ?>
                <div class="from-control col-lg">
                    <div>
                        <?php
                        echo $form->checkBoxList($model, 'value_added_service', ValueAddedService::getAllByListData(), array(
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
                        <div class="errorMessage Brand_image_path_errormessage"></div>
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
                                <?php echo $form->textField($model, 'qualification_path', array('autocomplete' => 'off', 'class' => 'fileInput fileInput_imagea')); ?>
                                <?php echo $form->error($model, 'qualification_path'); ?>
                            </div>
                            <?php echo CHtml::Button('上传', array('class' => 'btn btn-primary btn-file activeFileSubmit')); ?>
                            <div class="sep"></div>
                            <span class="tip">仅支持PDF格式文件,最大不超过200KB。仅支持jpg、png、jpeg格式</span>
                        </div>
                        <div class="errorMessage Brand_qualification_path_tmp_errormessage"></div>
                        <div class="file-show"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="showimg"></div>
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
        showQualification();

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

        // 品牌图
        if (jsonData.field == "Brand_image_path") {
            $("#" + jsonData.field).val(jsonData.fileField);
            if ($("#" + jsonData.field).hasClass("fileInput_image")) {
                showImage();
            }
        }

        // 资质图
        if (jsonData.field == "Brand_qualification_path") {
            var path = $("#" + jsonData.field);
            if (path.val() != '') {
                path.val(path.val() + ',' + jsonData.fileField);
            } else {
                path.val(jsonData.fileField);
            }
            showQualification();
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

    /**
     * 资质图片回显
     */
    function showQualification() {
        var showImg = $("#showimg");
        var pathVal = $("#Brand_qualification_path").val();
        var pathValArr = pathVal.split(',');
        showImg.html('');
        for (var i = 0; i < pathValArr.length; i++) {
            if (pathValArr[i] != '') {
                showImg.append("<span><b class='button_img'>x</b><img src=" + pathValArr[i] + "></span> ");
            }
        }
        showImg.find('span').find('.button_img').on('click', function () {
            qualificationDelete($(this));
        });
    }

    /**
     * 资质图片删除
     */
    function qualificationDelete(obj) {
        var imgSrc = obj.parents("span").find('img').attr('src');
        var path = $("#Brand_qualification_path");
        var pathVal = $("#Brand_qualification_path").val();
        var pathValArr = pathVal.split(',');
        for (var i = 0; i < pathValArr.length; i++) {
            if (imgSrc == pathValArr[i]) {
                pathValArr.splice(i, 1);
            }
        }
        path.val(pathValArr.join(','));
        showQualification();
    }

</script>