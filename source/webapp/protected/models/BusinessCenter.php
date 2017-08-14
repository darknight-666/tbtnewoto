<?php

/**
 * This is the model class for table "{{business_center}}".
 *
 * The followings are the available columns in table '{{business_center}}':
 * @property string $business_center_id
 * @property string $district_adcode
 * @property string $name
 */
class BusinessCenter extends CActiveRecord {

    public $pageSize = 999;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{business_center}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('district_adcode, name', 'length', 'max' => 20),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('business_center_id, district_adcode, name', 'safe', 'on' => 'search'),
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
            'business_center_id' => '商圈id',
            'district_adcode' => '地区adcode',
            'name' => '商圈名称',
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

        $criteria->compare('business_center_id', $this->business_center_id, true);
        $criteria->compare('district_adcode', $this->district_adcode, true);
        $criteria->compare('name', $this->name, true);

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
     * @return BusinessCenter the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    /**
     * 根据地区获取商圈
     * @param type $adcode
     * @return type
     */
    public static function getAllByDistrictId($adcode) {
        if (empty($adcode)) {
            return array();
        }
        $model = self::model();
        $model->district_adcode = $adcode;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        return $list;
    }
    
    /**
     * 根据地区获取商圈 - listData
     * @param type $adcode
     * @return type
     */
    public static function getAllByDistrictIdByListData($adcode) {
        $data = self::getAllByDistrictId($adcode);
        return CHtml::listData($data, 'business_center_id', 'name');
    }

}
