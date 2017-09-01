<?php

/**
 * This is the model class for table "{{order}}".
 *
 * The followings are the available columns in table '{{order}}':
 * @property string $order_id
 * @property integer $customer_user_id
 * @property string $pay_serial_number
 * @property double $amount
 * @property double $amount_paid
 * @property integer $status
 * @property string $pay_time
 * @property string $create_time
 */
class Order extends CActiveRecord {

    const STATUS_WATINGPAY = 1; // 待付款
    const STATUS_PAID = 11;  // 已付款
    const STATUS_OVERDUE = 21; //已失效

    public $pageSize = 10;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{order}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('customer_user_id, amount, amount_paid, status, pay_time, create_time', 'required'),
            array('customer_user_id, status', 'numerical', 'integerOnly' => true),
            array('amount, amount_paid', 'numerical'),
            array('pay_serial_number', 'length', 'max' => 60),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('order_id, customer_user_id, pay_serial_number, amount, amount_paid, status, pay_time, create_time', 'safe', 'on' => 'search'),
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
            'order_id' => '订单id',
            'customer_user_id' => '客户用户id',
            'pay_serial_number' => '支付流水号',
            'amount' => '金额',
            'amount_paid' => '应付金额',
            'status' => '订单状态 1待付款 11已付款 21已失效',
            'pay_time' => '付款时间',
            'create_time' => '创建时间',
        );
    }

    public function beforeValidate() {
        $this->pay_time = !empty($this->pay_time) ? $this->pay_time : '0000-00-00 00:00:00';
        $this->create_time = !empty($this->create_time) ? $this->create_time : date('Y-m-d H:i:s');
        $this->status = !empty($this->status) ? $this->status : self::STATUS_WATINGPAY;
        return parent::beforeValidate();
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

        $criteria->compare('order_id', $this->order_id, true);
        $criteria->compare('customer_user_id', $this->customer_user_id);
        $criteria->compare('pay_serial_number', $this->pay_serial_number, true);
        $criteria->compare('amount', $this->amount);
        $criteria->compare('amount_paid', $this->amount_paid);
        $criteria->compare('status', $this->status);
        $criteria->compare('pay_time', $this->pay_time, true);
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
     * @return Order the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 状态组
     * @return type
     */
    static function getStatusItems() {
        return array(
            self::STATUS_WATINGPAY => '待付款',
            self::STATUS_PAID => '已付款',
            self::STATUS_OVERDUE => '已失效'
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
     * 生成订单
     */
    static function orderCreate(Voucher $voucherModel, $quantity, $userId) {
        $model = new Order();
        $model->customer_user_id = $userId;
        $model->amount = $voucherModel->price * $quantity;
        $model->amount_paid = $model->amount;
        $model->save();
        $modelOrderVoucher = new OrderVoucher();
        $modelOrderVoucher->order_id = $model->order_id;
        $modelOrderVoucher->voucher_id = $voucherModel->voucher_id;
        $modelOrderVoucher->quantity = $quantity;
        $modelOrderVoucher->price = $voucherModel->price;
        $modelOrderVoucher->save();
        return $model->order_id;
    }

}
