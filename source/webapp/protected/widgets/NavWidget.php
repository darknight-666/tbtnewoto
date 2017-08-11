<?php

class NavWidget extends CWidget {

    public $items;

    public function init() {
        parent::init();
    }

    public function run() {
        $this->createNavView($this->items);
    }

    /**
     * 创建视图
     * @param type $navItems
     */
    public function createNavView($navItems) {
        foreach ($navItems as $key => $item) {
            if (strtolower($key) == strtolower(Yii::app()->controller->getId())) {
                echo CHtml::link($item['name'], $item['url'], array('class' => 'active')); // 高亮
            } else {
                echo CHtml::link($item['name'], $item['url']);
            }
        }
    }

}
