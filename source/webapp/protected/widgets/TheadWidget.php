<?php

class TheadWidget extends CWidget {
    public $items;
    public $lastColumn = '操作'; // 可自定义最后一列标题,为空则不显示

    public function init() {
        parent::init();
    }

    public function run() {
        foreach ($this->items as $item) {
            echo Chtml::openTag('th');
            echo $item;
            echo Chtml::closeTag('th');
        }
        if (!empty($this->lastColumn)) {
            echo Chtml::openTag('th') . $this->lastColumn . Chtml::closeTag('th');
        }
    }

}
