<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminBaseController extends RController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function filters() {
        return array(
            'rights',
        );
    }

    public function init() {
        parent::init();
    }

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'MyCaptchaAction',
                'backColor' => 0xFFFFFF, //背景颜色
                'minLength' => 4, //最短为4位
                'maxLength' => 4, //是长为4位
                'transparent' => true, //显示为透明，当关闭该选项，才显示背景颜色
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function output($data, $status = 10000, $message = "") {
        My::output($data, $status, $message);
    }
    
    /**
     * 异步上传
     * @param type $type
     * @param type $path
     * @return boolean
     */
    public function actionIframeUploadWithField($type = 'images', $path = '') {
        if (empty($path)) {
            return false;
        }
        $model = new FormIframeUpload($type);
        $model->field = @$_REQUEST['FormIframeUpload']['field'];
        $ret = array('status' => ApiStatusCode::$error, 'url' => '', 'message' => '无上传文件');
        if (isset($_FILES['FormIframeUpload'])) {
            if ($model->validate()) {
                $model->attributes = $model->constructionFiles($path); //处理上传
                if (!empty($model->fileField)) {//上传成功
                    $ret = array('status' => ApiStatusCode::$ok, 'url' => json_encode($model->attributes), 'message' => $model->originName . '上传成功');
                    $this->render('//site/iframeupload', array(
                        'items' => $ret,
                    ));
                    Yii::app()->end();
                }
            } else {//文件验证不通过
                $ret = array('status' => ApiStatusCode::$error, 'url' => json_encode($model->attributes), 'message' => $model->getError('fileField'));
                $this->render('//site/iframeupload', array(
                    'items' => $ret,
                ));
                Yii::app()->end();
            }
        }
        $this->render('//site/iframeupload', array(
            'items' => $ret,
        ));
    }

}
