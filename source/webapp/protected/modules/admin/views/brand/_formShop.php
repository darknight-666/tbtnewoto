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

                </div>
            </div>
        </div>
        <div id="mapContainer" tabindex="0" style='width:800px; height:600px'></div>
        <input id = 'mapInput' value = '点击地图显示地址/输入地址显示位置' onfocus = 'this.value = ""'></input>
        <div id='mapMessage'></div>
    </div>
</div>
<div class="btn-panel">
    <div class="btn-wrap">
        <?php echo CHtml::button($model->isNewRecord ? '创建' : '保存', array('class' => 'btn btn-primary submitForm')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<!--<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=ba4de2c26e0f25b2632f1d9b4f3c3114&plugin=AMap.DistrictSearch"></script>-->
<script>
            $(function () {
                $(".submitForm").click(function(){
                    $("#organization-form").submit();
                });
                
//                var map = new AMap.Map('mapContainer', {
//                    resizeEnable: true,
//                    zoom: 13,
//<?php
if (!empty($model->location_x) && !empty($model->location_y)) {
//    echo "center: [" . $model->location_x . ", " . $model->location_y . "]";
}
?>//
//                });
//                district.setLevel('district');
//                AMap.plugin('AMap.Geocoder', function () {
//                    var geocoder = new AMap.Geocoder({
//                        city: "010"//城市，默认：“全国”
//                    });
//                    var marker = new AMap.Marker({
//                        map: map,
//                        bubble: true,
//                    })
//                    var input = document.getElementById('Shop_address');
//                    var message = document.getElementById('mapMessage');
//                    var provinceObj = document.getElementById('Shop_province_adcode');
//                    var cityObj = document.getElementById('Shop_city_adcode');
//                    var districtObj = document.getElementById('Shop_district_adcode');
//                    map.on('click', function (e) {
//                        marker.setPosition(e.lnglat);
//                        geocoder.getAddress(e.lnglat, function (status, result) {
//                            if (status == 'complete') {
//                                input.value = result.regeocode.formattedAddress
//                                //地理编码
//                                geocoder.getLocation(result.regeocode.formattedAddress, function (status, resultLocation) {
//                                    if (status === 'complete' && result.info === 'OK') {
//                                        $("#Shop_location_x").val(resultLocation.geocodes[0].location.lng);
//                                        $("#Shop_location_y").val(resultLocation.geocodes[0].location.lat);
//                                    } else {
//                                        //获取经纬度失败
//                                    }
//                                });
////                                message.innerHTML = ''
//                            } else {
////                                message.innerHTML = '无法获取地址'
//                            }
//                        })
//                    })
//
//                    input.onchange = function (e) {
//                        var address = input.value;
//                        geocoder.getLocation(address, function (status, result) {
//                            if (status == 'complete' && result.geocodes.length) {
//                                alert(result.geocodes[0].location);
//                                marker.setPosition(result.geocodes[0].location);
//                                map.setCenter(marker.getPosition())
//                                message.innerHTML = ''
//                            } else {
//                                message.innerHTML = '无法获取位置'
//                            }
//                        })
//                    }
//                });
            });
</script>