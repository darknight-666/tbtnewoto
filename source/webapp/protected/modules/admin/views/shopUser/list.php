<?php
$this->pageTitle = Yii::app()->name . ' - 商户账户列表';
$this->module->params = array('title' => '商户账户列表', 'title_img' => 'fa-th', 'icon' => '');
$menu = $this->getAction()->getId();
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">账户列表</h3>

        <div class="panel-btnWrap">
            <input class="btn btn-primary" value="添加账号" onclick="window.location.href = '#'" type="button">
        </div>
    </div>
    <div class="panel-body">
        <table id="dt_basic" class="table table-striped" width="100%">
            <thead>
            <tr role="row">
                <th>品牌</th>
                <th>门店</th>
                <th>账号(手机号)</th>
                <th>创建时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>已开通</td>
                <th>
                    <a class="btn-link" target="_blank" href="#">编辑</a>
                    <a class="btn-link" target="_blank" href="#">注销</a>
                </th>
            </tr>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>已开通</td>
                <th>
                    <a class="btn-link" target="_blank" href="#">编辑</a>
                    <a class="btn-link" target="_blank" href="#">注销</a>
                </th>
            </tr>
            </tbody>
        </table>

    </div>
</div>

