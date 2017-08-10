<?php
$this->pageTitle = Yii::app()->name . ' - 创建品牌';
$this->module->params = array('title' => '创建品牌', 'title_img' => 'fa-th', 'icon' => '');
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">创建品牌</h3>
    </div>
    <div class="panel-body">
        <!-- 品牌名称 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_name_a">品牌名称：<span class="required">*</span></label>
                <div class="from-control col-lg">
                    <div class="input">
                        <input autocomplete="off" maxlength="20" name="TrainingCourse[name]" id="TrainingCourse_name_a" type="text">
                    </div>
                    <div class="sep"></div>
                    <span class="tip">最大可输入20个字</span>
                </div>
            </div>
        </div>
        <!-- 品牌类别 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_course_type_id">品牌类别：</label>
                <div class="from-control col-lg">
                    <div class="select">
                        <div class="select-wrap">
                            <select name="TrainingCourse[course_type_id]" id="TrainingCourse_course_type_id">
                                <option value="">请选择...</option>
                                <optgroup label="TBT_1">
                                    <option value="1">111</option>
                                    <option value="2">222</option>
                                </optgroup>
                            </select>
                            <div class="mb20"></div>
                        </div>
                        <div class="select-wrap ">
                            <select name="TrainingCourse[course_type_id]" id="TrainingCourse_course_type_id">
                                <option value="">请选择...</option>
                                <optgroup label="TBT_1">
                                    <option value="3">111</option>
                                    <option value="4">222</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 标签 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_name">标签：</label>
                <div class="from-control col-lg">
                    <div class="input">
                        <input autocomplete="off" maxlength="10" name="TrainingCourse[name]" id="TrainingCourse_name" type="text">
                    </div>
                    <div class="sep"></div>
                    <span class="tip">最大可输入10个字</span>
                </div>
            </div>
        </div>
        <!-- 银行补贴详情 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label" for="TrainingCourse_description">银行补贴详情：</label>
                <div class="from-control col-lg">
                    <div class="textarea">
                        <textarea cols="30" rows="10" maxlength="100" name="TrainingCourse[description]" ></textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- 推荐理由 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label" for="TrainingCourse_description">推荐理由：</label>
                <div class="from-control col-lg">
                    <div class="textarea">
                        <textarea cols="30" rows="10" maxlength="100" name="TrainingCourse[description]" ></textarea>
                    </div>
                    <div class="sep"></div>
                    <span class="tip">最大可输入40个字</span>
                </div>
            </div>
        </div>
        <!-- 推荐理由详情 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label" for="TrainingCourse_description">推荐理由详情：</label>
                <div class="from-control col-lg">
                    <div class="textarea">
                        <textarea cols="30" rows="10" maxlength="100" name="TrainingCourse[description]" ></textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- 提供增值服务 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label" for="TrainingCourse_description">提供增值服务：</label>
                <div class="from-control col-lg">
                    <div>
                        <input   name="TrainingCourse[name]"  type="checkbox" >  <div class="sep"></div> <span>咖啡设备 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                        <input   name="TrainingCourse[name]"  type="checkbox" > <div class="sep"></div> <span>咖啡设备  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                        <input   name="TrainingCourse[name]"  type="checkbox" >  <div class="sep"></div> <span>咖啡设备  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                        <input   name="TrainingCourse[name]"  type="checkbox" > <div class="sep"></div> <span>咖啡设备</span>

                    </div>
                </div>
            </div>
        </div>
        <!-- 品牌主图 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_image_path">品牌主图 <span class="required">*</span></label>
                <div class="from-control col-lg">
                    <div class="file-upload">
                        <div class="file">
                            <div class="input">
                                <input class="fileInput fileInput_image" name="TrainingCourse[image_path]" id="TrainingCourse_image_path" type="text">
                            </div>
                            <input class="btn btn-primary btn-file activeImageSubmit" value="上传" type="button">
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
                <label class="control-label required" for="TrainingCourse_file_path">上传商家资质 <span class="required">*</span></label>
                <div class="from-control col-lg">
                    <div class="file-upload">
                        <div class="file">
                            <div class="input readonly">
                                <input autocomplete="off"  readonly="readOnly" name="CrmManager[phonenum]"  value="" type="text">
                            </div>
                            <input class="btn btn-primary btn-file activeFileSubmit" value="上传" type="button">
                            <div class="sep"></div>
                            <span class="tip">仅支持PDF格式文件,最大不超过200KB。仅支持jpg、png、jpeg格式</span>
                        </div>
                        <div class="errorMessage TrainingCourse_file_path_errormessage"></div>
                        <div class="file-show"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="from-group">
                  <div class="file-show">
                        <div class="uploadlogo" ><img src="#"></div>
                   </div>
             </div>
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
        <input class="btn btn-primary submitForm" tag="1" name="yt5" value="创建" type="button">
    </div>
</div>