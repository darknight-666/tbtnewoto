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
        $this->output(Map::getAllCityByProvinceIdByListData(130000));
    }

    /**
     * 根据省id获取下属所有的市
     */
    public function actionGetDistrictListByCityId() {
        $this->output(Map::getAllDistrictByCityIdByListData(130600));
    }

}
