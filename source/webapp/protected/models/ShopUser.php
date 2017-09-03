<?php

/**
 * This is the model class for table "{{shop_user}}".
 *
 * The followings are the available columns in table '{{shop_user}}':
 * @property string $id
 * @property string $shop_id
 * @property string $username
 * @property string $phonenumber
 * @property string $password
 * @property string $salt
 * @property integer $status
 * @property string $realname
 * @property string $reg_time
 * @property string $last_login_time
 */
class ShopUser extends CActiveRecord {

    const STATUS_WAITCONFIRM = 1; //待审核
    const STATUS_CONFIRMED = 11; //已通过
    const STATUS_DELETED = 21; //已注销

    public $brand_id;
    public $oldPassword;
    public $newPassword; // 新密码
    public $code; // 短信验证码
    public $pageSize = 10;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{shop_user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('brand_id', 'safe'),
            array('shop_id, phonenumber, status, reg_time, last_login_time', 'required'),
            array('code', 'checkCode', 'on' => array('register', 'forgetPassword')),
            array('oldPassword, newPassword', 'verifyPassword', 'on' => array('changePassword')),
            array('phonenumber, username', 'unique', 'message' => '此{attribute}已经被注册'),
            array('phonenumber', 'match', 'pattern' => '/^[1][3458][0-9]{9}$/', 'message' => '请填写正确的手机号码'),
            array('status', 'numerical', 'integerOnly' => true),
            array('shop_id, phonenumber', 'length', 'max' => 11),
            array('username, realname', 'length', 'max' => 20),
            array('password', 'length', 'max' => 40),
            array('salt', 'length', 'max' => 6),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, shop_id, username, phonenumber, password, salt, status, realname, reg_time, last_login_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'shop' => array(self::BELONGS_TO, 'Shop', 'shop_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => '用户id',
            'shop_id' => '门店',
            'username' => '用户名',
            'phonenumber' => '手机号',
            'password' => '密码',
            'salt' => '盐值',
            'status' => '状态 1待审核 2已开通 3已注销',
            'realname' => '真实姓名',
            'reg_time' => '注册时间',
            'last_login_time' => '最后一次登录时间',
            'brand_id' => '品牌',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('shop_id', $this->shop_id, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('phonenumber', $this->phonenumber, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('salt', $this->salt, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('realname', $this->realname, true);
        $criteria->compare('reg_time', $this->reg_time, true);
        $criteria->compare('last_login_time', $this->last_login_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => $this->pageSize,
            ),
        ));
    }

    /**
     * 
     * @return type
     */
    public function beforeValidate() {
        $this->reg_time = date('Y-m-d H:i:s');
        $this->last_login_time = date('Y-m-d H:i:s');
        $this->status = !empty($this->status) ? $this->status : self::STATUS_CONFIRMED;
        $this->username = !empty($this->username) ? $this->username : $this->phonenumber;
        return parent::beforeValidate();
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ShopUser the static model class
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
            self::STATUS_WAITCONFIRM => '待审核',
            self::STATUS_CONFIRMED => '已通过',
            self::STATUS_DELETED => '已注销',
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
     * checkcode
     * @param type $attribute
     * @param type $param
     */
    public function checkCode($attribute, $param) {
        $shortMessageServer = new ShortMessageService();
        $codeType = '';
        if ($this->getScenario() == 'register') {
            $codeType = MessageCodeType::$register;
        }
        if ($this->getScenario() == 'forgetPassword') {
            $codeType = MessageCodeType::$forgetPassword;
        }
        $ret = $shortMessageServer->checkMessageCode($this->phonenumber, $this->code, $codeType, FALSE);
        if ($ret != ShortMessageService::ERROR_NONE) {
            if ($ret == ShortMessageService::ERROR_CODE_INVALID) {
                $this->addError($attribute, '短信验证码错误');
            }
            if ($ret == ShortMessageService::ERROR_CODE_TIMEOUT) {
                $this->addError($attribute, '短信验证码过期，请重新获取');
            }
        }
    }

    /**
     * return password after sha1
     * @param type $password
     * @return type
     */
    public function makePassword($password) {
        return sha1(md5($password . $this->salt));
    }

    /**
     * checkPassword
     * @param type $password
     * @return type
     */
    public function checkPassword($password) {
        return $this->password == $this->makePassword($password) ? TRUE : FALSE;
    }

    public function verifyPassword($attribute, $param) {
        if ($this->checkPassword($this->oldPassword) != TRUE) {
            $this->addError($attribute, '旧密码错误');
        }
        if ($this->newPassword == $this->oldPassword) {
            $this->addError($attribute, '新旧密码不可一致');
        }
    }

    /**
     * make Salt value
     * @return type
     */
    public static function makeSalt() {
        return substr(uniqid(rand()), -6);
    }

}
