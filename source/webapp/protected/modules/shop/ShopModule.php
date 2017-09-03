<?php

class ShopModule extends CWebModule {
    public function init() {
        $this->layout = 'shop.views.layouts.main';
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'shop.models.*',
            'shop.components.*',
        ));
        yii::app()->setComponents(array(
            'user' => array(
                'class' => 'ShopWebUser',
                'allowAutoLogin' => true,
                'stateKeyPrefix' => 'shop_',
                'loginUrl' => array('/shop/default/login')
            ),
            'errorHandler' => array(
                'errorAction' => 'shop/default/error',
            ),
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }

}
