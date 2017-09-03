<?php

/**
 * This is the model class for table "{{order_voucher}}".
 *
 * The followings are the available columns in table '{{order_voucher}}':
 * @property string $order_id
 * @property string $voucher_id
 * @property integer $quantity
 * @property double $price
 */
class OrderVoucher extends CActiveRecord {

    public $pageSize = 999;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{order_voucher}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('order_id, voucher_id, quantity, price', 'required'),
            array('quantity', 'numerical', 'integerOnly' => true),
            array('price', 'numerical'),
            array('order_id, voucher_id', 'length', 'max' => 11),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('order_id, voucher_id, quantity, price', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'voucher' => array(self::BELONGS_TO,'Voucher','voucher_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'order_id' => '订单id',
            'voucher_id' => '代金券id',
            'quantity' => '购买数量',
            'price' => '价格',
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

        $criteria->compare('order_id', $this->order_id, true);
        $criteria->compare('voucher_id', $this->voucher_id, true);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('price', $this->price);

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
     * @return OrderVoucher the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
