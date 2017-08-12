<?php
$this->pageTitle = Yii::app()->name . ' - 品牌列表';
$this->module->params = array('title' => '品牌列表', 'title_img' => 'fa-th', 'icon' => '');
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">品牌列表</h3>
        <div class="panel-btnWrap">
            <input class="btn btn-primary" value="创建品牌" type="button">
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped" width="100%">
            <thead><tr role="row" >
                    <th>品牌名称</th>
                    <th>类别</th>
                    <th>门店数量</th>
                    <th>创建时间</th>
                    <th>操作</th>
            </thead>
            <tbody>
                <?php foreach ($list as $item) { ?>
                    <tr>
                        <td><?php echo $item->name ?></td>
                        <td><?php echo $item->type->name ?></td>
                        <td><?php echo count($item->shop) ?></td>
                        <td><?php echo $item->create_time ?></td>
                        <td>
                            <?php echo CHtml::link('详情', '/admin/brand/detail/id/' . $item->brand_id, array('class' => 'btn-link return-btn')) ?>
                            <span class="sep">|</span>
                            <?php echo CHtml::link('编辑', '/admin/brand/update/id/' . $item->brand_id, array('class' => 'btn-link return-btn')) ?>
                            <span class="sep">|</span>
                            <?php echo CHtml::link('门店', '/admin/shop/list/brand_id/' . $item->brand_id, array('class' => 'btn-link return-btn')) ?>
                            <span class="sep">|</span>
                            <?php echo CHtml::link('优惠券', '/admin/voucher/list/brand_id/' . $item->brand_id, array('class' => 'btn-link return-btn')) ?>
                        </td>
                    </tr>
                <?php } ?>
                <?php $this->widget('application.widgets.PagerWidget', array('pages' => $pager)); ?>
            </tbody>
        </table>
    </div>
</div>

