<?php
$this->pageTitle = Yii::app()->name . ' - 结算数据详情';
$this->module->params = array('title' => '结算数据详情', 'title_img' => 'fa-th', 'icon' => '');
$menu = $this->getAction()->getId();
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">详情</h3>

        <div class="panel-btnWrap">
            <input class="btn btn-primary" value="导出excel" onclick="window.location.href = '#'" type="button">
        </div>
    </div>
    <div class="panel-body">
        <table id="dt_basic" class="table table-striped" width="100%">
            <thead>
            <tr role="row">
                <th>商家</th>
                <th>代金券名称</th>
                <th>实付金额</th>
                <th>使用时间</th>
                <th>使用门店</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
            </tr>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
            </tr>
            </tbody>
        </table>

    </div>
</div>
