<?php

/**
 * 品牌类
 */
class BrandController extends AdminBaseController {

    /**
     * ********************* 品牌分类 *********************
     * 品牌分类 - 添加
     */
    public function actionTypeAdd() {
        $name = Yii::app()->request->getParam('name');
        $parentId = Yii::app()->request->getParam('type');
        if (empty($name) || empty($parentId)) {
            $this->output('', ApiStatusCode::$error, '缺少必要参数');
        }
        $model = new BrandType();
        $model->name = $name;
        $model->parent_id = $parentId;
        if ($model->save()) {
            $this->output('ok');
        }
        $this->output('', ApiStatusCode::$error, '添加失败');
    }

    /**
     * 品牌分类 - 编辑
     */
    public function actionTypeUpdate() {
        $id = Yii::app()->request->getParam('id');
        $name = Yii::app()->request->getParam('name');
        $parentId = Yii::app()->request->getParam('type');
        if (empty($id) || empty($name) || empty($parentId)) {
            $this->output('', ApiStatusCode::$error, '缺少必要参数');
        }
        $model = BrandType::model()->findByPk($id);
        $model->name = $name;
        $model->parent_id = $parentId;
        if ($model->save()) {
            $this->output('ok');
        }
        $this->output('', ApiStatusCode::$error, '编辑失败');
    }

    /**
     * 品牌分类 - 删除 - Ajax
     */
    public function actionTypeDelete() {
        $id = Yii::app()->request->getParam('id');
        if (empty($id)) {
            $this->output('', ApiStatusCode::$error, '缺少必要参数');
        }
        $model = BrandType::model()->deleteByPk($id);
        $this->output('ok');
    }

    /**
     * 品牌分类 - 列表
     */
    public function actionTypeList() {
        $model = new BrandType('search');
        if (isset($_GET['BrandType'])) {
            $model->attributes = $_GET['BrandType'];
        }
        $model->parent_id = !empty($model->parent_id) ? $model->parent_id : '<>0'; //默认查询parent_id不等于0的
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        $pager = $dataProvider->pagination;
        $this->render('typeList', array('model' => $model, 'pager' => $pager, 'list' => $list));
    }

    /**
     * 品牌分类 - 根据父级分类Id获取子类列表
     */
    public function actionGetTypeListByParentId() {
        $parentId = Yii::app()->request->getParam('id');
        $data = BrandType::getSonTypeByListData($parentId);
        echo CHtml::tag('option', array('value' => ''), '请选择', true);
        foreach ($data as $key => $value) {
            echo CHtml::tag('option', array('value' => $key), $value, true);
        }
    }

    /**
     * ********************* 品牌 *********************
     * 品牌 - 添加
     */
    public function actionAdd() {
        $model = new Brand();
        if (isset($_POST['Brand'])) {
            $model->attributes = $_POST['Brand'];
            if ($model->save()) {
                $this->redirect('/admin/brand/list');
            }
        }
        $this->render('add', array('model' => $model));
    }

    /**
     * 品牌 - 编辑
     */
    public function actionUpdate() {
        $id = Yii::app()->request->getParam('id');
        $model = Brand::model()->findByPk($id);
        if (is_null($model)) {
            throw new CHttpException(404, '页面不存在');
        }
        if (isset($_POST['Brand'])) {
            $model->attributes = $_POST['Brand'];
            if ($model->save()) {
                $this->redirect('/admin/brand/list');
            }
        }
        $this->render('update', array('model' => $model));
    }

    /**
     * 品牌 - 删除 - Ajax
     */
    public function actionDelete() {
        
    }

    /**
     * 品牌 - 列表
     */
    public function actionList() {
        $model = new Brand('search');
        if (isset($_GET['Brand'])) {
            $model->attributes = $_GET['Brand'];
        }
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        $pager = $dataProvider->pagination;
        $this->render('list', array('model' => $model, 'pager' => $pager, 'list' => $list));
    }

    public function actionGetAllByBrandTypeId() {
        $brandTypeId = Yii::app()->request->getParam('brand_type_id');
        $data = Brand::getAllByBrandTypeIdByListData($brandTypeId);
        echo CHtml::tag('option', array('value' => ''), '请选择', TRUE);
        foreach ($data as $key => $value) {
            echo CHtml::tag('option', array('value' => $key), $value, TRUE);
        }
    }

    /**
     * 品牌 - 详情
     */
    public function actionDetail() {
        $this->render('detail');
    }

    /**
     * ********************* 门店 *********************
     * 门店 - 添加
     */
    public function actionShopAdd() {
        $brandId = Yii::app()->request->getParam('brand_id');
        $menu = Yii::app()->request->getParam('menu');
        $model = new Shop();
        $model->brand_id = $brandId;
        if (isset($_POST['Shop'])) {
            $model->attributes = $_POST['Shop'];
            if ($model->save()) {
                $this->redirect('/admin/brand/shopList/menu/' . $menu . '/brand_id/' . $brandId);
            }
        }
        $this->render('shopAdd', array('model' => $model));
    }

    /**
     * 门店 - 编辑
     */
    public function actionShopUpdate() {
        $id = Yii::app()->request->getParam('id');
        $brandId = Yii::app()->request->getParam('brand_id');
        $menu = Yii::app()->request->getParam('menu');
        $model = Shop::model()->findByPk($id);
        $model->brand_id = $brandId;
        if (isset($_POST['Shop'])) {
            $model->attributes = $_POST['Shop'];
            if ($model->save()) {
                $this->redirect('/admin/brand/shopList/menu/' . $menu . '/brand_id/' . $brandId);
            }
        }
        $this->render('shopUpdate', array('model' => $model));
    }

    /**
     * 门店 - 删除
     */
    public function actionShopDelete() {
        
    }

    /**
     * 门店 - 列表
     */
    public function actionShopList() {
        $brandId = Yii::app()->request->getParam('brand_id');
        $model = new Shop();
        $model->brand_id = $brandId;
        $dataProvider = $model->search();
        $list = $dataProvider->getData();
        $pager = $dataProvider->pagination;
        $this->render('shopList', array('model' => $model, 'pager' => $pager, 'list' => $list));
    }

}
