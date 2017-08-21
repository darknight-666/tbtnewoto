<?php

/**
 * This is the model class for table "{{brand_type}}".
 *
 * The followings are the available columns in table '{{brand_type}}':
 * @property string $brand_type_id
 * @property integer $parent_id
 * @property string $name
 */
class BrandType extends CActiveRecord {

    public $pageSize = 10;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{brand_type}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_id', 'required'),
            array('parent_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 20),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('brand_type_id, parent_id, name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'parent' => array(self::BELONGS_TO, 'BrandType', 'parent_id'),
            'brand' => array(self::HAS_MANY, 'Brand', 'brand_type_id', 'on' => 'brand.status = ' . Brand::STATUS_CONFIRMED),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'brand_type_id' => '品牌分类id',
            'parent_id' => '父分类id',
            'name' => '分类名称',
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

        $criteria->compare('brand_type_id', $this->brand_type_id, true);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('name', $this->name, true);
        $criteria->order = 't.brand_type_id desc';
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
     * @return BrandType the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 获取所有顶级分类
     */
    static function getAllTopType() {
        $model = self::model();
        $model->parent_id = 0;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        return $list;
    }

    /**
     * 获取所有顶级分类listData
     */
    static function getAllTopTypeByListData() {
        $list = self::getAllTopType();
        return CHtml::listData($list, 'brand_type_id', 'name');
    }

    /**
     * 获取子分类
     * @param type $parentId
     * @return type
     */
    static function getSonType($parentId) {
        if ($parentId == 0) {
            return array();
        }
        $model = self::model();
        $model->parent_id = $parentId;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        return $list;
    }
    
    /**
     * 获取子分类 by 数组
     * @param type $parentId
     * @return type
     */
    static function getSonTypeByArray($parentId) {
        if ($parentId == 0) {
            return array();
        }
        $model = self::model();
        $model->parent_id = $parentId;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        $data = array();
        foreach($list as $obj){
            $data[] = $obj->attributes;
        }
        return $data;
    }

    /**
     * 获取所有顶级分类listData
     */
    static function getSonTypeByListData($parentId) {
        $list = self::getSonType($parentId);
        return CHtml::listData($list, 'brand_type_id', 'name');
    }

}
