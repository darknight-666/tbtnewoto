<?php

/**
 * This is the model class for table "{{voucher}}".
 *
 * The followings are the available columns in table '{{voucher}}':
 * @property string $voucher_id
 * @property integer $brand_id
 * @property integer $limit_quantity
 * @property integer $sell_quantity
 * @property double $face_value
 * @property double $price
 * @property integer $status
 * @property integer $discount_status
 * @property integer $image_path
 * @property string $tips
 * @property string $version_code
 * @property string $start_time
 * @property string $overdue_time
 * @property string $create_time
 * @property string $online_time
 * @property int $order_number
 * 
 */
class Voucher extends CActiveRecord {

    //STATUS
    const STATUS_NOTONLINE = 1; // 待上线
    const STATUS_ONLINE = 11; // 已上线
    const STATUS_SELLOUT = 12;
    const STATUS_LINEOFF = 21; // 已下线
    const STATUS_OVERDUE = 31; // 已过期
    //DISCOUNT_STATUS
    const DISCOUNT_STATUS_YES = 1; // 是否周三五折 1是 2否
    const DISCOUNT_STATUS_NO = 2; // 是否周三五折 1是 2否
    const DISCOUNT_DEFAULT_VALUE = 0.5; // 默认折扣
    //ORDERWAY
    const ORDERWAY_BY_ORDERNUMBER = 1; // 排序 - 智能排序
    const ORDERWAY_BY_DISTANCE = 2; // 排序 - 距离最近

    public $version_code_old; //老版本号
    public $parent_id; // 一级分类类别
    public $brand_type_id; // 二级分类类别
    public $pageSize = 10;

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
            array('brand_id, name, limit_quantity, sell_quantity, face_value, price, status, discount_status, image_path, tips,'
                . 'start_time, overdue_time, create_time, order_number, '
                . 'account_name, account_number, account_bank_name, account_bank_address', 'required'),
            array('brand_id, limit_quantity, sell_quantity, status, discount_status, order_number', 'numerical', 'integerOnly' => true),
            array('face_value, price', 'numerical'),
            array('name', 'length', 'max' => 20),
            array('version_code', 'length', 'max' => 20),
            array('image_path', 'length', 'max' => 255),
            array('parent_id, brand_type_id,', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('voucher_id, brand_id, limit_quantity, sell_quantity, face_value, price, status, discount_status, image_path, tips, '
                . 'start_time, overdue_time, create_time, online_time, order_number', 'safe', 'on' => 'search'),
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
            'limit_quantity' => '剩余数量',
            'sell_quantity' => '已售数量',
            'face_value' => '代金券面值',
            'price' => '价格',
            'status' => '状态',
            'discount_status' => '是否为周三五折',
            'image_path' => '代金券主图',
            'tips' => '使用提示',
            'start_time' => '有效期开始日',
            'overdue_time' => '有效期截止日',
            'order_number' => '排序号',
            'create_time' => '创建时间',
            'online_time' => '上线时间',
            'account_name' => '开户户名',
            'account_number' => '账号',
            'account_bank_name' => '开户行',
            'account_bank_address' => '账户地址',
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
//        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('face_value', $this->face_value);
        $criteria->compare('price', $this->price);
        $criteria->compare('status', $this->status);
        $criteria->compare('discount_status', $this->discount_status);
        $criteria->compare('tips', $this->tips, true);
        $criteria->compare('overdue_time', $this->overdue_time, true);
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
     * @return Voucher the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeValidate() {
        $this->create_time = !empty($this->create_time) ? $this->create_time : date('Y-m-d H:i:s');
        $this->online_time = !empty($this->online_time) ? $this->online_time : '0000-00-00 00:00:00';
        $this->version_code = !empty($this->version_code) ? $this->version_code : My::microtime(); // 每次更新强制更新版本号
        $this->status = !empty($this->status) ? $this->status : self::STATUS_NOTONLINE;
        if ($this->status == self::STATUS_ONLINE && $this->limit_quantity == 0) {
            $this->status = self::STATUS_SELLOUT;
        }
        if ($this->status == self::STATUS_SELLOUT && $this->limit_quantity > 0) {
            $this->status = self::STATUS_ONLINE;
        }

        return parent::beforeValidate();
    }

    public function afterValidate() {
        $this->start_time = !empty($this->start_time) ? $this->start_time . ' 00:00:00' : $this->start_time;
        $this->overdue_time = !empty($this->overdue_time) ? $this->overdue_time . ' 23:59:59' : $this->overdue_time;
        return parent::afterValidate();
    }

    /**
     * 检测版本号并
     */
    public function updateWithCheckVersion() {
        $this->version_code_old = $this->version_code;
        $this->version_code = My::microtime(); // 变更新版本号
        return $this->updateByPk($this->voucher_id, $this->attributes, 'version_code=:version_code_old', array(':version_code_old' => $this->version_code_old));
    }

    /**
     * 状态组
     * @return type
     */
    static function getStatusItems() {
        return array(
            self::STATUS_NOTONLINE => '未上线',
            self::STATUS_ONLINE => '已上线',
            self::STATUS_SELLOUT => '已售罄',
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

    /**
     * 获取当前排序号最大值
     */
    static function getMaxOrderNumber() {
        $sql = "SELECT MAX(order_number) AS max_order_number FROM `oto_voucher`";
        $data = DBTools::queryOne($sql);
        return $data['max_order_number'];
    }

    /**
     * 获取tips - 数组
     * @param type $tips
     * @return type
     */
    static function getTipsByArray($tips) {
        $tips = trim($tips);
        return explode("\r\n", $tips);
    }

}
