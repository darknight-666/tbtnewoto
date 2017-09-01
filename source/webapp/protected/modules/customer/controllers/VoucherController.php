<?php

/**
 * 代金券类
 */
class VoucherController extends CustomerBaseController {

    /**
     * 搜索条件
     */
    public function actionListSearchCondition() {
// 1餐饮类 2娱乐类
        $this->checkParams(array('empty' => array('parent_id')));
        $data = array('brandType' => array(), 'businessCenter' => array(), 'orderWay' => array());
        $data['brandType'] = BrandType::getSonTypeByArray($this->params['parent_id']);
        $data['orderWay'] = array(
            array('orderWayTitle' => '智能排序', 'orderWayValue' => Voucher::ORDERWAY_BY_ORDERNUMBER),
            array('orderWayTitle' => '距离最近', 'orderWayValue' => Voucher::ORDERWAY_BY_DISTANCE)
        );
        if (!empty($this->params['adcode'])) { // 定位信息不为空
            $allDistrict = Map::getAllDistrictByCityIdByListData(Map::getCityCodeByCode($this->params['adcode']));
            $businessCenter = array(array('name' => '全部区域', 'items' => array()));
            foreach ($allDistrict as $adcode => $name) {
                $tmp = BusinessCenter::getAllByDistrictIdByArray($adcode);
                if (!empty($tmp)) { // 只返回有商圈的地区
                    $businessCenter[0]['items'] = array_merge($businessCenter[0]['items'], $tmp);
                    $businessCenter[] = array('name' => $name, 'items' => $tmp);
                }
            }
            $data['businessCenter'] = $businessCenter;
        }
        $this->output($data);
    }

    /**
     * 代金券列表
     */
    public function actionList() {
        Yii::app();
        $this->checkParams(array('empty' => array('discount_status')));
        //动态获取sql条件
        $discountStatusSql = !empty($this->params['discount_status']) ? 'AND voucher.`discount_status`=' . $this->params['discount_status'] . ' ' : '';
        $brandTypeSql = !empty($this->params['brand_type_id']) ? 'AND brand_type.`brand_type_id`=' . $this->params['brand_type_id'] . ' ' : '';
        $businessCenterSql = !empty($this->params['business_center_id']) ? 'AND shop.`business_center_id`=' . $this->params['business_center_id'] . ' ' : '';

        if (empty($this->params['orderWayValue']) || $this->params['orderWayValue'] == Voucher::ORDERWAY_BY_ORDERNUMBER) {
            $orderSql = 'ORDER BY voucher.order_number ASC, voucher.voucher_id ASC ';
        } else if ($this->params['orderWayValue'] == Voucher::ORDERWAY_BY_DISTANCE) {
            $orderSql = 'ORDER BY distance ASC, voucher.price DESC ';
        }

        // 计算距离字段
        if (empty($this->params['location_lng']) && empty($this->params['location_lat'])) {
            $distance = "0 AS distance, "; // 无定位数据距离强制为0
        } else {
            $distance = "("
                    . "SELECT MIN(ROUND(6378.138*2*ASIN(SQRT(POW(SIN(({$this->params['location_lat']}*PI()/180-shop.location_lat*PI()/180)/2),2)+COS({$this->params['location_lat']}*PI()/180)*COS(shop.location_lat*PI()/180)*POW(sin(({$this->params['location_lng']}*PI()/180-shop.location_lng*PI()/180)/2),2)))*1000)) AS shop_distance "
                    . "FROM `oto_voucher_shop_relation` AS r "
                    . "LEFT JOIN `oto_shop` AS shop ON r.`shop_id` = shop.`shop_id` "
                    . "WHERE r.`voucher_id` = voucher.`voucher_id` "
//                    . $businessCenterSql
                    . ") AS distance, ";
        }

        //拼装sql语句
        $sql = "SELECT  "
                . "voucher.voucher_id, voucher.name, voucher.face_value, voucher.price, voucher.status, voucher.discount_status, voucher.order_number, "
                . $distance
                . "brand.`name` AS brand__name, brand.`expensive_status` as brand__expensive_status, brand.`tag` AS brand__tag, brand.`image_path` AS brand__image_path, "
                . "brand_type.`name` AS brand_type__name, brand_type.`brand_type_id` AS brand_type__brand_type_id, "
                . "shop.`business_center_id` AS shop__business_center_id, shop.`shop_id` AS shop__shop_id "
                . "FROM `oto_voucher` AS voucher "
                . "LEFT JOIN `oto_brand`AS brand ON voucher.brand_id = brand.`brand_id` "
                . "LEFT JOIN `oto_brand_type` AS brand_type ON brand.`brand_type_id` = brand_type.`brand_type_id` "
                . "LEFT JOIN `oto_voucher_shop_relation` AS voucher_shop_relation ON voucher_shop_relation.`voucher_id` = voucher.voucher_id "
                . "LEFT JOIN `oto_shop` AS shop ON voucher_shop_relation.`shop_id` = shop.`shop_id` "
                . "WHERE "
                . "voucher.`status`= " . Voucher::STATUS_ONLINE . " OR voucher.`status`= " . Voucher::STATUS_SELLOUT . " "
                . $discountStatusSql
                . $brandTypeSql
                . $businessCenterSql
                . "GROUP BY voucher.`voucher_id` "
                . $orderSql;
        $data = DBTools::queryAll($sql, $this->params['page'], $this->params['page_size']);

        //查询拼接brand_tag
        foreach ($data['items'] as &$item) {
            $item['brand_tag'] = Tag::getAllByTagIdByArray($item['brand']['tag']);
        }
        $this->output($data);
    }

