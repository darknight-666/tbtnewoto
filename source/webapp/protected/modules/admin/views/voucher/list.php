<?php
$this->pageTitle = Yii::app()->name . ' - 代金券列表';
$this->module->params = array('title' => '代金券列表', 'title_img' => 'fa-th', 'icon' => '');
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">代金券列表</h3>
        <div class="panel-btnWrap">
            <input class="btn btn-primary"  value="发布" type="button">
        </div>
    </div>
<!--    导航-->
    <div class="panel-body">
        <div class="section">
            <div class="from-group">
                <label class="control-label" for="">品牌：</label>
                <div class="from-control">
                    <div class="select">
                        <div class="select-wrap">
                            <div class="select">
                                <div class="select-wrap">
                                    <select  name="FormLiborCustomer[role]">
                                        <option value="">请选择...</option>
                                        <option value="41">餐饮</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="from-group">
                <label class="control-label" for="">劵类别：</label>
                <div class="from-control">
                    <div class="select">
                        <div class="select-wrap">
                            <div class="select">
                                <div class="select-wrap">
                                    <select  name="FormLiborCustomer[role]">
                                        <option value="">请选择...</option>
                                        <option value="41">餐饮</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="from-group">
                <label class="control-label" for="">代金券状态：</label>
                <div class="from-control">
                    <div class="select">
                        <div class="select-wrap">
                            <div class="select">
                                <div class="select-wrap">
                                    <select  name="FormLiborCustomer[role]">
                                        <option value="">请选择...</option>
                                        <option value="41">餐饮</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="section">
                <div class="btn-wrap">
                    <input class="btn btn-primary" name="yt0" value="查询" type="submit">
                </div>
            </div>
        </div>
    </div>
</div>
<!--代金券分类-->
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">代金券分类</h3>
    </div>
    <div class="panel-body">
        <table  class="table table-striped" width="100%">
            <thead><tr role="row" >
                <th>ID</th>
                <th>品牌</th>
                <th>优惠券名称</th>
                <th>代金券面值</th>
                <th>价格</th>
                <th>数量</th>
                <th>剩余数量</th>
                <th>状态</th>
                <th>操作</th>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>已上线</td>
                <td>
                    <a class="btn-link" href="#">详情</a>
                    <span class="sep">|</span>
                    <a class="btn-link return-btn" href="javascript:;">适用门店</a>
                    <span class="sep">|</span>
                    <a class="btn-link return-btn" href="javascript:;">上线/下线</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

