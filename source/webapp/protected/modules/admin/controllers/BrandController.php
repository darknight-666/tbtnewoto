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
        $this->render('list');
    }

    /**
     * 品牌 - 详情
     */
    public function actionDetail() {
        $this->render('detail');
    }

}
