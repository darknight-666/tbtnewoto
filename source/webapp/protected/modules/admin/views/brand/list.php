<?php
$this->pageTitle = Yii::app()->name . ' - 品牌列表';
$this->module->params = array('title' => '品牌列表', 'title_img' => 'fa-th', 'icon' => '');
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">品牌列表</h3>
        <div class="panel-btnWrap">
            <input class="btn btn-primary" onclick="window.location.href = "/tong/liborCustomer/create/menu/list"" value="创建品牌" type="button">
        </div>
    </div>
    <div class="panel-body">
        <table id="dt_basic" class="table table-striped" width="100%">
            <thead><tr role="row" >
                <th>品牌名称</th>
                <th>类别</th>
                <th>门店数量</th>
                <th>创建时间</th>
                <th>操作</th>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td>二级分类</td>
                <td></td>
                <td></td>
                <td>
                    <a class="btn-link" href="#">详情</a>
                    <span class="sep">|</span>
                    <a class="btn-link return-btn" id="7580" href="javascript:;">编辑</a>
                    <span class="sep">|</span>
                    <a class="btn-link return-btn" id="7580" href="javascript:;">门店</a>
                    <span class="sep">|</span>
                    <a class="btn-link return-btn" id="7580" href="javascript:;">优惠券</a>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a class="btn-link" href="#">详情</a>
                    <span class="sep">|</span>
                    <a class="btn-link return-btn" id="7580" href="javascript:;">编辑</a>
                    <span class="sep">|</span>
                    <a class="btn-link return-btn" id="7580" href="javascript:;">门店</a>
                    <span class="sep">|</span>
                    <a class="btn-link return-btn" id="7580" href="javascript:;">优惠券</a>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a class="btn-link" href="#">详情</a>
                    <span class="sep">|</span>
                    <a class="btn-link return-btn" id="7580" href="javascript:;">编辑</a>
                    <span class="sep">|</span>
                    <a class="btn-link return-btn" id="7580" href="javascript:;">门店</a>
                    <span class="sep">|</span>
                    <a class="btn-link return-btn" id="7580" href="javascript:;">优惠券</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

