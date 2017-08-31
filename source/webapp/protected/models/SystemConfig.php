<?php

/**
 * This is the model class for table "{{system_config}}".
 *
 * The followings are the available columns in table '{{system_config}}':
 * @property string $name
 * @property string $value
 * @property string $description
 */
class SystemConfig extends CActiveRecord {

    //常用系统常量配置
    const SYSTEM_DATE = 'SYSTEM_DATE';
    //星期几对应的值
    const SYSTEM_WEEK_SUNDAY = 0; // 周日
    const SYSTEM_WEEK_MONDAY = 1; // 周一
    const SYSTEM_WEEK_TUESDAY = 2; // 周二
    const SYSTEM_WEEK_WEDNESDAY = 3; // 周三
    const SYSTEM_WEEK_THURSDAY = 4; // 周四
    const SYSTEM_WEEK_FRIDAY = 5; // 周五
    const SYSTEM_WEEK_SATURDAY = 6; // 周六

    /**
     * @return string the associated database table name
     */

    public function tableName() {
        return '{{system_config}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, value, description', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('name, value, description', 'safe', 'on' => 'search'),
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
            'name' => '配置项名称',
            'value' => '配置项值',
            'description' => '配置项描述',
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

        $criteria->compare('name', $this->name, true);
        $criteria->compare('value', $this->value, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SystemConfig the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 系统日期更新
     */
    static function systemDateFlush() {
        $model = self::model()->findByPk(self::SYSTEM_DATE);
        if (empty($model)) {
            $model = new SystemConfig();
            $model->name = self::SYSTEM_DATE;
            $model->value = date('Y-m-d');
            $model->description = '系统日期';
            $model->save();
        } else {
            if (YII_TBTENV != 1) { //非生产环境，每次自动加1
                $model->value = date('Y-m-d', strtotime($model->value . " +1 day"));
            } else { // 生产环境 日期与系统时间取齐
                $model->value = date('Y-m-d');
            }
            $model->save();
        }
    }

    /**
     * 获取系统日期
     */
    static function systemDate() {
        $model = self::model()->findByPk(self::SYSTEM_DATE);
        return $model->value;
    }

    /**
     * 获取系统星期几
     * 0123456
     * 0代表周日
     */
    static function systemWeek() {
        return date('w', strtotime(self::systemDate()));
    }

}
