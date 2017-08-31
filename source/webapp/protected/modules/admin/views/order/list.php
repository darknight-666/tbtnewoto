<?php
$this->pageTitle = Yii::app()->name . ' - 订单列表';
$this->module->params = array('title' => '订单列表', 'title_img' => 'fa-th', 'icon' => '');
$menu = $this->getAction()->getId();
?>
<!--优惠券订单-->
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">优惠券订单</h3>
    </div>
    <div class="panel-body">
        <div class="section">
            <!--            品牌-->
            <div class="from-group">
                <label for="" class="control-label">品牌</label>

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
            <!--            下单时间-->
            <div class="from-group">
                <label for="" class="control-label">下单时间</label>

                <div class="from-control col-lg">
                    <div class="input sm">
                        <input maxlength="10" class="" autocomplete="off" name="FormLiborCustomer[begDate]"
                               id="FormLiborCustomer_begDate" type="text"></div>
                    <div class="sep">-</div>
                    <div class="input sm">
                        <input maxlength="10" class="" autocomplete="off" name="FormLiborCustomer[endDate]"
                               id="FormLiborCustomer_endDate" type="text"></div>
                </div>
            </div>
            <!--            订单状态-->
            <div class="from-group">
                <label for="" class="control-label">订单状态</label>

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
        </div>
        <div class="section">
            <div class="btn-wrap">
                <input class="btn btn-primary" name="yt0" value="查询" type="submit"></div>
        </div>
    </div>
</div>
<!--优惠券列表-->
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">优惠券列表</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
            <tr role="row">
                <th>订单编号</th>
                <th>代金券名称</th>
                <th>购买数量(张)</th>
                <th>价格(元)</th>
                <th>订单金额(元)</th>
                <th>下单时间</th>
                <th>订单状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td>福成100元代金券1111</td>
                <td>2</td>
                <td>80</td>
                <td>2017-07-29 16:12:12</td>
                <td>T13</td>
                <td></td>
                <td>
                    <a class="btn-link" href="#">详情</a>
            </tr>
            <tr>
                <td></td>
                <td>福成100元代金券1111</td>
                <td>2</td>
                <td>80</td>
                <td>2017-07-29 16:12:12</td>
                <td>T13</td>
                <td></td>
                <td>
                    <a class="btn-link" href="#">详情</a>
            </tr>

            </tbody>
        </table>
    </div>
