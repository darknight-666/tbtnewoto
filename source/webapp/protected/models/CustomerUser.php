<?php

/**
 * This is the model class for table "{{customer_user}}".
 *
 * The followings are the available columns in table '{{customer_user}}':
 * @property string $id
 * @property string $username
 * @property string $phonenumber
 * @property string $password
 * @property integer $salt
 * @property string $realname
 * @property string $reg_time
 * @property string $last_login_time
 */
class CustomerUser extends CActiveRecord {

    public $code; // 短信验证码

    /**
     * @return string the associated database table name
     */

    public function tableName() {
        return '{{customer_user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('salt, reg_time, last_login_time', 'required'),
            array('code', 'checkCode', 'on' => 'register'),
            array('phonenumber, username', 'unique', 'message' => '此{attribute}已经被注册'),
            array('phonenumber', 'match', 'pattern' => '/^[1][3458][0-9]{9}$/', 'message' => '请填写正确的手机号码'),
            array('username, realname', 'length', 'max' => 20),
            array('phonenumber', 'length', 'max' => 11),
            array('password', 'length', 'max' => 40),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, phonenumber, password, salt, realname, reg_time, last_login_time', 'safe', 'on' => 'search'),
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
            'id' => '用户id',
            'username' => '用户名',
            'phonenumber' => '手机号',
            'password' => '密码',
            'salt' => '盐值',
            'realname' => '真实姓名',
            'reg_time' => '注册时间',
            'last_login_time' => '最后一次登录时间',
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
        $criteria->compare('username', $this->username, true);
        $criteria->compare('phonenumber', $this->phonenumber, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('salt', $this->salt);
        $criteria->compare('realname', $this->realname, true);
        $criteria->compare('reg_time', $this->reg_time, true);
        $criteria->compare('last_login_time', $this->last_login_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * 
     * @return type
     */
    public function beforeValidate() {
        $this->reg_time = date('Y-m-d H:i:s');
        $this->last_login_time = date('Y-m-d H:i:s');
        $this->username = !empty($this->username) ? $this->username : $this->phonenumber;
        return parent::beforeValidate();
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CustomerUser the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    /**
     * checkcode
     * @param type $attribute
     * @param type $param
     */
    public function checkCode($attribute, $param) {
        $shortMessageServer = new ShortMessageService();
        $ret = $shortMessageServer->checkMessageCode($this->phonenumber, $this->code, MessageCodeType::$register, FALSE);
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

    /**
     * make Salt value
     * @return type
     */
    public static function makeSalt() {
        return substr(uniqid(rand()), -6);
    }

}
