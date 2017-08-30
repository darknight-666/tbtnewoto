<?php

/**
 * This is the model class for table "{{tag}}".
 *
 * The followings are the available columns in table '{{tag}}':
 * @property string $tag_id
 * @property string $name
 */
class Tag extends CActiveRecord {

    public $pageSize = 999;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{tag}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('tag_id, name', 'safe', 'on' => 'search'),
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
            'tag_id' => '品牌tagID',
            'name' => '品牌tag名称',
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

        $criteria->compare('tag_id', $this->tag_id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->order = 'tag_id desc';
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
     * @return Tag the static model class
     */
    static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 获取所有tag
     */
    static function getAll() {
        $model = self::model();
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        return $list;
    }

    /**
     * 获取所有tag - listData
     * @param type $adcode
     * @return type
     */
    static function getAllByListData() {
        $data = self::getAll();
        return CHtml::listData($data, 'tag_id', 'name');
    }

    /**
     * 根据tagId获取tag列表
     * @param type $tagId
     * @return type
     */
    static function getAllByTagId($tagId) {
        if (empty($tagId)) {
            return array();
        }
        $tagId = is_array($tagId) ? $tagId : explode(',', $tagId);
        $model = self::model();
        $model->tag_id = $tagId;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        return $list;
    }
    
    /**
     * 根据tagId获取tag列表 - 数组数据
     * @param type $tagId
     * @return type
     */
    static function getAllByTagIdByArray($tagId) {
        $list = self::getAllByTagId($tagId);
        $data = array();
        foreach ($list as $obj) {
            $data[] = $obj->attributes;
        }
        return $data;
    }

}
