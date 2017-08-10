<?php
$this->pageTitle = Yii::app()->name . ' - 编辑代金券';
$this->module->params = array('title' => '编辑代金券', 'title_img' => 'fa-th', 'icon' => '');
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">发布</h3>
    </div>
    <div class="panel-body">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 选择品牌 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_course_type_id">选择品牌：</label>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 代金券名称 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_name">代金券名称：</label>
                <div class="from-control col-lg">
                    <div class="input">
                        <input autocomplete="off" maxlength="20" name="TrainingCourse[name]" id="TrainingCourse_name" type="text">
                    </div>
                    <div class="sep"></div>
                    <span class="tip">最大可输入20个字</span>
                </div>
            </div>
        </div>
        <!-- 有效期至 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_name">有效期至：</label>
                <div class="from-control col-lg">
                    <div class="input">
                        <input autocomplete="off" maxlength="20" name="TrainingCourse[name]" id="TrainingCourse_name" type="text">
                    </div>
                </div>
            </div>
        </div>
        <!-- 数量 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_name">数量：</label>
                <div class="from-control col-lg">
                    <div class="input">
                        <input autocomplete="off" maxlength="20" name="TrainingCourse[name]" id="TrainingCourse_name" type="text" value="张" class="t-right">
                    </div>
                </div>
            </div>
        </div>
        <!-- 优惠卷面值 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_name">优惠卷面值：</label>
                <div class="from-control col-lg">
                    <div class="input">
                        <input autocomplete="off" maxlength="20" name="TrainingCourse[name]" id="TrainingCourse_name" type="text" value="元" class="t-right">
                    </div>
                </div>
            </div>
        </div>
        <!-- 价格 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_name">价格：</label>
                <div class="from-control col-lg">
                    <div class="input">
                        <input autocomplete="off" maxlength="20" name="TrainingCourse[name]" id="TrainingCourse_name" type="text" value="元" class="t-right">
                    </div>
                </div>
            </div>
        </div>
        <!-- 是否为周三五折劵 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label required" for="TrainingCourse_course_type_id">是否为周三五折劵：</label>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 使用提示 -->
        <div class="section">
            <div class="from-group">
                <label class="control-label" for="TrainingCourse_description">使用提示：</label>
                <div class="from-control col-lg">
                    <div class="textarea">
                        <textarea cols="30" rows="10" maxlength="100" name="TrainingCourse[description]" ></textarea>
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
        <input class="btn btn-primary submitForm" tag="1" name="yt5" value="发布" type="button">
    </div>
</div>

