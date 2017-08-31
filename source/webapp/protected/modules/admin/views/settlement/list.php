<?php
$this->pageTitle = Yii::app()->name . ' - 结算数据列表';
$this->module->params = array('title' => '结算数据列表', 'title_img' => 'fa-th', 'icon' => '');
$menu = $this->getAction()->getId();
?>
<!--结算数据-->
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">结算数据</h3>
    </div>
    <div class="panel-body">
        <div class="section">
            <!--            商家-->
            <div class="from-group">
                <label for="" class="control-label">商家</label>

                <div class="from-control">
                    <div class="select">
                        <div class="select-wrap">
                            <div class="select">
                                <div class="select-wrap">
                                    <select>
                                        <option value="">全部...</option>
                                        <option value="1">111</option>
                                        <option value="2">111</option>
                                        <option value="3">222</option>
                                        <option value="4">333</option>
                                        <option value="5">333</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--            日期-->
            <div class="from-group">
                <label for="" class="control-label">日期</label>

                <div class="from-control col-lg">
                    <div class="input sm">
                        <input maxlength="10" class="" autocomplete="off" name="FormLiborCustomer[begDate]"
                               id="FormLiborCustomer_begDate" type="text"></div>
                    <div class="sep">-</div>
                    <div class="input sm">
                        <input maxlength="10" class="" autocomplete="off" name="FormLiborCustomer[endDate]"
                               id="FormLiborCustomer_endDate" type="text">
                    </div>
                </div>
            </div>
            <!--            查询-->
            <div class="from-group">
                <div class="btn-wrap">
                    <input class="btn btn-primary" name="yt0" value="查询" type="submit"></div>
            </div>
        </div>
    </div>

</div>
<!--结算列表-->
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">结算列表</h3>
        <div class="panel-btnWrap">
            <input class="btn btn-primary" value="已结算" onclick="window.location.href = '#'" type="button">
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped" id="contractList">
            <thead>
            <tr role="row">
                <th><input name="selectAll" class="allChk" type="checkbox">全选</th>
                <th>商家(品牌)</th>
                <th>结算金额</th>
                <th>收款账户</th>
                <th>收款帐号</th>
                <th>开发行名称</th>
                <th>账户地址</th>
                <th>状态</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input name="selectAll" class="allChk" type="checkbox"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a class="btn-link" target="_blank" href="#">详情</a>
                    <a class="btn-link" target="_blank" href="#">导出</a>
                </td>
            </tr>
            <tr>
                <td><input name="selectAll" class="allChk" type="checkbox"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a class="btn-link" target="_blank" href="#">详情</a>
                    <a class="btn-link" target="_blank" href="#">导出</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
