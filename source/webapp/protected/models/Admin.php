<?php

/**
 * This is the model class for table "{{oto_admin}}".
 *
 * The followings are the available columns in table '{{oto_admin}}':
 * @property string $id
 * @property string $name
 * @property string $password
 * @property string $salt
 * @property string $phonenumber
 * @property string $realname
 * @property string $last_login_time
 */
class Admin extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{admin}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('last_login_time', 'required'),
            array('username, realname', 'length', 'max' => 20),
            array('password', 'length', 'max' => 40),
            array('salt', 'length', 'max' => 6),
            array('phonenumber', 'length', 'max' => 11),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password, salt, phonenumber, realname, last_login_time', 'safe', 'on' => 'search'),
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
            'id' => '系统管理员id',
            'username' => '用户名',
            'password' => '密码',
            'salt' => '密码盐值',
            'phonenumber' => '手机号',
            'realname' => '用户真实姓名',
            'last_login_time' => '最后一次登陆时间',
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
        $criteria->compare('password', $this->password, true);
        $criteria->compare('salt', $this->salt, true);
        $criteria->compare('phonenumber', $this->phonenumber, true);
        $criteria->compare('realname', $this->realname, true);
        $criteria->compare('last_login_time', $this->last_login_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
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
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Admin the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
