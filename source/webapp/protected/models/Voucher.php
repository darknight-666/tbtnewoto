<?php

/**
 * This is the model class for table "{{voucher}}".
 *
 * The followings are the available columns in table '{{voucher}}':
 * @property string $voucher_id
 * @property integer $brand_id
 * @property integer $quantity
 * @property double $face_value
 * @property double $price
 * @property integer $status
 * @property integer $discount_status
 * @property double $discount
 * @property string $tips
 * @property string $overdue_time
 * @property string $create_time
 */
class Voucher extends CActiveRecord {

    const STATUS_NOTONLINE = 1; // 待上线
    const STATUS_ONLINE = 11; // 已上线
    const STATUS_LINEOFF = 21; // 已下线
    const STATUS_OVERDUE = 31; // 已过期
    const DISCOUNT_STATUS_YES = 1; // 是否周三五折 1是 2否
    const DISCOUNT_STATUS_NO = 2; // 是否周三五折 1是 2否
    const DISCOUNT_DEFAULT_VALUE = 0.5; // 默认折扣

    public $parent_id; // 一级分类类别
    public $brand_type_id; // 二级分类类别

    /**
     * @return string the associated database table name
     */

    public function tableName() {
        return '{{voucher}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('brand_id, name, quantity, face_value, price, status, discount_status, discount, tips, overdue_time, create_time', 'required'),
            array('brand_id, quantity, status, discount_status', 'numerical', 'integerOnly' => true),
            array('face_value, price, discount', 'numerical'),
            array('name', 'length', 'max' => 20),
            array('parent_id, brand_type_id,', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('voucher_id, brand_id, quantity, face_value, price, status, discount_status, discount, tips, overdue_time, create_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'voucher_id' => '代金券id',
            'brand_id' => '品牌',
            'name' => '代金券名称',
            'quantity' => '数量',
            'face_value' => '优惠券面值',
            'price' => '价格',
            'status' => '状态',
            'discount_status' => '是否为周三五折',
            'discount' => '周三打折值',
            'tips' => '使用提示',
            'overdue_time' => '有效期',
            'create_time' => '创建时间',
            'brand_type_id' => '品牌分类',
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

        $criteria->compare('voucher_id', $this->voucher_id, true);
        $criteria->compare('brand_id', $this->brand_id);
        $criteria->compare('name', $this->name);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('face_value', $this->face_value);
        $criteria->compare('price', $this->price);
        $criteria->compare('status', $this->status);
        $criteria->compare('discount_status', $this->discount_status);
        $criteria->compare('discount', $this->discount);
        $criteria->compare('tips', $this->tips, true);
        $criteria->compare('overdue_time', $this->overdue_time, true);
        $criteria->compare('create_time', $this->create_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Voucher the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeValidate() {
        $this->create_time = !empty($this->create_time) ? $this->create_time . ' 23:59:59' : date('Y-m-d H:i:s');
        $this->overdue_time = !empty($this->overdue_time) ? $this->overdue_time : '0000-00-00 00:00:00';
        $this->status = !empty($this->status) ? $this->status : self::STATUS_NOTONLINE;
        if ($this->discount_status == self::DISCOUNT_STATUS_YES) {
            $this->discount = self::DISCOUNT_DEFAULT_VALUE;
        } else {
            $this->discount = 1;
        }
        return parent::beforeValidate();
    }

    public function afterValidate() {
        $this->overdue_time = $this->overdue_time != '0000-00-00 00:00:00' ? $this->overdue_time : '';
        return parent::afterValidate();
    }

    /**
     * 状态组
     * @return type
     */
    static function getStatusItems() {
        return array(
            self::STATUS_NOTONLINE => '未上线',
            self::STATUS_ONLINE => '已上线',
            self::STATUS_LINEOFF => '已下线',
            self::STATUS_OVERDUE => '已过期',
        );
    }

    /**
     * 获取指定状态title
     * @param type $key
     * @return type
     */
    static function getStatusTitle($key) {
        $items = self::getStatusItems();
        return isset($items[$key]) ? $items[$key] : Null;
    }

    /**
     * 周三五折状态组
     * @return type
     */
    static function getDiscountStatusItems() {
        return array(
            self::DISCOUNT_STATUS_YES => '是',
            self::DISCOUNT_STATUS_NO => '否'
        );
    }

    /**
     * 获取指定周三五折状态title
     * @param type $key
     * @return type
     */
    static function getDiscountStatusTitle($key) {
        $items = self::getDiscountStatusItems();
        return isset($items[$key]) ? $items[$key] : Null;
    }

}
