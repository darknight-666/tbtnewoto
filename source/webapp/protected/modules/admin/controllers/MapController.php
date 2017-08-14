<?php

class MapController extends AdminBaseController {

    /**
     * 省列表
     */
    public function actionProvinceList() {
        $this->output(Map::getAllProvinceByListData());
    }

    /**
     * 根据省id获取下属所有的市
     */
    public function actionGetCityListByProvinceId() {
        $adcode = Yii::app()->request->getParam('adcode');
        echo CHtml::tag('option', array('value' => ''), '请选择', TRUE);
        $data = Map::getAllCityByProvinceIdByListData($adcode);
        foreach ($data as $key => $value) {
            echo CHtml::tag('option', array('value' => $key), $value, TRUE);
        }
    }

    /**
     * 根据省id获取下属所有的市
     */
    public function actionGetDistrictListByCityId() {
        $adcode = Yii::app()->request->getParam('adcode');
        echo CHtml::tag('option', array('value' => ''), '请选择', TRUE);
        $data = Map::getAllDistrictByCityIdByListData($adcode);
        foreach ($data as $key => $value) {
            echo CHtml::tag('option', array('value' => $key), $value, TRUE);
        }
    }

    /**
     * 根据省id获取下属所有的市
     */
    public function actionGetBusinessCenterListByDistrictId() {
        $adcode = Yii::app()->request->getParam('adcode');
        echo CHtml::tag('option', array('value' => ''), '请选择', TRUE);
        $data = BusinessCenter::getAllByDistrictIdByListData($adcode);
        foreach ($data as $key => $value) {
            echo CHtml::tag('option', array('value' => $key), $value, TRUE);
        }
    }

}
