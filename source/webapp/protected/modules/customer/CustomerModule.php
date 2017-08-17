<?php

class CustomerModule extends CWebModule {

    public function init() {
        $this->layout = 'customer.views.layouts.main';
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
        ));
        yii::app()->setComponents(array(
            'user' => array(
                'class' => 'CustomerWebUser',
                'allowAutoLogin' => true,
                'stateKeyPrefix' => 'customer_',
                'loginUrl' => array('/customer/default/login')
            ),
            'errorHandler' => array(
                'errorAction' => 'customer/default/error',
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
