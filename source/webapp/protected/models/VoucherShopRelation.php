<?php

/**
 * This is the model class for table "{{voucher_shop_relation}}".
 *
 * The followings are the available columns in table '{{voucher_shop_relation}}':
 * @property integer $voucher_id
 * @property integer $shop_id
 */
class VoucherShopRelation extends CActiveRecord {

    public $shopIds; // 代金券ids
    public $pageSize = 10;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{voucher_shop_relation}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('shopIds', 'required'),
            array('voucher_id', 'required'),
            array('voucher_id, shop_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('voucher_id, shop_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'voucher_id' => '代金券id',
            'shop_id' => '门店id',
            'shopIds' => '门店',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('voucher_id', $this->voucher_id);
        $criteria->compare('shop_id', $this->shop_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => $this->pageSize,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return VoucherShopRelation the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 获取代金券关联的所有门店
     * @param type $voucherId
     * @return type
     */
    static function getAllByVoucherId($voucherId) {
        if (empty($voucherId)) {
            return array();
        }
        $model = self::model();
        $model->voucher_id = $voucherId;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        return $list;
    }

    /**
     * 获取代金券关联的所有门店 - listData
     * @param type $voucherId
     */
    static function getAllByVoucherIdByArray($voucherId) {
        $data = self::getAllByVoucherId($voucherId);
        return array_keys(chtml::listData($data, 'shop_id', 'voucher_id'));
    }

    /**
     * 根据距离
     * @param type $voucherId
     * @param type $lng
     * @param type $lat
     */
    static function getAllByVoucherIdOrderByDistance($voucherId, $lng, $lat, $page = 1, $page_size = 999) {
        if (!empty($lng) || !empty($lat)) {
            $distanceSql = "ROUND(6378.138*2*ASIN(SQRT(POW(SIN(({$lat}*PI()/180-shop.location_lat*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(shop.location_lat*PI()/180)*POW(sin(({$lng}*PI()/180-shop.location_lng*PI()/180)/2),2)))*1000)"
                    . " as distance ";
        } else {
            $distanceSql = "(0) as distance ";
        }
        $sql = "SELECT "
                . "shop.shop_id, shop.brand_id, shop.name, shop.phonenumber, shop.address, shop.business_center_id, "
                . "shop.province_adcode, shop.city_adcode, shop.district_adcode, shop.location_lng, shop.location_lat, "
                . $distanceSql
                . "FROM "
                . "oto_voucher_shop_relation as r "
                . "LEFT JOIN oto_shop as shop ON r.shop_id = shop.shop_id "
                . "WHERE "
                . "r.voucher_id = " . $voucherId . " "
                . "ORDER BY DISTANCE ASC ";
        return DBTools::queryAll($sql, $page, $page_size);
    }

}
