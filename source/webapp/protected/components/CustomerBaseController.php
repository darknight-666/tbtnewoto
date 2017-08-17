<?php

/**
 * Customer 模块基础类
 */
class CustomerBaseController extends Controller {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '';
    public $params = array();

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

    public function init() {
        Yii::app()->setComponent('session', array('autoStart' => false));
        parent::init();
        Yii::app()->session->setCookieMode('allow');
        @Yii::app()->session->setUseTransparentSessionID(true);
        $this->params = (Yii::app()->request->getParam('params')) ? Yii::app()->request->getParam('params') : $this->params;
        $this->params['page'] = empty($this->params['page']) ? 1 : $this->params['page'];
        $this->params['page_size'] = empty($this->params['page_size']) ? 10 : intval($this->params['page_size']);
        $session_id = Yii::app()->request->getParam('session_id');
        if ($session_id) {
            Yii::app()->session->setSessionID($session_id);
            Yii::app()->session->open();
        }
        Yii::app()->session->open();

        $url = substr(Yii::app()->request->getUrl(), 0, strpos(Yii::app()->request->getUrl(), '?'));

        Yii::log('', CLogger::LEVEL_PROFILE, 'newapi');
        Yii::log('SESSION_ID:' . $session_id, CLogger::LEVEL_PROFILE, 'newapi');
        Yii::log('url地址:' . $url, CLogger::LEVEL_PROFILE, 'newapi');
        Yii::log('参数:' . json_encode($this->params, JSON_UNESCAPED_UNICODE), CLogger::LEVEL_PROFILE, 'newapi');
    }

    public function checkLogin() {
        if (Yii::app()->user->isGuest === true) {
            $this->output('', ApiStatusCode::$isGuest, '登录已失效，请重新登录');
        }
    }

    /**
     * 参数检测
     * @param type $items
     */
    public function checkParams($items) {
        if (isset($items['empty'])) {
            foreach ($items['empty'] as $item) {
                if (empty($this->params[$item])) {
                    Yii::log('缺少参数:' . '   ' . $item, CLogger::LEVEL_PROFILE, 'newapi');
                    $this->output('error', ApiStatusCode::$paramsAbsent, '缺少必要参数');
                }
            }
        }
        if (isset($items['isset'])) {
            foreach ($items['isset'] as $item) {
                if (!isset($this->params[$item])) {
                    Yii::log('缺少参数:' . '   ' . $item, CLogger::LEVEL_PROFILE, 'newapi');
                    $this->output('error', ApiStatusCode::$paramsAbsent, '缺少必要参数');
                }
            }
        }
    }

    /**
     * 输出
     * @param type $data
     * @param type $status
     * @param type $message
     */
    public function output($data, $status = 10000, $message = "") {
        My::output($data, $status, $message);
    }

}
