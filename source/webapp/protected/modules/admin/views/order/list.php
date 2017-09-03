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
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'organization-form',
            'enableAjaxValidation' => true,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
            'action' => '/admin/order/list',
            'method' => 'GET',
        ));
        ?>
        <div class="section">
            <!--品牌-->
            <div class="from-group">
                <?php echo $form->labelEx($model, 'brand_id', array('class' => 'control-label')); ?>
                <div class="from-control">
                    <div class="select">
                        <div class="select-wrap">
                            <div class="select">
                                <div class="select-wrap">
                                    <?php
                                    echo $form->dropDownList($model, 'brand_id', Brand::getAllByListData(), array('empty' => '请选择'))
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--下单时间-->
            <div class="from-group">
                <label for="" class="control-label">下单时间</label>

                <div class="from-control col-lg">
                    <div class="input sm">
                        <?php echo $form->textField($model, 'create_time_begin', array('autocomplete' => 'off', 'maxlength' => 10)); ?>
                    </div>
                    <div class="sep">-</div>
                    <div class="input sm">
                        <?php echo $form->textField($model, 'create_time_end', array('autocomplete' => 'off', 'maxlength' => 10)); ?>
                    </div>
                </div>
            </div>
            <!--订单状态-->
            <div class="from-group">
                <label for="" class="control-label">订单状态</label>
                <div class="from-control">
                    <div class="select">
                        <div class="select-wrap">
                            <div class="select">
                                <div class="select-wrap">
                                    <?php
                                    echo $form->dropDownList($model, 'status', Order::getStatusItems(), array('empty' => '请选择'))
                                    ?>
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
        <?php $this->endWidget(); ?>
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
                <?php foreach ($list as $item) { ?>
                    <tr>
                        <td><?php echo $item->order_id ?></td>
                        <td><?php echo $item->orderVoucher->voucher->name?></td>
                        <td><?php echo $item->orderVoucher->quantity?></td>
                        <td><?php echo $item->orderVoucher->price?></td>
                        <td><?php echo $item->amount ?></td>
                        <td><?php echo $item->create_time ?></td>
                        <td><?php echo Order::getStatusTitle($item->status) ?></td>
                        <td>
                            <?php echo CHtml::link('详情', '/admin/order/detail/id/' . $item->order_id, array('class' => 'btn-link')) ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php $this->widget('application.widgets.PagerWidget', array('pages' => $pager)); ?>
    </div>
</div>