<?php

/**
 * 通用文件上传iframe方式
 */
class FormIframeUpload extends CFormModel {

    public $field; //前端字段名
    public $fileField; //储存文件上传后的路径
    public $originName; //储存文件原始文件名

    public function rules() {
        return array(
            array('field, fileField, originName', 'safe'),
            array(
                'fileField',
                'file',
                'allowEmpty' => true,
                'types' => 'pdf',
                'maxSize' => 1024 * 1024 * 20, //20MB
                'tooLarge' => '文件大于20M，上传失败！请上传小于20M的文件！',
                'on' => 'pdf'
            ), //PDF文件检验
            array(
                'fileField',
                'file',
                'allowEmpty' => true,
                'types' => 'jpg,jpeg,png,gif',
                'maxSize' => 1024 * 1024 * 2, //20MB
                'tooLarge' => '图片大于2M，上传失败！请上传小于2M的图片！',
                'on' => 'images'
            ), //images文件检验
            array(
                'fileField',
                'file',
                'allowEmpty' => true,
                'types' => 'jpg',
                'maxSize' => 1024 * 200, //200kb
                'tooLarge' => '图片大于200KB，上传失败！请上传小于200KB的图片！',
                'on' => 'images_jpg_200kb' // 图片_格式_大小
            ), //images文件检验
        );
    }

    /**
     * 处理PDF文件
     */
    public function constructionFiles($path) {
        if (empty($path)) {
            $this->attributes;
        }

        $file = CUploadedFile::getInstance($this, 'fileField');
        if (is_object($file) && get_class($file) === 'CUploadedFile') {
            $this->fileField = $path . date('YmdHis') . '_' . rand(0, 999999) . '.' . $file->extensionName;
            $this->originName = $file->name;
            $savePath = $this->upLoadFilePath($this->fileField);
            $file->saveAs($savePath);
        }
        return $this->attributes;
    }

    /**
     * 上传文件路径处理
     * 
     */
    public function upLoadFilePath($url) {
        if (!empty($url)) {
            $dir = Yii::getPathOfAlias('webroot') . dirname($url); //if havn't dir then make dir

            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            $path = Yii::getPathOfAlias('webroot') . $url;
            return $path;
        }
    }

    public function attributeLabels() {
        return array(
            'fileField' => '文件',
        );
    }

}
