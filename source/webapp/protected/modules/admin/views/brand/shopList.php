<?php
$this->pageTitle = Yii::app()->name . ' - 门店列表';
$this->module->params = array('title' => '门店列表', 'title_img' => 'fa-th', 'icon' => '');
$menu = Yii::app()->request->getParam('menu');
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">门店列表</h3>
        <div class="panel-btnWrap">
            <input class="btn btn-primary" value="新增门店" type="button" onclick="window.location.href = '/admin/brand/shopAdd/menu/<?php echo $menu ?>/brand_id/<?php echo @$_GET['brand_id'] ?>'">
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped" width="100%">
            <thead><tr role="row" >
                    <th>门店名称</th>
                    <th>门店电话</th>
                    <th>门店地址</th>
                    <th>创建时间</th>
                    <th>操作</th>
            </thead>
            <tbody>
                <?php foreach ($list as $item) { ?>
                    <tr>
                        <td><?php echo $item->name ?></td>
                        <td><?php echo $item->phonenumber ?></td>
                        <td><?php echo $item->address ?></td>
                        <td><?php echo $item->create_time ?></td>
                        <td>
                            <?php echo CHtml::link('编辑', '/admin/brand/shopUpdate/menu/' . $menu . '/brand_id/' . $item->brand_id.'/id/'.$item->shop_id, array('class' => 'btn-link return-btn')) ?>
                            <span class="sep">|</span>
                            <a class="btn-link return-btn"  href="javascript:;">删除</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


