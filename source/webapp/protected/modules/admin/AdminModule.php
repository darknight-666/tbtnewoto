<?php

class AdminModule extends BaseMoudle {

    public function init() {
        $this->layout = 'admin.views.layouts.main';
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
        ));
        yii::app()->setComponents(array(
            'user' => array(
                'class' => 'AdminWebUser',
                'allowAutoLogin' => true,
                'stateKeyPrefix' => 'admin_',
                'loginUrl' => array('/admin/default/login')
            ),
            'errorHandler' => array(
                'errorAction' => 'admin/default/error',
            ),
        ));
        $this->menus = array(
            array(
                'label' => '品牌管理',
                'url' => 'javascript:;',
                'number' => 0,
                'fa_img' => 'fa-th',
                'itemOptions' => array('name' => 'default'),
                'items' => array(
                    array(
                        'label' => '分类管理',
                        'url' => array('/admin/brand/typeList'),
                        'number' => 0,
                        'itemOptions' => array('name' => 'brand.typeList', 'class' => 'second-parent'),
                    ),
                    array(
                        'label' => '品牌列表',
                        'url' => array('/admin/brand/list'),
                        'number' => 0,
                        'itemOptions' => array('name' => 'brand.list', 'class' => 'second-parent'),
                    ),
                    array(
                        'label' => '品牌TAG',
                        'url' => array('/admin/brand/tagList'),
                        'number' => 0,
                        'itemOptions' => array('name' => 'brand.tagList', 'class' => 'second-parent'),
                    ),
                    array(
                        'label' => '增值服务',
                        'url' => array('/admin/brand/valueAddedServiceList'),
                        'number' => 0,
                        'itemOptions' => array('name' => 'brand.valueAddedServiceList', 'class' => 'second-parent'),
                    ),
                ),
            ),
            array(
                'label' => '产品管理',
                'url' => 'javascript:;',
                'number' => 0,
                'fa_img' => 'fa-th',
                'itemOptions' => array('name' => 'default'),
                'items' => array(
                    array(
                        'label' => '代金券列表',
                        'url' => array('/admin/voucher/list'),
                        'number' => 0,
                        'itemOptions' => array('name' => 'voucher.list', 'class' => 'second-parent'),
                    ),
                ),
            ),
            array(
                'label' => '订单管理',
                'url' => 'javascript:;',
                'number' => 0,
                'fa_img' => 'fa-th',
                'itemOptions' => array('name' => 'default'),
                'items' => array(
                    array(
                        'label' => '订单列表',
                        'url' => array('/admin/order/list'),
                        'number' => 0,
                        'itemOptions' => array('name' => 'order.list', 'class' => 'second-parent'),
                    ),
                    array(
                        'label' => '订单详情',
                        'url' => array('/admin/order/detail'),
                        'number' => 0,
                        'itemOptions' => array('name' => 'order.detail', 'class' => 'second-parent'),
                    ),
                ),
            ),
            array(
                'label' => '结算数据',
                'url' => 'javascript:;',
                'number' => 0,
                'fa_img' => 'fa-th',
                'itemOptions' => array('name' => 'default'),
                'items' => array(
                    array(
                        'label' => '结算数据列表',
                        'url' => array('/admin/settlement/list'),
                        'number' => 0,
                        'itemOptions' => array('name' => 'settlement.list', 'class' => 'second-parent'),
                    ),
                    array(
                        'label' => '结算数据详情',
                        'url' => array('/admin/settlement/detail'),
                        'number' => 0,
                        'itemOptions' => array('name' => 'settlement.detail', 'class' => 'second-parent'),
                    ),
                ),
            ),
            array(
                'label' => '商户账户管理',
                'url' => 'javascript:;',
                'number' => 0,
                'fa_img' => 'fa-th',
                'itemOptions' => array('name' => 'default'),
                'items' => array(
                    array(
                        'label' => '商户账户列表',
                        'url' => array('/admin/shopUser/list'),
                        'number' => 0,
                        'itemOptions' => array('name' => 'shopUser.list', 'class' => 'second-parent'),
                    ),
                    array(
                        'label' => '商户账户新增',
                        'url' => array('/admin/shopUser/add'),
                        'number' => 0,
                        'itemOptions' => array('name' => 'shopUser.add', 'class' => 'second-parent'),
                    ),
                ),
            ),
            array(
                'label' => '我的信息',
                'url' => 'javascript:;',
                'number' => isset($newData['default']['number']) ? $newData['default']['number'] : 0,
                'fa_img' => 'fa-th',
                'itemOptions' => array('name' => 'default'),
                'items' => array(
                    array(
                        'label' => '我的信息',
                        'url' => array('/admin/default/index'),
                        'number' => isset($newData['default']['itmes']['admin']) ? $newData['default']['itmes']['admin'] : 0,
                        'itemOptions' => array('name' => 'default.index', 'class' => 'second-parent'),
                    ),
                ),
            ),
        );
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }

    public function getName() {
        return "OTO交易网络平台清算运营系统（版本：V1.0）";
    }

}
