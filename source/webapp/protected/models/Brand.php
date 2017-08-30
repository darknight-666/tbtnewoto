<?php

/**
 * This is the model class for table "{{brand}}".
 *
 * The followings are the available columns in table '{{brand}}':
 * @property string $brand_id
 * @property integer $brand_type_id
 * @property string $name
 * @property string $tag
 * @property integer $status
 * @property integer $expensive_status
 * @property string $recommend_reason
 * @property string $value_added_service
 * @property string $image_path
 * @property string $qualification_path
 * @property string $create_time
 */
class Brand extends CActiveRecord {

    //状态
    const STATUS_NOTCONFIRM = 1; //待审核
    const STATUS_CONFIRMED = 11; //已审核
    const STATUS_DELETED = 21; //已删除
    //一贵就赔
    const EXPENSIVE_STATUS_YES = 1; //是
    const EXPENSIVE_STATUS_NO = 2; //否

    public $pageSize = 10;
    public $parent_id; //分类id一级
    public $qualification_path_tmp; // 资质上传临时存储

    /**
     * @return string the associated database table name
     */

    public function tableName() {
        return '{{brand}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, parent_id, brand_type_id, status, expensive_status, image_path, create_time', 'required'),
            array('brand_type_id, status, expensive_status', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 20),
            array('tag', 'length', 'max' => 10),
            array('recommend_reason', 'length', 'max' => 40),
            array('value_added_service', 'length', 'max' => 120),
            array('image_path', 'length', 'max' => 255),
            array('qualification_path_tmp, qualification_path', 'length', 'max' => 1000),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('brand_id, brand_type_id, name, tag, status, expensive_status, recommend_reason, value_added_service, image_path, qualification_path, create_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'type' => array(self::BELONGS_TO, 'BrandType', 'brand_type_id'),
            'shop' => array(self::HAS_MANY, 'Shop', 'brand_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'brand_id' => '品牌id',
            'brand_type_id' => '品牌分类',
            'name' => '品牌名称',
            'tag' => '品牌标签',
            'status' => '状态',
            'expensive_status' => '是否承诺 一贵就赔',
            'recommend_reason' => '推荐理由',
            'value_added_service' => '增值服务',
            'image_path' => '品牌主图',
            'qualification_path' => '企业资质',
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

        $criteria->compare('brand_id', $this->brand_id, true);
        $criteria->compare('brand_type_id', $this->brand_type_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('tag', $this->tag, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('recommend_reason', $this->recommend_reason, true);
        $criteria->compare('value_added_service', $this->value_added_service, true);
        $criteria->compare('image_path', $this->image_path, true);
        $criteria->compare('qualification_path', $this->qualification_path, true);
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
     * @return Brand the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeValidate() {
        $this->tag = !empty($this->tag) ? implode(',', $this->tag) : '';
        $this->value_added_service = !empty($this->value_added_service) ? implode(',', $this->value_added_service) : '';
        $this->status = !empty($this->status) ? $this->status : self::STATUS_CONFIRMED;
        $this->create_time = !empty($this->create_time) ? $this->create_time : date('Y-m-d H:i:s');
        return parent::beforeValidate();
    }

    public function afterSave() {
        $this->tag = !empty($this->tag) ? explode(',', $this->tag) : array();
        $this->value_added_service = !empty($this->value_added_service) ? explode(',', $this->value_added_service) : array();
        return parent::afterSave();
    }

    public function afterFind() {
        $this->tag = !empty($this->tag) ? explode(',', $this->tag) : array();
        $this->value_added_service = !empty($this->value_added_service) ? explode(',', $this->value_added_service) : array();
        $this->parent_id = $this->type->parent_id;
        parent::afterFind();
    }

    /**
     * 状态组
     */
    static function getStatusItems() {
        return array(
            self::STATUS_NOTCONFIRM => '待审核',
            self::STATUS_CONFIRMED => '已审核',
            self::STATUS_DELETED => '已删除',
        );
    }

    /**
     * 获取指定状态值
     * @param type $key
     * @return type
     */
    static function getStatusTitle($key) {
        $items = self::getStatusItems();
        return isset($items[$key]) ? $items[$key] : Null;
    }

    /**
     * 一贵就赔 - 状态组
     */
    static function getExpensiveStatusItems() {
        return array(
            self::EXPENSIVE_STATUS_YES => '是',
            self::EXPENSIVE_STATUS_NO => '否',
        );
    }

    /**
     * 获取一贵就赔指定状态值
     * @param type $key
     * @return type
     */
    static function getExpensiveStatusTitle($key) {
        $items = self::getExpensiveStatusItems();
        return isset($items[$key]) ? $items[$key] : Null;
    }

    /**
     * 获取所有数据
     */
    static function getAll() {
        $model = self::model();
        $model->pageSize = 999;
        $model->status = self::STATUS_CONFIRMED;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        return $list;
    }

    /**
     * 获取所有数据 - listData
     * @return type
     */
    static function getAllListByListData() {
        $data = self::getAll();
        return CHtml::listData($data, 'brand_id', 'name');
    }

    /**
     * 获取所有数据by typeid
     */
    static function getAllByBrandTypeId($brandTypeId) {
        if (empty($brandTypeId)) {
            return array();
        }
        $model = self::model();
        $model->pageSize = 999;
        $model->brand_type_id = $brandTypeId;
        $model->status = self::STATUS_CONFIRMED;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        return $list;
    }

    /**
     * 获取所有数据by typeid - listData
     * @return type
     */
    static function getAllByBrandTypeIdByListData($brandTypeId) {
        $data = self::getAllByBrandTypeId($brandTypeId);
        return CHtml::listData($data, 'brand_id', 'name');
    }

}
