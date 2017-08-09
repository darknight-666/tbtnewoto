<?php

Yii::import('zii.widgets.CMenu');

class TNav extends CMenu {

    public $isOpen = false;

    public function init() {
        if ($this->isOpen == false) {
            $this->checkItems($this->items);
//            foreach ($this->items as $key => $item) {
//                $del = true;
//                if (!empty($item['url']) && !empty($item['items'])) {
//                    foreach ($item['items'] as $k => $it) {
//                        $right = array();
//                        $urls = explode('/', $it['url'][0]);
//                        foreach ($urls as $url) {
//                            if (!empty($url)) {
//                                $right[] = ucwords($url);
//                            }
//                        }
//                        $rightStr = implode('.', $right);
//                        if ($rightStr != '#' && !Yii::app()->user->checkAccess($rightStr)) {
//                            unset($this->items[$key]['items'][$k]);
//                        } else {
//                            $del = false;
//                        }
//                    }
//                }
//                if (empty($item['items'])) {
//                    $del = false;
//                }
//                if ($del) {
//                    unset($this->items[$key]);
//                }
//            }
        }

        parent::init();
        foreach ($this->items as &$item) {
            if (isset($item['label']) && isset($item['fa_img'])) {
                $item['label'] = '<i class="fa fa-fw ' . $item['fa_img'] . '"></i> <span class="menu-item">' . $item['label'] . '</span>';
                if (empty($item['online'])) {
                    $item['label'] .= '<em class="fa"></em>';
                }
                if (isset($item['number']) && $item['number'] > 0) {
                    $item['label'] .= '<span class="badge pull-right bg-color-red margin-right-15 tbt-minify-badge">' . $item['number'] . '</span>';
                }
                if (isset($item['items'])) {
                    foreach ($item['items'] as &$value) {
                        if (isset($value['number']) && $value['number'] > 0) {
                            $value['label'] .= '<span class="badge bg-color-greenLight pull-right margin-right-15">' . $value['number'] . '</span>';
                        }
                    }
                }
            }
        }
    }

    protected function isItemActive($item, $route) {
//		if (isset($item['url']) && is_array($item['url'])) {
//			$urls = explode('/', $item['url'][0]);
//			$routes = explode('/', $route);
//			if (isset($urls[2]) && isset($urls[1]) && $urls[2] == $routes[1]) {
//				return true;
//			}
//		}
        return false;
    }
    
    /**
     * 递归+引用处理侧栏的显示与隐藏
     * @auther wangmingxu
     * @param type $items
     */
    public function checkItems(&$items) {
        foreach ($items as $key => &$val) {
            if (isset($val['items'])) {
                $this->checkItems($val['items']);
            }
            if ($val['url'][0] != '#' && $val['url'] != 'javascript:;') {
                $right = array();
                $urls = explode('/', $val['url'][0]);
                foreach ($urls as $url) {
                    if (!empty($url)) {
                        $right[] = ucwords($url);
                    }
                }
                $rightStr = implode('.', $right);
                if (!Yii::app()->user->checkAccess($rightStr)) {
                    unset($items[$key]);
                }
            } else {
                if (empty($val['items'])) {
                    unset($items[$key]);
                }
            }
        }
    }

    public function checkAccess() {
        
    }

}