    /**
     * 代金券详情
     */
    public function actionDetail() {
        $this->checkParams(array('empty' => array('voucher_id')));
        $lng = !empty($this->params['location_lng']) ? $this->params['location_lng'] : 0;
        $lat = !empty($this->params['location_lat']) ? $this->params['location_lat'] : 0;
        $model = Voucher::model()->findByPk($this->params['voucher_id']);
        if (empty($model)) {
            $this->output('', ApiStatusCode::$error, '无此产品');
        }
        $data = $model->attributes;
        $data['brand'] = $model->brand->attributes;
        $data['brand_type'] = $model->brand->type->attributes;
        $data['brand_tag'] = Tag::getAllByTagIdByArray($data['brand']['tag']);
        $data['brand_value_added_service'] = ValueAddedService::getAllByIdByArray($data['brand']['value_added_service']);
        $data['image_path'] = My::uploadUrlAdd($data['image_path']);
        $data['tips'] = Voucher::getTipsByArray($data['tips']);
        $data['brand']['recommend_reason'] = Brand::getRecommendReasonByArray($data['brand']['recommend_reason']);
        $data['brand']['image_path'] = My::uploadUrlAdd($data['brand']['image_path']);
        $data['brand']['qualification_path'] = My::uploadUrlAdd(explode(',', $data['brand']['qualification_path']));
        foreach ($data['brand_value_added_service'] as &$item) {
            $item['image_path'] = My::uploadUrlAdd($item['image_path']);
        }
        $data['shops'] = VoucherShopRelation::getAllByVoucherIdOrderByDistance($this->params['voucher_id'], $lng, $lat, 1, 1);
        $this->output($data);
    }

    /**
     * 门店列表
     */
    public function actionShopList() {
        $this->checkParams(array('empty' => array('voucher_id')));
        $lng = !empty($this->params['location_lng']) ? $this->params['location_lng'] : 0;
        $lat = !empty($this->params['location_lat']) ? $this->params['location_lat'] : 0;
        $model = Voucher::model()->findByPk($this->params['voucher_id']);
        if (empty($model)) {
            $this->output('', ApiStatusCode::$error, '无此产品');
        }
        $data = VoucherShopRelation::getAllByVoucherIdOrderByDistance($this->params['voucher_id'], $lng, $lat, $this->params['page'], $this->params['page_size']);
        $this->output($data);
    }

    /**
     * 下单
     */
    public function actionOrderSubmit() {
        $this->checkLogin();
        $this->checkParams(array('empty' => array('voucher_id', 'quantity')));
        $model = Voucher::model()->findByPk($this->params['voucher_id']);
        if (empty($model)) {
            $this->output('', ApiStatusCode::$error, '无此产品');
        }
        // 周三五折产品时间不到
        if ($model->discount_status == Voucher::DISCOUNT_STATUS_YES && SystemConfig::systemWeek() != SystemConfig::SYSTEM_WEEK_WEDNESDAY) {
            $this->output('', ApiStatusCode::$error, '产品未开售');
        }
        // 产品未上线
        if ($model->status != Voucher::STATUS_ONLINE) {
            $this->output('', ApiStatusCode::$error, '产品已售罄');
        }
        /**
         * 数量不够
         */
        if ($model->limit_quantity - $this->params['quantity'] < 0) {
            $this->output('', ApiStatusCode::$error, '产品数量不足');
        } else if ($model->limit_quantity - $this->params['quantity'] == 0) { // 售罄处理
            $model->status = Voucher::STATUS_SELLOUT;
        }
        $model->limit_quantity = $model->limit_quantity - $this->params['quantity']; // 库存量 -1
        $model->sell_quantity = $model->sell_quantity + $this->params['quantity']; // 已售数量 +1
        $result = $model->updateWithCheckVersion();
        if (empty($result)) { // 购买失败
            $this->output('', ApiStatusCode::$error, '系统繁忙');
        } else { // 生成订单
            $ret = Order::orderCreate($model, $this->params['quantity'], Yii::app()->user->id);
            $this->output(array('order_id'=> $ret));
        }
    }

}
