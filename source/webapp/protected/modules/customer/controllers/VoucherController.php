<?php

/* * *
 * 代金券类
 */

class VoucherController extends CustomerBaseController {

    /**
     * 搜索条件
     */
    public function actionListSearchCondition() {
        // 1餐饮类 2娱乐类
        $this->checkParams(array('empty' => array('parent_id')));
        $data = array('brandType' => array(), 'businessCenter' => array(), 'orderWay' => array());
        $data['brandType'] = BrandType::getSonTypeByArray($this->params['parent_id']);
        $this->output($data);
    }

}
