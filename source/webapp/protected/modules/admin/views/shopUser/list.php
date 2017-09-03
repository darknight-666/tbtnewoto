<?php
$this->pageTitle = Yii::app()->name . ' - 商户账户列表';
$this->module->params = array('title' => '商户账户列表', 'title_img' => 'fa-th', 'icon' => '');
$menu = $this->getAction()->getId();
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">账户列表</h3>

        <div class="panel-btnWrap">
            <input class="btn btn-primary" value="添加账号" onclick="window.location.href = '/admin/shopUser/add/menu/<?php echo $menu ?>'" type="button">
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
                <?php foreach ($list as $item) { ?>
                    <tr>
                        <td><?php echo $item->shop->brand->name ?></td>
                        <td><?php echo $item->shop->name ?></td>
                        <td><?php echo $item->phonenumber ?></td>
                        <td><?php echo $item->reg_time ?></td>
                        <td><?php echo ShopUser::getStatusTitle($item->status) ?></td>
                        <th>
                            <?php echo CHtml::link('编辑', '/admin/shopUser/update/menu/' . $menu . '/id/' . $item->id, array('class' => 'btn-link')) ?>
                            <span class="sep">|</span>
                            <?php echo CHtml::link('注销', 'javascript', array('class' => 'btn-link')) ?>
                        </th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php $this->widget('application.widgets.PagerWidget', array('pages' => $pager)); ?>
    </div>
</div>

