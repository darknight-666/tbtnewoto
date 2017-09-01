<?php

/**
 * This is the model class for table "{{voucher_code}}".
 *
 * The followings are the available columns in table '{{voucher_code}}':
 * @property string $voucher_code_id
 * @property string $voucher_code_number
 * @property integer $order_id
 * @property integer $voucher_id
 * @property double $price
 * @property integer $status
 * @property string $refund_time
 * @property string $used_time
 * @property string $start_time
 * @property string $overdue_time
 */
class VoucherCode extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{voucher_code}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, voucher_id, price, status, refund_time, used_time, start_time, overdue_time', 'required'),
			array('order_id, voucher_id, status', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('voucher_code_number', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('voucher_code_id, voucher_code_number, order_id, voucher_id, price, status, refund_time, used_time, start_time, overdue_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'voucher_code_id' => '券码id',
			'voucher_code_number' => '券码',
			'order_id' => '订单id',
			'voucher_id' => '代金券id',
			'price' => '价格',
			'status' => '状态 1未使用，11已使用 21退款中 31已退款',
			'refund_time' => '退款时间',
			'used_time' => '使用时间',
			'start_time' => '开始时间',
			'overdue_time' => '过期时间',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('voucher_code_id',$this->voucher_code_id,true);
		$criteria->compare('voucher_code_number',$this->voucher_code_number,true);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('voucher_id',$this->voucher_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('status',$this->status);
		$criteria->compare('refund_time',$this->refund_time,true);
		$criteria->compare('used_time',$this->used_time,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('overdue_time',$this->overdue_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VoucherCode the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
