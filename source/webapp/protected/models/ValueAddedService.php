<?php

/**
 * This is the model class for table "{{value_added_service}}".
 *
 * The followings are the available columns in table '{{value_added_service}}':
 * @property string $value_added_service_id
 * @property string $name
 * @property string $image_path
 */
class ValueAddedService extends CActiveRecord {

    public $pageSize = 999;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{value_added_service}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'length', 'max' => 10),
            array('image_path', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('value_added_service_id, name, image_path', 'safe', 'on' => 'search'),
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
            'value_added_service_id' => '增值服务id',
            'name' => '服务名称',
            'image_path' => '图标路径',
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

        $criteria->compare('value_added_service_id', $this->value_added_service_id, true);
//        $criteria->compare('name', $this->name, true);
//        $criteria->compare('image_path', $this->image_path, true);
        $criteria->order = 'value_added_service_id desc';
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
     * @return ValueAddedService the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 获取所有增值服务
     */
    public static function getAll() {
        $model = self::model();
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        return $list;
    }

    /**
     * 获取所有增值服务 - listData
     */
    public static function getAllByListData() {
        $data = self::getAll();
        return CHtml::listData($data, 'value_added_service_id', 'name');
    }

    /**
     * 根据id获取增值服务列表
     * @param type $id
     * @return type
     */
    static function getAllByTagId($id) {
        if (empty($id)) {
            return array();
        }
        $id = is_array($id) ? $id : explode(',', $id);
        $model = self::model();
        $model->value_added_service_id = $id;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        return $list;
    }

    /**
     * 根据id获取增值服务列表 - 数组数据
     * @param type $id
     * @return type
     */
    static function getAllByIdByArray($id) {
        $list = self::getAllByTagId($id);
        $data = array();
        foreach ($list as $obj) {
            $data[] = $obj->attributes;
        }
        return $data;
    }

}
