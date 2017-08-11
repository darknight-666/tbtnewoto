<?php

class SideBarWidget extends CWidget {

    public $items;

    public function init() {
        parent::init();
    }

    public function run() {
        $this->createSiderBarView($this->items);
    }

    /**
     * 创建试图
     */
    public function createSiderBarView($items) {
        if (!empty($items)) {
            echo CHtml::openTag('dl');
            foreach ($items as $key => $item) {
                echo CHtml::openTag('dd');
                if (strtolower(Yii::app()->controller->action->getId()) === strtolower($key)) {
                    echo CHtml::link($item['name'], $item['url'], array('class' => 'active')); // 高亮
                } else {
                    echo CHtml::link($item['name'], $item['url']);
                }
                echo CHtml::closeTag('dd');
            }
            echo CHtml::closeTag('dl');
        }
    }

}
