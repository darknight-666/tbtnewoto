<?php
$this->pageTitle = Yii::app()->name . ' - 增值服务列表';
$this->module->params = array('title' => '增值服务列表', 'title_img' => 'fa-th', 'icon' => '');
$menu = $this->getAction()->getId();
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">品牌列表</h3>
        <div class="panel-btnWrap">
            <input class="btn btn-primary" value="创建增值服务" type="button" onclick="window.location.href = '/admin/brand/valueAddedServiceAdd/menu/<?php echo $menu ?>'">
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped" width="100%">
            <thead><tr role="row" >
                    <th>增值服务ID</th>
                    <th>服务名称</th>
                    <th>图标</th>
                    <th>操作</th>
            </thead>
            <tbody>
                <?php foreach ($list as $item) { ?>
                    <tr>
                        <td><?php echo $item->value_added_service_id ?></td>
                        <td><?php echo $item->name ?></td>
                        <td><img src="<?php echo $item->image_path ?>" style="max-width: 100px"></td>
                        <td>
                            <?php echo CHtml::link('编辑', '/admin/brand/valueAddedServiceUpdate/menu/' . $menu . '/id/' . $item->value_added_service_id, array('class' => 'btn-link return-btn')) ?>
                            <span class="sep">|</span>
                            <?php echo CHtml::link('删除', 'javascript:;', array('class' => 'btn-link return-btn', 'serviceId' => $item->value_added_service_id)) ?>
                        </td>
                    </tr>
                <?php } ?>
                <?php $this->widget('application.widgets.PagerWidget', array('pages' => $pager)); ?>
            </tbody>
        </table>
    </div>
</div>

