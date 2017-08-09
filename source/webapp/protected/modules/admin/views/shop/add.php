<?php
$this->pageTitle = Yii::app()->name . ' - 门店添加';
$this->module->params = array('title' => '门店添加', 'title_img' => 'fa-th', 'icon' => '');
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">创建门店</h3>
    </div>
    <div class="panel-body">
        <!-- 门店名称 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_name_a">门店名称：<span class="required">*</span></label>
                <div class="from-control col-lg">
                    <div class="input">
                        <input autocomplete="off" maxlength="20" name="TrainingCourse[name]" id="TrainingCourse_name_a" type="text">
                    </div>
                    <div class="sep"></div>
                    <span class="tip">最大可输入20个字</span>
                </div>
            </div>
        </div>
        <!-- 门店电话 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_name_a">门店电话：<span class="required">*</span></label>
                <div class="from-control col-lg">
                    <div class="input">
                        <input autocomplete="off" maxlength="20" name="TrainingCourse[name]" id="TrainingCourse_name_a" type="text">
                    </div>
                </div>
            </div>
        </div>
        <!-- 商圈 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_course_type_id">商圈：<span class="required">*</span></label>
                <div class="from-control col-lg">
                    <div class="select">
                        <div class="select-wrap">
                            <select name="TrainingCourse[course_type_id]" id="TrainingCourse_course_type_id">
                                <option value="">请选择...</option>
                                <option value="1">111</option>
                                <option value="2">222</option>
                            </select>
                        </div>
                    </div>
                    <div class="sep"></div>
                    <div class="select">
                        <div class="select-wrap">
                            <select name="TrainingCourse[course_type_id]" id="TrainingCourse_course_type_id">
                                <option value="">请选择...</option>
                                <option value="">请选择...</option>
                                <option value="1">111</option>
                                <option value="2">222</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 所在地区 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_course_type_id">所在地区：<span class="required">*</span></label>
                <div class="from-control col-lg">
                    <div class="select">
                        <div class="select-wrap">
                            <select name="TrainingCourse[course_type_id]" id="TrainingCourse_course_type_id">
                                <optgroup label="TBT_1">
                                    <option value="1">山西区</option>
                                    <option value="2">222</option>
                                </optgroup>
                                <optgroup label="TBT_1">
                                    <option value="1">北京</option>
                                    <option value="2">222</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="sep"></div>
                    <div class="select">
                        <div class="select-wrap">
                            <select name="TrainingCourse[course_type_id]" id="TrainingCourse_course_type_id">
                                <optgroup label="TBT_1">
                                    <option value="1">朔州市</option>
                                    <option value="2">222</option>
                                </optgroup>
                                <optgroup label="TBT_1">
                                    <option value="1">中关村</option>
                                    <option value="2">222</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="sep"></div>
                    <div class="select">
                        <div class="select-wrap">
                            <select name="TrainingCourse[course_type_id]" id="TrainingCourse_course_type_id">
                                <optgroup label="TBT_1">
                                    <option value="1">平鲁区</option>
                                    <option value="2">222</option>
                                </optgroup>
                                <optgroup label="TBT_1">
                                    <option value="1">海淀黄庄北</option>
                                    <option value="2">222</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 具体地址 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_name_a">具体地址：<span class="required">*</span></label>
                <div class="from-control col-lg">
                    <div class="input">
                        <input autocomplete="off" maxlength="20" name="TrainingCourse[name]" id="TrainingCourse_name_a" type="text" value="山西省">
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
        <input class="btn btn-primary submitForm" tag="1" name="yt5" value="提交" type="button">
    </div>
</div>
