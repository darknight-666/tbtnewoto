<?php

/**
 * This is the model class for table "{{map}}".
 *
 * The followings are the available columns in table '{{map}}':
 * @property integer $id
 * @property string $citycode
 * @property string $adcode
 * @property string $name
 * @property string $center
 * @property string $level
 * @property string $areacode
 */
class Map extends CActiveRecord {

    const LEVEL_PROVINCE = 'province'; //省
    const LEVEL_CITY = 'city'; // 市
    const LEVEL_DISTRICT = 'district'; // 区
    const LEVEL_STREET = 'street'; // 街道

    public $adcodeBettwen = array();
    public $pageSize = 999;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{map}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('citycode, level', 'length', 'max' => 10),
            array('adcode, name, areacode', 'length', 'max' => 20),
            array('center', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, citycode, adcode, name, center, level, areacode, adcodeBettwen', 'safe', 'on' => 'search'),
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
            'id' => 'ID',
            'citycode' => 'Citycode',
            'adcode' => 'Adcode',
            'name' => 'Name',
            'center' => 'Center',
            'level' => 'Level',
            'areacode' => 'Areacode',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('citycode', $this->citycode, true);
        $criteria->compare('adcode', $this->adcode);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('center', $this->center, true);
        $criteria->compare('level', $this->level);
        $criteria->compare('areacode', $this->areacode, true);
        if (!empty($this->adcodeBettwen)) {
            $criteria->addBetweenCondition('adcode', $this->adcodeBettwen[0], $this->adcodeBettwen[1]);
        }
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
     * @return Map the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 获取所有的省
     */
    static function getAllProvince() {
        $model = self::model();
        $model->level = self::LEVEL_PROVINCE;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        return $list;
    }

    /**
     * 获取所有的省 - ListData
     */
    static function getAllProvinceByListData() {
        $data = self::getAllProvince();
        return CHtml::listData($data, 'adcode', 'name');
    }

    /**
     * 获取所有的市根据省份Id
     */
    static function getAllCityByProvinceId($adcode) {
        if (empty($adcode)) {
            return array();
        }
        $model = self::model();
        $model->adcodeBettwen = array($adcode, $adcode + 10000);
        $model->level = self::LEVEL_CITY;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        return $list;
    }

    /**
     * 获取所有的市根据省份Id - ListData
     */
    static function getAllCityByProvinceIdByListData($adcode) {
        $data = self::getAllCityByProvinceId($adcode);
        return CHtml::listData($data, 'adcode', 'name');
    }

    /**
     * 获取所有的区根据市Id
     */
    static function getAllDistrictByCityId($adcode) {
        if (empty($adcode)) {
            return array();
        }
        $model = self::model();
        $model->adcodeBettwen = array($adcode, $adcode + 100);
        $model->level = self::LEVEL_DISTRICT;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        return $list;
    }

    /**
     * 获取所有的市根据省份Id - ListData
     */
    static function getAllDistrictByCityIdByListData($adcode) {
        $data = self::getAllDistrictByCityId($adcode);
        return CHtml::listData($data, 'adcode', 'name');
    }

}
