<?php
$this->pageTitle = Yii::app()->name . ' - 订单详情';
$this->module->params = array('title' => '订单详情', 'title_img' => 'fa-th', 'icon' => '');
$menu = $this->getAction()->getId();
?>
<!--订单详情-->
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">订单详情</h3>
    </div>
    <div class="panel-body">
        <table class="table-view table-striped">
            <tbody>
            <tr>
                <th>订单状态：</th>
                <td>待支付/已支付/已退款</td>
            </tr>
            <tr>
                <th></th>
                <td>16800</td>
            </tr>
            <tr>
                <th>下单时间</th>
                <td></td>
            </tr>
            <tr>
                <th>订单金额(元)</th>
                <td>80</td>
            </tr>
            <tr>
                <th>品牌</th>
                <td>海底捞</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<!--订单信息-->
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">订单信息</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-border">
            <thead>
            <tr>
                <th>代金券名称</th>
                <th>代金券面值(元)</th>
                <th>价格(元)</th>
                <th>有效期</th>
                <th>状态</th>
                <th>适用门店</th>
                <th>适用时间</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>海底针100元代金券</td>
                <td class="t-right">100</td>
                <td class="t-right">90</td>
                <td class="t-right">2018-12-09 18:18:30</td>
                <td>未使用</td>
                <td class="t-right">中关村店</td>
                <td class="t-right">2018-12-09 18:18:30</td>
            </tr>
            <tr>
                <td>海底针100元代金券</td>
                <td class="t-right">100</td>
                <td class="t-right">90</td>
                <td class="t-right">2018-12-09 18:18:30</td>
                <td>未使用</td>
                <td class="t-right">中关村店</td>
                <td class="t-right">2018-12-09 18:18:30</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>