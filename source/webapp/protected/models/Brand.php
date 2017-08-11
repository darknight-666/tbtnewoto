<?php

/**
 * This is the model class for table "{{brand}}".
 */
class Brand extends CActiveRecord {

    const STATUS_NOTCONFIRM = 1; //待审核
    const STATUS_CONFIRMED = 11; //已审核
    const STATUS_DELETED = 21; //已删除

    public $pageSize = 10;
    public $parent_id; //分类id一级

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
            array('name, parent_id, brand_type_id, status, allowance_detail, recommend_detail, create_time', 'required'),
            array('brand_type_id, status', 'numerical', 'integerOnly' => true),
            array('reach_amount, discount_amount', 'numerical'),
            array('name', 'length', 'max' => 20),
            array('tag', 'length', 'max' => 10),
            array('recommend_reason', 'length', 'max' => 40),
            array('value_added_service', 'length', 'max' => 120),
            array('image_path', 'length', 'max' => 255),
            array('qualification_path', 'length', 'max' => 1000),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('brand_id, brand_type_id, name, tag, status, reach_amount, discount_amount, allowance_detail, recommend_reason, recommend_detail, value_added_service, image_path, qualification_path, create_time', 'safe', 'on' => 'search'),
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
            'brand_id' => '品牌id',
            'brand_type_id' => '品牌分类',
            'name' => '品牌名称',
            'tag' => '品牌标签',
            'status' => '状态',
            'reach_amount' => '满减限定金额',
            'discount_amount' => '满减减少金额',
            'allowance_detail' => '银行补贴详情',
            'recommend_reason' => '推荐理由',
            'recommend_detail' => '推荐详情',
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
        $criteria->compare('reach_amount', $this->reach_amount);
        $criteria->compare('discount_amount', $this->discount_amount);
        $criteria->compare('allowance_detail', $this->allowance_detail, true);
        $criteria->compare('recommend_reason', $this->recommend_reason, true);
        $criteria->compare('recommend_detail', $this->recommend_detail, true);
        $criteria->compare('value_added_service', $this->value_added_service, true);
        $criteria->compare('image_path', $this->image_path, true);
        $criteria->compare('qualification_path', $this->qualification_path, true);
        $criteria->compare('create_time', $this->create_time, true);

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
     * 增值服务组
     */
    static function getValueAddedServiceItems() {
        return array(
            1 => '空调',
            2 => '咖啡',
            3 => '小零食',
            4 => '饮料',
        );
    }

    /**
     * 获取指定增值服务值
     * @param type $key
     * @return type
     */
    static function getValueAddedServiceItemsTitle($key) {
        $items = self::getValueAddedServiceItems();
        return isset($items[$key]) ? $items[$key] : Null;
    }

}
