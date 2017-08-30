<?php
$this->pageTitle = Yii::app()->name . ' - 品牌TAG列表';
$this->module->params = array('title' => '品牌TAG列表', 'title_img' => 'fa-th', 'icon' => '');
$menu = $this->getAction()->getId();
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">品牌TAG列表</h3>
        <div class="panel-btnWrap">
            <input class="btn btn-primary" value="创建品牌TAG" type="button" onclick="window.location.href = '/admin/brand/tagAdd/menu/<?php echo $menu ?>'">
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped" width="100%">
            <thead><tr role="row" >
                    <th>品牌TAG ID</th>
                    <th>品牌tag名称</th>
                    <th>操作</th>
            </thead>
            <tbody>
                <?php foreach ($list as $item) { ?>
                    <tr>
                        <td><?php echo $item->tag_id ?></td>
                        <td><?php echo $item->name ?></td>
                        <td>
                            <?php echo CHtml::link('编辑', '/admin/brand/valueAddedServiceUpdate/menu/' . $menu . '/id/' . $item->tag_id, array('class' => 'btn-link return-btn')) ?>
                            <span class="sep">|</span>
                            <?php echo CHtml::link('删除', 'javascript:;', array('class' => 'btn-link return-btn', 'serviceId' => $item->tag_id)) ?>
                        </td>
                    </tr>
                <?php } ?>
                <?php $this->widget('application.widgets.PagerWidget', array('pages' => $pager)); ?>
            </tbody>
        </table>
    </div>
</div>

