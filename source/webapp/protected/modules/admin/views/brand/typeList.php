<?php
$this->pageTitle = Yii::app()->name . ' - 品牌分类列表';
$this->module->params = array('title' => '品牌分类列表', 'title_img' => 'fa-th', 'icon' => '');
?>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">分类列表</h3>
        <div class="panel-btnWrap">
            <input class="btn btn-primary merchName"  value="添加分类" type="button" id="btn-add">
        </div>
    </div>

    <div class="panel-body">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'organization-form',
            'enableAjaxValidation' => true,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
            'action' => '/admin/brand/typeList',
            'method' => 'GET',
        ));
        ?>
        <div class="section">
            <div class="from-group">
                <label for="" class="control-label">请选择分类</label>
                <div class="from-control  col-lg">
                    <div class="select">
                        <div class="select-wrap">
                            <?php
                            echo $form->dropDownList($model, 'parent_id', BrandType::getAllTopTypeByListData(), array('empty' => '请选择'));
                            ?>
                            <i></i>
                        </div>
                    </div>
                    <div class="sep"></div>
                    <input type="submit" class="btn btn-primary" value="查询"/>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
<div class="tbt-panel">
    <div class="panel-header">
        <h3 class="panel-title">分类列表</h3>
    </div>
    <div class="panel-body">
        <table  class="table table-striped" width="100%">
            <thead><tr role="row" >
                    <th>分类名称</th>
                    <th>上一级分类</th>
                    <th>商户数量（家）</th>
                    <th>操作</th>
            </thead>
            <tbody>
                <?php foreach ($list as $item) { ?>
                    <tr>
                        <td><?php echo $item->name ?></td>
                        <td><?php echo $item->parent->name ?></td>
                        <td><?php echo count($item->brand)?></td>
                        <td>
                            <a class="btn-link" href="#">编辑</a>
                            <span class="sep">|</span>
                            <a class="btn-link return-btn"  href="javascript:;">删除</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php $this->widget('application.widgets.PagerWidget', array('pages' => $pager)); ?>
    </div>
</div>
<div id="dialog-box" style="display: none;">
<div class="from-group">
    <label for="" class="control-label">分类名称</label>
    <input autocomplete="off" type="text" style="width: 180px; height: 25px; line-height: 25px;   border: 1px solid #e6e5ea;padding: 0;margin: 0;" class="inventory-num">
    <div class="errorMessage errorMessagea"></div>
</div>
<div class="from-group"><label class="control-label" for="">上级分类</label>
    <select name="FormLiborCustomer[role]" style=" width: 180px;padding: 0;margin: 0;height: 25px; line-height: 25px;">
        <option value="">请选择...</option> <option value="41">餐饮</option>
    </select>
    <div class="errorMessageb errorMessage"></div>
</div>
</div>
<script>
    /**
     * 添加分类
     */
    $('#btn-add').click(function() {
        var coursetypeId = $(this).attr("coursetypeid");
        $('#tbt_product_id').val(coursetypeId);
        var dialogTmp = $('#dialog-box').html();
        $('#tbt_product_id').val($(this).attr("merchId"));

        $('#dialog-manager').manager({
            width: 500,
            height: 280,
            title: '添加分类?',
            buttons: [
                {
                    html: "确定",
                    "class": "btn btn-primary btn-confirm",
                    click: function() {
  //                        变量input的val
                        var inventoryval = $(this).parents(".ui-dialog").find(".inventory-num").val();
                        if (inventoryval == '') {
                            $(this).parents(".ui-dialog").find(".errorMessagea").text("输入的库存不能为空！");
                            return false;
                        };
//                        变量select下拉框的val
                        var hideval = $(this).parents(".ui-dialog").find(".hide").val();
                        if (hideval == '') {
                            $(this).parents(".ui-dialog").find(".errorMessageb").text("选择模板不可以为空");
                            return false;
                        }
                        eval('updata("/tong/nobleMetal/mdfMerchInventory/", "' + hideval + '", "")');
                        $(this).dialog("close");
                    }
                },
                {
                    html: "取消",
                    "class": "btn btn-line",
                    click: function() {
                        $(this).dialog("close");
                    }
                }
            ],
            html: '<div id="dialog-manager">' + dialogTmp + '</div>'
        });
        return false;
    });
</script>