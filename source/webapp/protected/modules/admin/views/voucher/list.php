<?php
$this->pageTitle = Yii::app()->name . ' - 代金券列表';
$this->module->params = array('title' => '代金券列表', 'title_img' => 'fa-th', 'icon' => '');
$menu = $this->getAction()->getId();
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">代金券列表</h3>
        <div class="panel-btnWrap">
            <input class="btn btn-primary"  value="发布" type="button" onclick="window.location.href = '/admin/voucher/add/menu/<?php echo $menu ?>'">
        </div>
    </div>
    <!--    导航-->
    <div class="panel-body">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'organization-form',
            'enableAjaxValidation' => true,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
            'action' => '/admin/voucher/list',
            'method' => 'GET',
        ));
        ?>
        <div class="section">
            <div class="from-group">
                <?php echo $form->labelEx($model, 'brand_id', array('class' => 'control-label')); ?>
                <div class="from-control">
                    <div class="select">
                        <div class="select-wrap">
                            <div class="select">
                                <div class="select-wrap">
                                    <?php
                                    echo $form->dropDownList($model, 'brand_id', Brand::getAllListByListData(), array('empty' => '请选择'))
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="from-group">
                <?php echo $form->labelEx($model, 'discount_status', array('class' => 'control-label')); ?>
                <div class="from-control">
                    <div class="select">
                        <div class="select-wrap">
                            <div class="select">
                                <div class="select-wrap">
                                    <?php
                                    echo $form->dropDownList($model, 'discount_status', Voucher::getDiscountStatusItems(), array('empty' => '请选择'))
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="from-group">
                <?php echo $form->labelEx($model, 'status', array('class' => 'control-label')); ?>
                <div class="from-control">
                    <div class="select">
                        <div class="select-wrap">
                            <div class="select">
                                <div class="select-wrap">
                                    <?php
                                    echo $form->dropDownList($model, 'status', Voucher::getStatusItems(), array('empty' => '请选择'))
                                    ?>
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
        <?php $this->endWidget(); ?>
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
                <?php foreach ($list as $item) { ?>
                    <tr>
                        <td><?php echo $item->voucher_id ?></td>
                        <td><?php echo $item->brand->name ?></td>
                        <td><?php echo $item->name ?></td>
                        <td><?php echo $item->face_value ?></td>
                        <td><?php echo $item->price ?></td>
                        <td><?php echo $item->quantity ?></td>
                        <td>xxx</td>
                        <td><?php echo Voucher::getStatusTitle($item->status) ?></td>
                        <td>
                            <?php echo CHtml::link('详情', '/admin/voucher/detail/menu/' . $menu . '/id/' . $item->voucher_id, array('class' => 'btn-link')) ?>
                            <span class="sep">|</span>
                            <?php echo CHtml::link('适用门店', '/admin/voucher/addShop/menu/' . $menu . '/voucher_id/' . $item->voucher_id, array('class' => 'btn-link return-btn')) ?>
                            <span class="sep">|</span>
                            <?php
                            if ($item->status == Voucher::STATUS_NOTONLINE || $item->status == Voucher::STATUS_LINEOFF) {
                                echo CHtml::link('上线', 'javascript:;' . $item->voucher_id, array('class' => 'btn-link return-btn', 'voucherStatus' => Voucher::STATUS_ONLINE));
                            } else {
                                echo CHtml::link('下线', 'javascript:;' . $item->voucher_id, array('class' => 'btn-link return-btn', 'voucherStatus' => Voucher::STATUS_LINEOFF));
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php $this->widget('application.widgets.PagerWidget', array('pages' => $pager)); ?>
    </div>
</div>

