<?php

/**
 * This is the model class for table "{{shop}}".
 *
 * The followings are the available columns in table '{{shop}}':
 * @property string $shop_id
 * @property integer $brand_id
 * @property string $name
 * @property string $phonenumber
 * @property string $province_adcode
 * @property string $city_adcode
 * @property string $district_adcode
 * @property integer $business_center_id
 * @property string $address
 * @property double $location_lng
 * @property double $location_lat
 * @property string $create_time
 */
class Shop extends CActiveRecord {

    public $pageSize = 10;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{shop}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, brand_id, phonenumber, address, location_lng, location_lat, create_time', 'required'),
            array('brand_id, business_center_id', 'numerical', 'integerOnly' => true),
            array('location_lng, location_lat', 'numerical'),
            array('name, phonenumber, province_adcode, city_adcode, district_adcode', 'length', 'max' => 20),
            array('address', 'length', 'max' => 200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('shop_id, brand_id, name, phonenumber, province_adcode, city_adcode, district_adcode, business_center_id,'
                . ' address, location_lng, location_lat, create_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'brand' => array(self::BELONGS_TO,'Brand','brand_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'shop_id' => '门店id',
            'brand_id' => '品牌id',
            'name' => '门店名称',
            'phonenumber' => '门店电话',
            'province_adcode' => '省份adcode',
            'city_adcode' => '城市adcode',
            'district_adcode' => '地区adcode',
            'business_center_id' => '商圈',
            'address' => '地址',
            'location_lng' => '经度',
            'location_lat' => '维度',
            'create_time' => '创建时间',
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

        $criteria->compare('shop_id', $this->shop_id, true);
        $criteria->compare('brand_id', $this->brand_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('phonenumber', $this->phonenumber, true);
        $criteria->compare('province_adcode', $this->province_adcode, true);
        $criteria->compare('city_adcode', $this->city_adcode, true);
        $criteria->compare('district_adcode', $this->district_adcode, true);
        $criteria->compare('business_center_id', $this->business_center_id);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('location_lng', $this->location_lng);
        $criteria->compare('location_lat', $this->location_lat);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->order = 'create_time desc';
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
     * @return Shop the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeValidate() {
        $this->create_time = !empty($this->create_time) ? $this->create_time : date('Y-m-d H:i:s');
        return parent::beforeValidate();
    }

    /**
     * 获取所有根据 brand_id
     * @param type $brandId
     * @return type
     */
    static function getAllByBrandId($brandId) {
        if (empty($brandId)) {
            return array();
        }
        $model = self::model();
        $model->brand_id = $brandId;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        return $list;
    }

    /**
     * 获取所有根据 brand_id - listData
     * @param type $brandId
     * @return type
     */
    static function getAllByBrandIdbyListData($brandId) {
        $data = self::getAllByBrandId($brandId);
        return CHtml::listData($data, 'shop_id', 'name');
    }

}
